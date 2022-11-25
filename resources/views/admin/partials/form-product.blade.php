@extends('admin.layout.master')

@section('addcssadmin')
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.css') }}">
@endsection

@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('language.product') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">{{Route::is('admin.product.create') ? trans('language.create_pro') :  trans('language.edit_pro')}}</h3>
                        </div>
                        <form method="{{$method}}" action="{{$action}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{ trans('language.product_name') }}:</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Nhập tên sản phẩm" name="name"
                                    value="{{old('name') ? old('name') : (isset($product->name) ? $product->name : '')}}">
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.price') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá" name="price"
                                            value="{{old('price') ? old('price') : (isset($product->price) ? $product->price : '')}}">
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.price_dc') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá đã giảm" name="price_dc"
                                            value="{{old('price_dc') ? old('price_dc') : (isset($product->price_dc) ? $product->price_dc : '')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.qty') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập số lượng" name="qty"
                                            value="{{old('qty') ? old('qty') : (isset($product->quantity) ? $product->quantity : '')}}">
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.sku') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập SKU" name="sku" 
                                            value="{{old('sku') ? old('sku') : (isset($product->sku) ? $product->sku : '')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label>{{ trans('language.brand') }}:</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="brand_id">
                                                @php
                                                    $choose_brand = old('brand_id') ? old('brand_id') : (isset($product->brand_id) ? $product->brand_id : '');
                                                @endphp
                                                @foreach ($brands as $brand)
                                                    <option @if ($choose_brand == $brand->id) selected  @endif 
                                                    value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label>{{ trans('language.cate') }}</label>
                                            @php
                                           $item = old('category') ? collect(old('category')) : ( isset($proCates) && isset($product) ? $proCates : collect())
                                            @endphp
                                            <select class="select2bs4" multiple="multiple" data-placeholder="Chọn danh mục sản phẩm" style="width: 100%;" name="category[]">
                                                @foreach ($categories as $category)
                                                    <option value={{ $category->id }} {{ ($item->contains($category->id)) ? 'selected':'' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group area">
                                    <label for="exampleInputEmail1">{{ trans('language.pro_des') }}:</label>
                                    <textarea name="des" id="" >{{old('des') ? old('des') : (isset($product->description) ? $product->description : '')}}</textarea>
                                </div>
                                <div class="form-group area">
                                    <label for="exampleInputEmail1">{{ trans('language.pro_sort_des') }}:</label>
                                    <textarea name="sort_des" id="">{{old('sort_des') ? old('sort_des') : (isset($product->short_des) ? $product->short_des : '')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{ trans('language.image') }}:</label>
                                    <div id="actions" class="row">
                                        <div class="col-lg-12">
                                            <div class="btn-group w-100">
                                                <span id="upfile" class="btn btn-success col fileinput-button">
                                                    <i class="fas fa-plus"></i>
                                                    <span>{{ trans('language.upload_img') }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table table-striped files" id="previews">
                                        <div id="template" class="row mt-2 file-row">
                                            <div class="col-auto">
                                                <span class="preview"><img src="data:," alt=""
                                                        data-dz-thumbnail /></span>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <p class="mb-0">
                                                    <span class="lead" data-dz-name></span>
                                                    (<span data-dz-size></span>)
                                                </p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                            <div class="col-4 d-flex align-items-center">
                                                <div class="progress progress-striped active w-100" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;"
                                                        data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                    <div class="btn btn-danger delete xxxccc">
                                                        <i class="fas fa-trash"></i>
                                                        <span>{{ trans('language.delete') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="productImg[]">
                                        </div>
                                    </div>
                                    @if (isset($product) && $product->images)
                                    @foreach ($product->images as $item)
                                    <div class="table table-striped files">
                                        <div  class="row mt-2 file-row">
                                            <div class="col-auto">
                                                <span class="preview"><img src="{{asset($item)}}" alt="" data-dz-thumbnail/></span>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <p class="mb-0">
                                                    
                                                </p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                            <div class="col-4 d-flex align-items-center">
                                                <div class="progress progress-striped active w-100" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;"
                                                        data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                    <div class="btn btn-danger delete xxxccc">
                                                        <i class="fas fa-trash"></i>
                                                        <span>{{ trans('language.delete') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{$item}}" name="productImg[]">
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{Route::is('admin.product.create') ? trans('language.create') : trans('language.update')}}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('addjsadmin')
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/product.js') }}"></script>
@endsection
