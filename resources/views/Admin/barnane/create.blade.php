
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
            <h3>ایجاد</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت صفحه اول سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
                    <form method="POST" action="/admin/barnane/store" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('Admin.errors')



                        <div class="col-md-12">
                            <div class="center-text">
                                <h6><label>کلاس</label></h6>

                                <select type="text" id="classnamber" class="form-control" name="classnamber">
                                    <option></option>
                                    @foreach($claases as $claase)
                                        <option value="{{$claase->id}}">{{$claase->classnamber}} - {{$claase->paye}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="center-text">
                                <br>
                                <h6><label>آپلود فایل</label></h6>

                                <input type="file" id="file" class="form-control" name="file"
                                       >
                            </div>
                        </div>

                        <div class="form-group">

                            <br>
                            <button class="btn btn-primary" type="submit">ذخیره و و بروز رسانی برنامه
                            </button>


                        </div>

                    </form>

                </div>
            </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')



@endsection('content')