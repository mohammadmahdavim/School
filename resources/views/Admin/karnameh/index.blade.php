@extends('layouts.admin')
@section('css')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->

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
            <h3>درخواست</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت کارنامه ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">درخواست</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="/admin/karnameh.store">

                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">

                    <div class="col-md-6">

                        <div class="center-text">
                            <br>
                            <h6><label>نام کارنامه </label></h6>


                            <input type="text" id="name" class="form-control" name="name" placeholder="نام کارنامه درخواستی را بنویسید. مثال: کارنامه مهر و آبان">


                        </div>


                    </div>

                    <div class="col-md-6">


                    </div>




                    <div class="form-group">

                        <br>
                        <button class="btn btn-primary" type="submit">ذخیره و ارسال
                        </button>


                    </div>
                </div>

            </form>

        </div>
    </div>








@endsection('content')