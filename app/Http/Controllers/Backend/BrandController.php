<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    use StorageImageTrait;
    private $brands;

    public function __construct(Brand $brands)
    {
        $this->brand = $brands;
    }

    public function index(Request $request)
    {
        $brands = Brand::select(
            'brands.id',
            'brands.name',
            'brands.images',
            'brands.slug',
        );
        
        if(isset($request->search)){
            $brands->where('brands.name', 'like', '%' . $request->search . '%');
        }
        $brands = $brands->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $brands = [
                'name' => $request->name,
                'slug' => $request->slug,
            ];
            $img = $this->Upload($request, 'image', 'brand');
            if (!empty($img)) {
                $brands['images'] = $img['file_path'];
            }
            $a = $this->brand->create($brands);
            DB::commit();
            return redirect()->route('admin.brand.index')->with([
                'status_succeed' => trans('message.create_brand_successd')
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
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        try {
            $brand = $this->brand->find($id);
            if ($brand) {
                DB::beginTransaction();
                $brands = [
                    'name' => $request->name,
                    'slug' => $request->slug,
                ];
                $img = $this->Upload($request, 'image', 'brand');
                if (!empty($img)) {
                    $brands['images'] = $img['file_path'];
                }
                $brand = $brand->update($brands);
                DB::commit();
                return redirect()->route('admin.brand.index')->with([
                    'status_succeed' => trans('message.update_brand_success')
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
            $brand = Brand::find($id);
            if ($brand) {
                DB::beginTransaction();
                $brand->delete();
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
}
