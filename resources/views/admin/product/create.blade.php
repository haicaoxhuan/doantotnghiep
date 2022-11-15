@extends('admin.layout.master')

@section('addcssadmin')
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/product.css') }}">
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
                        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
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
                                <div class="form-group area">
                                    <label for="exampleInputEmail1">{{ trans('language.pro_des') }}:</label>
                                    <textarea name="des" id="" ></textarea>
                                </div>
                                <div class="form-group area">
                                    <label for="exampleInputEmail1">{{ trans('language.pro_sort_des') }}:</label>
                                    <textarea name="sort_des" id="" ></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

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
@endsection
