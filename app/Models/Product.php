<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $guarded = [];

    const NOI = 1;
    const KO_NOI = 0;

    protected $casts = [
        'images' => 'array',
    ];

    public static function checkFeatured($status)
    {
        $html = '';
        switch ($status) {
            case self::NOI:
                $html .= "<span>" . trans('language.featured') . "</span>";
                break;
            case self::KO_NOI:
                $html .= "<span>" . trans('language.no_featured') . "</span>";
                break;
            default:
                $html .= "<span>" . trans('language.no_featured') . "</span>";
                break;
        }
        return $html;
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'pro_cates', 'product_id', 'category_id');
    }

    public function productImages()
    {
        return $this->hasMany(Product_Image::class, 'product_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(Order_Detail::class, 'product_id', 'id');
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }
}
