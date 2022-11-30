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
                            <h3 class="card-title">
                                {{ Route::is('admin.coupon.create') ? trans('language.create_coupon') : trans('language.edit_coupon') }}
                            </h3>
                        </div>
                        <form method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.coupon_name') }}:</label>
                                            <input type="text" class="form-control" id="slug"
                                                placeholder="Nhập tên mã giảm giá" name="name"
                                                value="{{ old('name') ? old('name') : (isset($coupon->name) ? $coupon->name : '') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.coupon_code') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập mã giảm giá"
                                                name="code"
                                                value="{{ old('code') ? old('code') : (isset($coupon->code) ? $coupon->code : '') }}">
                                            @error('code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.value') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập giá trị"
                                                name="value"
                                                value="{{ old('value') ? old('value') : (isset($coupon->value) ? $coupon->value : '') }}">
                                            @error('value')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ trans('language.qty') }}:</label>
                                            <input type="text" class="form-control" placeholder="Nhập số lượng"
                                                name="qty"
                                                value="{{ old('qty') ? old('qty') : (isset($coupon->quantity) ? $coupon->quantity : '') }}">
                                            @error('qty')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-bw">
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label>{{ trans('language.started_at') }}:</label>
                                            <div class="input-group date" id="reservationdatetime2"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#reservationdatetime2" name="start"
                                                    placeholder="Nhập thời gian bắt đầu"
                                                    value="{{ old('start') ? old('start') : (isset($coupon->started_at) ? date('d/m/Y H:i', strtotime($coupon->started_at)) : '') }}" />
                                                <div class="input-group-append" data-target="#reservationdatetime2"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('start')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="pdl">
                                        <div class="form-group">
                                            <label>{{ trans('language.ended_at') }}:</label>
                                            <div class="input-group date" id="reservationdatetime"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#reservationdatetime" name="end"
                                                    placeholder="Nhập thời gian kết thúc"
                                                    value="{{ old('end') ? old('end') : (isset($coupon->ended_at) ? date('d/m/Y H:i', strtotime($coupon->ended_at)) : '') }}" />
                                                <div class="input-group-append" data-target="#reservationdatetime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('end')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-primary">{{ Route::is('admin.coupon.create') ? trans('language.create') : trans('language.update') }}</button>
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
    <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/coupon.js') }}"></script>
@endsection
