<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categorys';

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'pro_cates', 'product_id', 'category_id');
    }
}
