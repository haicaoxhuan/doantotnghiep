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
                        <h3 class="card-title">
                            {{ Route::is('admin.product.create') ? trans('language.create_pro') :
                            trans('language.edit_pro') }}
                        </h3>
                    </div>
                    <form method="{{ $method }}" action="{{ $action }}" class="product-vali"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ trans('language.product_name') }}:</label>
                                <input type="text" class="form-control" id="slug" placeholder="Nhập tên sản phẩm"
                                    name="name"
                                    value="{{ old('name') ? old('name') : (isset($product->name) ? $product->name : '') }}">
                                @if ($errors->first('name'))
                                <div class="invalid-alert text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>


                            <div class="flex-bw">
                                <div class="pdl">
                                    <div class="form-group">
                                        <label>{{ trans('language.brand') }}:</label>
                                        <select class="form-control select2bs4" style="width: 100%;" name="brand_id"
                                            required>
                                            @php
                                            $choose_brand = old('brand_id') ? old('brand_id') :
                                            (isset($product->brand_id) ? $product->brand_id : '');
                                            @endphp
                                            @foreach ($brands as $brand)
                                            <option @if ($choose_brand==$brand->id) selected @endif
                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->first('brand_id'))
                                    <div class="invalid-alert text-danger">
                                        {{ $errors->first('brand_id') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="pdl">
                                    <div class="form-group">
                                        <label>{{ trans('language.cate') }}</label>
                                        @php
                                        $item = old('category') ? collect(old('category')) : (isset($proCates) &&
                                        isset($product) ? $proCates : collect());
                                        @endphp
                                        <select class="select2bs4" multiple="multiple"
                                            data-placeholder="Chọn danh mục sản phẩm" style="width: 100%;"
                                            name="category[]">
                                            @foreach ($categories as $category)
                                            <option value={{ $category->id }}
                                                {{ $item->contains($category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->first('category'))
                                        <div class="invalid-alert text-danger">
                                            {{ $errors->first('category') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="pdl">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ trans('language.sku') }}:</label>
                                        <input type="text" class="form-control" placeholder="Nhập SKU" name="sku"
                                            style="width: 100%;"
                                            value="{{ old('sku') ? old('sku') : (isset($product->sku) ? $product->sku : '') }}">
                                        @if ($errors->first('sku'))
                                        <div class="invalid-alert text-danger">
                                            {{ $errors->first('sku') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="detail">
                                <label>{{ trans('language.pro_detail') }}:</label>
                                <div class="pro-item">
                                    <div class="item">
                                        <label for="exampleInputEmail1">{{ trans('language.color') }}:</label>
                                        <input type="text" class="form-control" placeholder="Nhập màu" name="color[]"
                                            style="width: 100%;"
                                            value="{{ old('color') ? old('color') : (isset($product->productDetail->color) ? $product->productDetail->color : '') }}">
                                        @if ($errors->first('color'))
                                        <div class="invalid-alert text-danger">
                                            {{ $errors->first('color') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="item">
                                        <label for="exampleInputEmail1">{{ trans('language.price') }}:</label>
                                        <input type="text" class="form-control" placeholder="Nhập giá" name="price[]"
                                            value="{{ old('price') ? old('price') : (isset($product->productDetail->price) ? $product->productDetail->price : '') }}">
                                        @if ($errors->first('price'))
                                        <div class="invalid-alert text-danger">
                                            {{ $errors->first('price') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="item">
                                        <label for="exampleInputEmail1">{{ trans('language.qty') }}:</label>
                                        <input type="text" class="form-control" placeholder="Nhập số lượng" name="qty[]"
                                            value="{{ old('qty') ? old('qty') : (isset($product->productDetail->quantity) ? $product->productDetail->quantity : '') }}">
                                        @if ($errors->first('qty'))
                                        <div class="invalid-alert text-danger">
                                            {{ $errors->first('qty') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="item">
                                        <label for="exampleInputEmail1">{{ trans('language.color_code') }}:</label>
                                        <input class="color" name="color_code[]" type="color"
                                            value="{{ old('color_code') ? old('color_code') : (isset($product->productDetail->color_code) ? $product->productDetail->color_code : '') }}">
                                        @if ($errors->first('color_code'))
                                        <div class="invalid-alert text-danger">
                                            {{ $errors->first('color_code') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="item">
                                        <label for="exampleInputEmail1"></label>
                                        <div class="plus xxx"><i class="fa fa-plus-circle"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group area">
                                <label for="exampleInputEmail1">{{ trans('language.pro_des') }}:</label>
                                <textarea name="des"
                                    id="">{{ old('des') ? old('des') : (isset($product->description) ? $product->description : '') }}</textarea>
                                @if ($errors->first('des'))
                                <div class="invalid-alert text-danger">
                                    {{ $errors->first('des') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group area">
                                <label for="exampleInputEmail1">{{ trans('language.pro_sort_des') }}:</label>
                                <textarea name="sort_des"
                                    id="">{{ old('sort_des') ? old('sort_des') : (isset($product->short_des) ? $product->short_des : '') }}</textarea>
                                @if ($errors->first('sort_des'))
                                <div class="invalid-alert text-danger">
                                    {{ $errors->first('sort_des') }}
                                </div>
                                @endif
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
                                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
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
                                    <div class="row mt-2 file-row">
                                        <div class="col-auto">
                                            <span class="preview"><img src="{{ asset($item) }}" alt=""
                                                    data-dz-thumbnail /></span>
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
                                        <input type="hidden" value="{{ $item }}" name="productImg[]">
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ Route::is('admin.product.create') ?
                                trans('language.create') : trans('language.update') }}</button>
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
<script>
    $(document).on("click",".plus", function () {
        $('.plus').remove();
        $('.detail').append(`
                                    <div class="pro-item">
                                        <div class="item">
                                            <label for="exampleInputEmail1">{{ trans('language.color') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập màu" name="color[]"
                                                style="width: 100%;"
                                                value="{{ old('color') ? old('color') : (isset($product->color) ? $product->color : '') }}">
                                            @if ($errors->first('color'))
                                                <div class="invalid-alert text-danger">
                                                    {{ $errors->first('color') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item">
                                            <label for="exampleInputEmail1">{{ trans('language.price') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá" name="price[]"
                                                value="{{ old('price') ? old('price') : (isset($product->price) ? $product->price : '') }}">
                                            @if ($errors->first('price'))
                                                <div class="invalid-alert text-danger">
                                                    {{ $errors->first('price') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item">
                                            <label for="exampleInputEmail1">{{ trans('language.qty') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập số lượng"
                                                name="qty[]"
                                                value="{{ old('qty') ? old('qty') : (isset($product->quantity) ? $product->quantity : '') }}">
                                            @if ($errors->first('qty'))
                                                <div class="invalid-alert text-danger">
                                                    {{ $errors->first('qty') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item">
                                            <label for="exampleInputEmail1">{{ trans('language.color_code') }}:</label>
                                            <input class="color" name="color_code[]" type="color"
                                                value="{{ old('color_code') ? old('color_code') : (isset($product->color_code) ? $product->color_code : '') }}">
                                            @if ($errors->first('color_code'))
                                                <div class="invalid-alert text-danger">
                                                    {{ $errors->first('color_code') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item">
                                            <label for="exampleInputEmail1"></label>
                                            <div class="plus xxx"><i class="fa fa-plus-circle"></i></div>
                                        </div>
                                    </div>
                                    `)                                        
    });
</script>
@endsection