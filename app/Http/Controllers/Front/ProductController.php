<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // $product = Product::findOrFail($id);
        $product = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.short_des',
            'products.sku',
            'products.brand_id',
            'products.images',
            'products.attribute',
        )->leftjoin('brands', 'brands.id', 'products.brand_id')
        ->where('products.id', $id)->first();
        dd($product->attribute);

        $category = ProductCategory::select(
            'pro_cates.*',
            'products.id as product_id',
            'categorys.id as category_id',
            'categorys.name as category_name',
        )->leftjoin('products', 'products.id', 'pro_cates.product_id')
        ->leftjoin('categorys', 'categorys.id', 'pro_cates.category_id')
        ->where('pro_cates.product_id', $id)
        ->get();

        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if($countRating != 0){
            $avgRating = $sumRating/$countRating;
        }

        return view('product.product-detail', compact('product', 'countRating', 'avgRating', 'category'));
    }

    public function comment(Request $request)
    {
        ProductComment::create(
            $request->all()
        );
        return redirect()->back();
    }

    public function modal(Request $request)
    {

        $productId = $request->product_id;
        $product = Product::find($productId);

        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if($countRating != 0){
            $avgRating = $sumRating/$countRating;
        }
        $output['id'] = $product->id;
        $output['name'] = $product->name;
        $output['images'] = '<img src="images/'.$product->productImages[0]->images.'">';
        $output['short_des'] = $product->short_des;
        $output['price'] = '$'.$product->price;
        if($product->price_dc){
            $output['price_dc'] = '$'.$product->price_dc;
        }else{
            $output['price_dc'] = $product->price_dc;
        }
        $output['rate'] = $avgRating;
        $output['count'] = '('.$countRating.' '.'Customer Review' .')';

        return json_encode($output);
    }
}
