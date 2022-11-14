@extends('admin.layout.master')

@section('addcssadmin')
@endsection

@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brands</h1>
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
                            <div class="filter">
                                <div class="search-container">
                                    <form action="">
                                      <input type="text" placeholder="Search.." name="search">
                                      <button type="submit">Submit</button>
                                    </form>
                                  </div>
                                <a class="btn btn-success btn-sm rounded-0 create"
                                    href="{{ route('admin.categories.create') }}"><i class="fa fa-plus pad"></i>Thêm mới</a>
                            </div>

                        </div>
                        <!-- form start -->
                        <table class="table table-bordered table-image">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Tên danh mục</th>
                                    <th class="text-center" scope="col">Ảnh</th>
                                    <th class="text-center" scope="col-3">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $idx => $category)
                                    <tr br-name>
                                        <td class="text-center">
                                            {{ isset($idx) ? ($categories->currentPage() - 1) * $categories->perPage() + $idx + 1 : '' }}
                                        </td>
                                        <td class="text-center ">{{ $category->name }}</td>
                                        <td class="text-center"><img src="{{ asset($category->images) }}"  alt=""
                                                class="img-br"></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm rounded-0" href="{{ route('admin.categories.edit', ['id' => $category->id]) }}"><i class="fa fa-edit pad"></i>Sửa</a>
                                            @if($category->deleted_at  == null)
                                            <a class="btn btn-danger btn-sm rounded-0 deleteTable" href="{{ route('admin.brand.destroy', ['id' => $category->id]) }}"
                                                data-id="{{$category->id}}"
                                                data-title="{{trans('message.confirm_delete_brand')}}" 
                                                data-text="<span >{{$category->name}}</span>" 
                                                data-url="{{ route('admin.categories.destroy', ['id' => $category->id]) }}"
                                                data-method="DELETE" data-icon="question">
                                                <i class="fa fa-trash pad"></i>{{ trans('language.delete') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <div style="float: right; padding-right: 10px">
                                {{ $categories->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addjsadmin')
@endsection
