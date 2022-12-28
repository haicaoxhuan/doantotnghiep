<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.short_des',
            'products.sku',
            'products.brand_id',
            'products.images',
            DB::raw('MAX(product_details.price) as maxPrice'),
            DB::raw('MIN(product_details.price) as minPrice'),
        )
        ->leftjoin('product_details', 'products.id', 'product_details.product_id')
        ->groupBy('product_details.product_id')
        ->get();

        $productHots = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.short_des',
            'products.sku',
            'products.brand_id',
            'products.images',
            DB::raw('MAX(product_details.price) as maxPrice'),
            DB::raw('MIN(product_details.price) as minPrice'),
        )
        ->leftjoin('product_details', 'products.id', 'product_details.product_id')
        ->where('products.featured', 1)
        ->groupBy('product_details.product_id')
        ->get();

        $productNews = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.short_des',
            'products.sku',
            'products.brand_id',
            'products.images',
            DB::raw('MAX(product_details.price) as maxPrice'),
            DB::raw('MIN(product_details.price) as minPrice'),
        )
        ->leftjoin('product_details', 'products.id', 'product_details.product_id')
        ->groupBy('product_details.product_id')
        ->orderBy('id', 'desc')
        ->get();

        $categorys = Category::all();

        $brands = Brand::all();
        
        return view('layout.index', compact('products','productHots','productNews' ,'categorys', 'brands'));
    }

   
}
