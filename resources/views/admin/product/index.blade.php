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
                            <div class="filter">
                                <div class="search-container">
                                    <form action="">
                                      <input type="text" placeholder="Search.." name="search">
                                      <button type="submit">Submit</button>
                                    </form>
                                  </div>
                                <a class="btn btn-success btn-sm rounded-0 create"
                                    href="{{ route('admin.product.create') }}"><i class="fa fa-plus pad"></i>{{trans('language.create')}}</a>
                            </div>

                        </div>
                        <!-- form start -->
                        <table class="table table-bordered table-image">
                            <thead>
                                <tr>
                                    <th class="text-center stt" scope="col">#</th>
                                    <th class="text-center pro-name" scope="col">{{trans('language.product_name')}}</th>
                                    <th class="text-center pro-img" scope="col">{{trans('language.image')}}</th>
                                    <th class="text-center pro-price" scope="col">{{trans('language.price')}}</th>
                                    <th class="text-center pro-pricedc" scope="col">{{trans('language.price_dc')}}</th>
                                    <th class="text-center qty" scope="col">{{trans('language.qty')}}</th>
                                    <th class="text-center sku" scope="col">{{trans('language.sku')}}</th>
                                    <th class="text-center featured" scope="col">{{trans('language.featured')}}</th>
                                    <th class="text-center action" scope="col">{{trans('language.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $idx => $product)
                                    <tr br-name>
                                        <td class="text-center">
                                            {{ isset($idx) ? ($products->currentPage() - 1) * $products->perPage() + $idx + 1 : '' }}
                                        </td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center"> <img src="{{ asset($product->images[0]) }}"  alt=""class="img-br"></td>
                                        <td class="text-center">{{number_format($product->price)}}đ</td>
                                        <td class="text-center">{{number_format(isset($product->price_dc) ? $product->price_dc : 0)}}đ</td>
                                        <td class="text-center">{{$product->quantity}}</td>
                                        <td class="text-center">{{$product->sku}}</td>
                                        <td class="text-center">{!! \App\Models\Product::checkFeatured($product->featured) !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm rounded-0" href="{{ route('admin.product.edit', ['id' => $product->id]) }}"><i class="fa fa-edit pad"></i>{{ trans('language.edit') }}</a>
                                            @if($product->deleted_at  == null)
                                            <a class="btn btn-danger btn-sm rounded-0 deleteTable" href="{{ route('admin.product.destroy', ['id' => $product->id]) }}"
                                                data-id="{{$product->id}}"
                                                data-title="{{trans('message.confirm_delete_product')}}" 
                                                data-text="<span >{{$product->name}}</span>" 
                                                data-url="{{ route('admin.product.destroy', ['id' => $product->id]) }}"
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
                                {{ $products->links('pagination::bootstrap-4') }}
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
