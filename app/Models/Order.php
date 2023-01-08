<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $guarded = [];

    const CASH = 1;
    const TRANSFER = 2;
    const PAYPAL = 3;
    const UNCONFIRM = 1;
    const DELIVERY = 2;
    const SUCCESSFUL = 3;

    public function orderDetails()
    {
        return $this->hasMany(Order_Detail::class, 'order_id', 'id');
    }

    public static function checkPaymets($payments)
    {
        $html = '';
        switch ($payments) {
            case self::CASH:
                $html .= "<span>" . trans('language.cash') . "</span>";
                break;
            case self::TRANSFER:
                $html .= "<span>" . trans('language.transfer') . "</span>";
                break;
            case self::PAYPAL:
                $html .= "<span>" . trans('language.paypal') . "</span>";
                break;
            default:
                $html .= "<span>" . trans('language.cash') . "</span>";
                break;
        }
        return $html;
    }

    public static function checkStatus($status)
    {
        $html = '';
        switch ($status) {
            case self::UNCONFIRM:
                $html .= "<span>" . trans('language.unconfirm') . "</span>";
                break;
            case self::DELIVERY:
                $html .= "<span>" . trans('language.delivery') . "</span>";
                break;
            case self::SUCCESSFUL:
                $html .= "<span>" . trans('language.successful') . "</span>";
                break;    
            default:
                $html .= "<span>" . trans('language.unconfirm') . "</span>";
                break;
        }
        return $html;
    }
}
