<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*')->get();

        $productHots = Product::where('featured', 1)->get();

        $productNews = Product::orderBy('id', 'desc')->get();

        $categorys = Category::all();

        $brands = Brand::all();
        
        return view('layout.index', compact('products','productHots','productNews' ,'categorys', 'brands'));
    }

   
}
