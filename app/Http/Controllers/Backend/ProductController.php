<?php

namespace App\Http\Controllers\Backend;

use App\Http\Common\Common;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private $products;

    public function __construct(Product $products)
    {
        $this->product = $products;
    }
    
    public function index()
    {
        $products = Product::select(
            'products.id',
            'products.name',
            'products.price',
            'products.price_dc',
            'products.quantity',
            'products.brand_id',
            'products.sku',
            'products.featured',
            'brands.id as brandId' ,
            'brands.name as brandName',
            'product_images.images as images'
        )
        ->leftjoin('brands', 'brands.id', 'products.brand_id')
        ->leftjoin('product_images', 'product_images.product_id', 'products.id')
        ->groupBy('product_images.product_id')
        ->orderBy('products.id', 'DESC');
        $products = $products->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::select(
            'brands.id',
            'brands.name',
        )->get();

        $categories = Category::select(
            'categorys.id',
            'categorys.name',
        )->get();

        return view('admin.product.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $products = [
                'name' => $request->name,
                'price' => $request->price,
                'price_dc' => $request->price_dc,
                'quantity' => $request->qty,
                'description' => $request->des,
                'short_des' => $request->sort_des,
                'brand_id' => $request->brand_id,
                'featured' => $request->featured,
            ];
            
            $this->product->create($products);
            //pro_cates
            $pro_cate = Product::orderBy('id', 'DESC')->first();
            $pro_cate->category()->attach($request->category);

            DB::commit();
            return redirect()->route('admin.product.index')->with([
                'status_succeed' => trans('message.create_product_successd')
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('productImg')) {
            $filePath = Common::handleUploadFile('img/product/', 'productImg', $request);
            return response()->json(['success' => $filePath]);
        }
    }

    /**
     * remove img
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function remove(Request $request)
    {
        if ($request) {
            $check = Common::handleDeleteFile('file_name', $request);
            if ($check) {
                return response()->json(['status' => 200]);
            }
            return response()->json(['status' => 400]);
        }
    }
}
