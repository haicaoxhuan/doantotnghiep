<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categorys = Category::all();

        $brands = Brand::all();

        $sortBy = $request->sort_by ?? 'latest';

        $search = $request->search ?? '';

        $products = Product::where('name', 'like', '%' . $search . '%');

        $products = $this->filter($products, $request);
        
        $products = $this->sort($products, $sortBy);
        // dd($products);

        return view('shop.shop', compact('products', 'categorys', 'brands'));
    }

    public function category($slugCate, Request $request)
    {
        $sortBy = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';
        
        $brands = Brand::all();

        $categorys = Category::all();

        $products = Category::where('slug', $slugCate)->first()->products->toQuery();

        $products = $this->filter($products, $request);

        $products = $this->sort($products, $sortBy);

        return view('shop.shop', compact('products', 'categorys', 'brands'));
    }

    public function sort($products, $sortBy)
    {
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
                break;
        }
        
        $products = $products->paginate(2);
        $products->appends(['sort_by' => $sortBy]);

        return $products;
    }

    public function filter($products, Request $request)
    {
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = $brand_ids !=null ? $products->wherein('brand_id', $brand_ids) : $products;

        $minPrice = $request->start_price;
        $maxPrice = $request->end_price;
        $products = ($minPrice !=null && $maxPrice != null) ? $products->whereBetween('price', [$minPrice, $maxPrice]) : $products;
        return $products;
    }
}
