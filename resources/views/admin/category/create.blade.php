@extends('admin.layout.master')

@section('addcssadmin')
@endsection

@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thương Hiệu</h1>
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
                            <h3 class="card-title">Thêm Danh Mục</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Nhập tên danh mục" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" id="convert_slug"  placeholder="Nhập slug" name="slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Ảnh</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image" onchange="preview_thumbail(this);">
                                            <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                                        </div>
                                    </div>
                                    <img class="img-pr" id="img_brand" src="" alt="your image" onerror="this.onerror=null;this.src='{{ asset('images/preview.png') }}';">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm</button>
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
<script src="{{ asset('assets/admin/dist/js/show.js') }}"></script>
@endsection
