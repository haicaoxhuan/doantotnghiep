@extends('admin.layout.master')

@section('addcssadmin')
@endsection
@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('language.order') }}</h1>
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
                                    href="{{ route('admin.coupon.create') }}"><i
                                        class="fa fa-plus pad"></i>{{ trans('language.create') }}</a>
                            </div>

                        </div>
                        <!-- form start -->
                        <table class="table table-bordered table-image">
                            <thead>
                                <tr>
                                    <th class="text-center " scope="col">#</th>
                                    <th class="text-center " scope="col">{{ trans('language.order_code') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.payments') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.status') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $idx => $order)
                                    <tr br-name>
                                        <td class="text-center">
                                            {{ isset($idx) ? ($orders->currentPage() - 1) * $orders->perPage() + $idx + 1 : '' }}
                                        </td>
                                        <td class="text-center">{{ $order->code }}</td>
                                        <td class="text-center">{!! \App\Models\Order::checkPaymets($order->payments) !!}</td>
                                        <td class="text-center">{!! \App\Models\Order::checkStatus($order->status) !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm rounded-0"
                                                href="{{ route('admin.order.detail', ['code' => $order->code]) }}"><i class="fa fa-info-circle" aria-hidden="true"></i></i>{{ trans('language.order_detail') }}</a>
                                            @if ($order->deleted_at == null)
                                                <a class="btn btn-danger btn-sm rounded-0 deleteTable"
                                                    href="{{ route('admin.order.destroy', ['id' => $order->id]) }}"
                                                    data-id="{{ $order->id }}"
                                                    data-title="{{ trans('message.confirm_delete_coupon') }}"
                                                    data-text="<span >{{ $order->code }}</span>"
                                                    data-url="{{ route('admin.order.destroy', ['id' => $order->id]) }}"
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
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addjsadmin')
@endsection
