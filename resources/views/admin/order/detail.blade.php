@extends('admin.layout.master')

@section('addcssadmin')
@endsection
@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('language.order_detail') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ trans('language.order_detail') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @php
        $sum = 0;
    @endphp
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Urdan
                                    <small class="float-right">{{ trans('language.date_order') }}:
                                        {{ date_format($order->created_at, 'd/m/Y') }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                {{ trans('language.from_order') }}:
                                <address>
                                    <strong>Urdan Shop</strong><br>
                                    Tòa H10, Ngõ 475, Nguyễn Trãi<br>
                                    Thanh Xuân Nam, Thanh Xuân, Hà Nội<br>
                                    Phone: (804) 123-5432<br>
                                    Email: info_urdan@gmail.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                {{ trans('language.to_order') }}:
                                <address>
                                    <strong>{{ $order->name }}</strong><br>
                                    {{ $order->address }}<br>
                                    {{ $order->name_ward }}, {{ $order->name_district }}, {{ $order->name_city }}<br>
                                    Phone: {{ $order->phone }}<br>
                                    Email: j{{ $order->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>{{ trans('language.order') }}: </b><br>
                                <br>
                                <b>{{ trans('language.order_code') }}:</b> {{ $order->code }}<br>
                                @if ($order->payments == 1 || $order->payments == 4)
                                    <b>{{ trans('language.paid') }}:</b> {{ trans('language.un_paid') }}<br>
                                @else
                                    <b>{{ trans('language.paid') }}:</b> {{ trans('language.paid_susses') }}<br>
                                @endif
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ trans('language.stt') }}</th>
                                            <th class="text-center">{{ trans('language.product') }}</th>
                                            <th class="text-center">{{ trans('language.color') }}</th>
                                            <th class="text-center">{{ trans('language.price') }}</th>
                                            <th class="text-center">{{ trans('language.quantity') }}</th>
                                            <th class="text-center">{{ trans('language.subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetails as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ isset($idx) ? ($orderDetails->currentPage() - 1) * $orderDetails->perPage() + $idx + 1 : '' }}
                                                </td>
                                                <td class="text-center">{{ $item->product_name }}</td>
                                                <td class="text-center">{{ $item->color }}</td>
                                                <td class="text-center">{{ number_format($item->price) }}₫</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">
                                                    {{ number_format($item->quantity * $item->price) }}₫</td>
                                            </tr>
                                            @php
                                                $subtotal = $item->price * $item->quantity;
                                                $sum += $subtotal;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <span class="lead">{{ trans('language.payments') }}:</span><br>
                                <b>
                                    {!! \App\Models\Order::checkPaymets($order->payments) !!}
                                </b><br>
                                <div class="xxx" style="margin-top: 30px;">
                                    <span class="lead" style="margin-top: 30px;">{{ trans('language.status') }}:</span><br>
                                    <form id="status" action="{{route('admin.order.updateStatus', ['code' => $order->code])}}" method="POST">
                                        @csrf
                                        <select class="form-control" style="width:35%" name="status" id="">
                                            <option class="statussss" {{ $order->status == 1 ? 'selected' : '' }} value="1">
                                                {{ trans('language.unconfirm') }}</option>
                                            <option class="statussss" {{ $order->status == 2 ? 'selected' : '' }} value="2">
                                                {{ trans('language.delivery') }}</option>
                                            <option class="statussss" {{ $order->status == 3 ? 'selected' : '' }} value="3">
                                                {{ trans('language.successful') }}</option>
                                            <option class="statussss" {{ $order->status == 4 ? 'selected' : '' }} value="4">
                                                {{ trans('language.cancel') }}</option>
                                        </select>
                                        <input type="hidden" name="id" value="{{$order->id}}">
                                    </form>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">{{ trans('language.paid') }}</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">{{ trans('language.temporary_pay') }}:</th>
                                            <td>{{ number_format($sum) }}₫</td>
                                        </tr>
                                        @if (isset($order->coupon_id))
                                            <tr>
                                                <th>{{ trans('language.coupon_value') }}:</th>
                                                <td>{{ number_format(($sum * $order->value) / 100) }}₫</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>{{ trans('language.paid') }}:</th>
                                            <td>{{ number_format($sum - ($sum * $order->value) / 100) }}₫</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                                {{-- <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button> --}}
                                <a href="{{route('admin.order.pdf',['code' => $order->code])}}"><i class="fas fa-download"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('addjsadmin')
    <script src="{{ asset('assets/admin/dist/js/order.js') }}"></script>
@endsection
