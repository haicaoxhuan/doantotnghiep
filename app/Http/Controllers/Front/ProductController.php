<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\ProductCategory;
use App\Models\ProductComment;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.short_des',
            'products.sku',
            'products.brand_id',
            'products.images',
            'product_details.id as proDetailId',
            'product_details.price',
            'product_details.quantity',
            DB::raw('MAX(product_details.price)'),
            DB::raw('MIN(product_details.price)'),
        )->leftjoin('brands', 'brands.id', 'products.brand_id')
        ->leftjoin('product_details', 'products.id', 'product_details.product_id')
        ->where('products.id', $id)
        ->with('productDetail')
        ->first();

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

    public function chooseColor(Request $request)
    {
        if($request->ajax()){
            $product = ProductDetail::find($request->id);
        }
        return response()->json(['product' => $product]);
    }
}