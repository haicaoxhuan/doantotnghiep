<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->sort_by ?? 'latest';

        $search = $request->search ?? '';

        $products = Product::where('name', 'like', '%' . $search . '%');

        switch ($sortBy) {
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name-asc':
                $products = $products->orderBy('name');
                break;
            case 'name-desc':
                $products = $products->orderByDesc('name');
                break;
            case 'price-asc':
                $products = $products->orderBy('price');
                break;
            case 'price-desc':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }

        $products = $products->paginate(2);

        $products->appends(['sort_by' => $sortBy]);

        return view('shop.shop', compact('products'));
    }
}
