@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ارسال مطلب</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مطلب ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ارسال مطلب</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/uploadeducational.store" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                @method('put')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">آپلود
                        مطلب</h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group , col-md-6">
                        <br>
                        <br>
                        <label>عنوان مطلب </label>
                        <br>
                        <input type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}"
                               placeholder="لطفا برای مطلب خود عنوانی بنویسید">
                    </div>

                    <div class="form-group col-md-10 responsive">
                        <br>
                        <label>توضیحات(درصورت نیاز) </label>
                        <br>
                        <textarea id="editor-demo1" name="description"
                        >{{old('description')}}</textarea>
                    </div>

                    <div class="form-group , col-md-10">
                        <br>
                        <label>آپلود فایل </label>
                        <input type="file" id="file" name="file" class="form-control" value="{{old('file')}}"
                               >
                    </div>
                    <div class="form-group , col-md-12">

                        <br>
                        <button class="btn btn-info" type="submit">ارسال مطلب
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script type="text/javascript">
        $(".chosen").chosen();
    </script>
@endsection('content')


