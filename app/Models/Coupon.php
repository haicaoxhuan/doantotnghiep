<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $guarded = [];

    const CON = 0;
    const KO_CON = 1;

    public static function checkStatus($status)
    {
        $html = '';
        switch ($status) {
            case self::CON:
                $html .= "<span>" . trans('language.valuable') . "</span>";
                break;
            case self::KO_CON:
                $html .= "<span>" . trans('language.off_value') . "</span>";
                break;
            default:
                $html .= "<span>" . trans('language.valuable') . "</span>";
                break;
        }
        return $html;
    }
}
