@extends('admin.layout.master')

@section('addcssadmin')
@endsection

@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans('language.cate')}}</h1>
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
                            <h3 class="card-title">{{trans('language.edit_cate')}}</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{route('admin.categories.update', ['id' => $categories->id]) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('language.cate_name')}}</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Nhập tên danh mục" name="name" value="{{old('name') ? old('name') : (isset($categories->name) ? $categories->name : '')}}">
                                    @error('name')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('language.slug')}}</label>
                                    <input type="text" class="form-control" id="convert_slug"  placeholder="Nhập slug" name="slug" value="{{old('slug') ? old('slug') : (isset($categories->slug) ? $categories->slug : '')}}">
                                    @error('slug')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">{{trans('language.image')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image" >
                                            <label class="custom-file-label" for="exampleInputFile">{{trans('language.choose_img')}}</label>
                                        </div>
                                    </div>
                                    {{-- @error('image')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror --}}
                                    <img class="img-pr" id="img_brand" src="{{ isset($categories) ? asset($categories->images) : '' }}" alt="your image" onerror="this.onerror=null;this.src='{{ asset('images/preview.png') }}';">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{trans('language.update')}}</button>
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
