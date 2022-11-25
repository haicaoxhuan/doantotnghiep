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
    @include('admin.partials.form-product', [
        'action'=> route('admin.product.store'),
        'method'=>'post',
        'categories' => $categories,
        'brands' => $brands
        ])
@endsection
@section('addjsadmin')
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/product.js') }}"></script>
@endsection
