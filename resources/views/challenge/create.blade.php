@extends('layouts.profile')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->

    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <br>
            <h3>ایجاد اتاق گفتمان جدید</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">اتاق گفتمان</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection('header')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="col-md-1" style="text-align: left"><a href="/login">
                    <button class="btn btn-danger">انصراف</button>
                </a></div>
            <form action="/challenge/store" method="post">
                {{csrf_field()}}
                @include('Admin.errors')

                <div class="row">
                    <div class="col-md-12">

                        <br>
                        <label>نام اتاق</label>

                        <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}">
                        <br>
                        <label>توضیحات اتاق</label>
                        <textarea name="description" id="editor-demo3"></textarea>
                    </div>

                    <br>
                    <div class="col-md-12" style="text-align: right">
                        <br>

                        <button type="submit" class="btn btn-primary">ذخیره و ارسال</button>


                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('content')