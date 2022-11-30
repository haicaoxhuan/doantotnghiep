<?php

namespace App\Http\View\Composer;

use App\Http\Controllers\Front\CartController;
use Illuminate\View\View;

class CartComposer
{
    protected $carts;

    public function __construct(CartController $carts)
    {
        $this->cart = $carts->getCart();
    }

    public function compose(View $view)
    {
        $view->with('carts', $this->cart);
    }

}
