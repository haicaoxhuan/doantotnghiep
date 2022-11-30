<?php

namespace App\Http\Controllers\Backend;

use App\Http\Common\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $products;

    public function __construct(Product $products)
    {
        $this->product = $products;
    }

    public function index(Request $request)
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
            'brands.id as brandId',
            'brands.name as brandName',
            'products.images'
        )
            ->leftjoin('brands', 'brands.id', 'products.brand_id')
            ->orderBy('products.id', 'DESC');
        if (isset($request->search)) {
            $products->where('products.name', 'like', '%' . $request->search . '%');
        }
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

    public function store(ProductRequest $request)
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
                'sku' => $request->sku,
                'images' => $request->productImg
            ];

            $product = $this->product->create($products);

            //pro_cates
            $product->category()->attach($request->category);

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

    public function edit($id)
    {
        $brands = Brand::select(
            'brands.id',
            'brands.name',
        )->get();

        $categories = Category::select(
            'categorys.id',
            'categorys.name',
        )->get();

        $product = Product::find($id);

        $proCates = ProductCategory::query()->where('pro_cates.product_id', $product->id)->pluck('pro_cates.category_id');

        return view('admin.product.edit', compact('brands', 'categories', 'product', 'proCates'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $products = Product::find($id);
            if ($products) {
                DB::beginTransaction();
                $param = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'price_dc' => $request->price_dc,
                    'quantity' => $request->qty,
                    'description' => $request->des,
                    'short_des' => $request->sort_des,
                    'brand_id' => $request->brand_id,
                    'featured' => $request->featured,
                    'sku' => $request->sku,
                    'images' => $request->productImg
                ];
                $products->update($param);

                //pro_cates
                $products->category()->sync($request->category);

                DB::commit();
                return redirect()->route('admin.product.index')->with([
                    'status_succeed' => trans('message.update_product_success')
                ]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                DB::beginTransaction();
                $product->delete();
                DB::commit();
                return [
                    'status' => Response::HTTP_OK,
                    'msg' => [
                        'text' => trans('message.success'),
                    ],
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("File: " . $e->getFile() . '---Line: ' . $e->getLine() . "---Message: " . $e->getMessage());
            return response()->json([
                'code' => \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => trans('message.server_error')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('productImg')) {
            $filePath = Common::handleUploadFile('img/products/', 'productImg', $request);
            return response()->json(['success' => $filePath]);
        }
    }

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
