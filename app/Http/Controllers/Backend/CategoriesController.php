<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response as HttpResponse;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    use StorageImageTrait;
    private $categories;

    public function __construct(Category $categories)
    {
        $this->category = $categories;
    }

    public function index(Request $request)
    {
        $categories = Category::select(
            'categorys.id',
            'categorys.name',
            'categorys.images',
            'categorys.slug',
        );
        
        if(isset($request->search)){
            $categories->where('categorys.name', 'like', '%' . $request->search . '%');
        }
        $categories = $categories->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $categories = [
                'name' => $request->name,
                'slug' => $request->slug,
            ];
            $img = $this->Upload($request, 'image', 'brand');
            if (!empty($img)) {
                $categories['images'] = $img['file_path'];
            }
            $a = $this->category->create($categories);
            DB::commit();
            return redirect()->route('admin.categories.index')->with([
                'status_succeed' => trans('message.create_category_successd')
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
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = $this->category->find($id);
            if ($category) {
                DB::beginTransaction();
                $categories = [
                    'name' => $request->name,
                    'slug' => $request->slug,
                ];
                $img = $this->Upload($request, 'image', 'category');
                if (!empty($img)) {
                    $categories['images'] = $img['file_path'];
                }
                $categories = $category->update($categories);
                DB::commit();
                return redirect()->route('admin.categories.index')->with([
                    'status_succeed' => trans('message.update_category_success')
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
            $categories = Category::find($id);
            if ($categories) {
                DB::beginTransaction();
                $categories->delete();
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
