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
            <h3>بارگذاری اکسل</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">بارگذاری اکسل</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p style="color: #bb1111">توجه: لطفا ابتدا اکسل نمونه زیر را دانلود کرده و با ثابت نگه داشتن سر ستون
                        ها اطلاعات {{config('global.students')}} را کپی کرده واین اکسل را بارگذاری نمایید. <br>
                        <b>ستون های نام ـ نام خانوادگی ـ کد ملی ـ  پایه ـ شماره کلاس (به عدد)  اجباری می باشد.</b>
                        <br>
                        <a class="btn btn-outline-danger" download=""
                           href="{{ \Illuminate\Support\Facades\Storage::url('Users.xlsx') }}" title="users"> دانلود
                            اکسل نمونه</a>
                    </p>
                    <br>
                    <p>برای دانلود اطلاعات بارگذاری شده روی باکس های زیر کلیک نمایید.</p>
                    <a href="{{ url('admin/downloadExcel/xls') }}">
                        <button class="btn btn-dark">دانلود اکسل xls</button>
                    </a>
                    <a href="{{ url('admin/downloadExcel/xlsx') }}">
                        <button class="btn btn-dark">دانلود اکسل xlsx</button>
                    </a>
                    <a href="{{ url('admin/downloadExcel/csv') }}">
                        <button class="btn btn-dark">دانلود با فرمت CSV</button>
                    </a>

                    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
                          action="{{ url('admin/importExcel') }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <span>کد ملی های تکراری</span>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import_file" name="import_file"
                                   accept=".xlsx">
                            <label class="custom-file-label" for="customFile">انتخاب اکسل</label>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-primary">بارگذاری فایل <i
                                    class="icon-arrow-left13 position-right"></i></button>
                    </form>
                    <script src="/js/sweetalert.min.js"></script>
                    @include('sweet::alert')
                </div>
            </div>
        </div>
    </div>

@endsection('content')
