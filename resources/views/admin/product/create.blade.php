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
                            <h3 class="card-title">{{ trans('language.create_pro') }}</h3>
                        </div>
                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{ trans('language.product_name') }}:</label>
                                    <input type="text" class="form-control" id="slug"
                                        placeholder="Nhập tên sản phẩm" name="name">
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.price') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá"
                                                name="price">
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.price_dc') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá đã giảm"
                                                name="price_dc">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.qty') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập số lượng"
                                                name="qty">
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.sku') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập SKU"
                                                name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label>{{ trans('language.brand') }}:</label>
                                            <select class="form-control select2bs4" style="width: 100%;">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label>{{ trans('language.cate') }}</label>
                                            <select class="select2bs4" multiple="multiple"
                                                data-placeholder="Chọn danh mục sản phẩm" style="width: 100%;"
                                                name="category[]">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group area">
                                    <label for="exampleInputEmail1">{{ trans('language.pro_des') }}:</label>
                                    <textarea name="des" id=""></textarea>
                                </div>
                                <div class="form-group area">
                                    <label for="exampleInputEmail1">{{ trans('language.pro_sort_des') }}:</label>
                                    <textarea name="sort_des" id=""></textarea>
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
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ trans('language.create') }}</button>
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
