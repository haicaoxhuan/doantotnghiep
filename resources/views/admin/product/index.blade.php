@extends('admin.layout.master')

@section('addcssadmin')
@endsection
@section('bodyadmin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ trans('language.coupon') }}</h1>
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
                                    <th class="text-center " scope="col">{{ trans('language.coupon_name') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.value') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.qty') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.started_at') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.ended_at') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.status') }}</th>
                                    <th class="text-center " scope="col">{{ trans('language.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $idx => $coupon)
                                    <tr br-name>
                                        <td class="text-center">
                                            {{ isset($idx) ? ($coupons->currentPage() - 1) * $coupons->perPage() + $idx + 1 : '' }}
                                        </td>
                                        <td class="text-center">{{ $coupon->name }}</td>
                                        <td class="text-center">{{ $coupon->value }}%</td>
                                        <td class="text-center">{{ $coupon->quantity }}</td>
                                        <td class="text-center">{{ date('H:i d/m/Y', strtotime($coupon->started_at)) }}
                                        </td>
                                        <td class="text-center">{{ date('H:i d/m/Y', strtotime($coupon->ended_at)) }}</td>
                                        <td class="text-center">{!! \App\Models\Coupon::checkStatus($coupon->status) !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm rounded-0"
                                                href="{{ route('admin.coupon.edit', ['id' => $coupon->id]) }}"><i
                                                    class="fa fa-edit pad"></i>{{ trans('language.edit') }}</a>
                                            @if ($coupon->deleted_at == null)
                                                <a class="btn btn-danger btn-sm rounded-0 deleteTable"
                                                    href="{{ route('admin.coupon.destroy', ['id' => $coupon->id]) }}"
                                                    data-id="{{ $coupon->id }}"
                                                    data-title="{{ trans('message.confirm_delete_coupon') }}"
                                                    data-text="<span >{{ $coupon->name }}</span>"
                                                    data-url="{{ route('admin.coupon.destroy', ['id' => $coupon->id]) }}"
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
                                {{ $coupons->links('pagination::bootstrap-4') }}
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
