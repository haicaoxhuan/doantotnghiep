<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select(
            'products.id',
            'products.name',
            'products.price',
            'products.price_dc',
            'products.quantity',
            'products.brand_id',
            'products.category_id',
            'products.sku',
            'products.featured',
            'brands.id as brandId' ,
            'brands.name as brandName',
            'categorys.id as cateId',
            'categorys.name as cateName',
            'product_images.images as images'
        )
        ->leftjoin('brands', 'brands.id', 'products.brand_id')
        ->leftjoin('categorys', 'categorys.id', 'products.category_id')
        ->leftjoin('product_images', 'product_images.product_id', 'products.id')
        ->groupBy('product_images.product_id');
        $products = $products->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }
}
