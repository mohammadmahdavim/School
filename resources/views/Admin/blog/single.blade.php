@extends('layouts.admin')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/admin/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->

    <!-- begin::swiper -->
    <link rel="stylesheet" href="/admin/vendors/swiper/swiper.min.css" type="text/css">
    <!-- end::swiper -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/admin/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/admin/js/examples/datatable.js"></script>
    <!-- end::dataTable -->


    <!-- begin::swiper -->
    <script src="/assets/vendors/swiper/swiper.min.js"></script>
    <script src="/assets/js/examples/swiper.js"></script>
    <!-- end::swiper -->
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
            <h3>

                نمایش تکی مطالب سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت صفحه اول سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش تکی</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')



    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-3" style="text-align: center">
                    <h3 class="card-title">{{$blog->title}}</h3>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3" style="text-align: left">
                    <p class="navbar-text">{{$blog->created_at->toDateString()}}</p>
                </div>

            </div>

            <div style="text-align: center">
                <div class="swiper-slide">
                    <img src="{{url('images/'.$blog->filename)}}"
                         class="img-fluid" alt="...">
                </div>
            </div>

            <br>

            <br>
            <br>
            <h5 class="card-title">{{$blog->little_body}}</h5>
            <hr>
            <div class="mail-container-read">

                {!! $blog->body !!}

            </div>
            <div class="row">
                <div class="col-md-10"></div>
                <br>
                <br>
                <div class="col-md-1" style="text-align: left"><a href="/admin/Blog/view">
                        <button class="btn btn-dark">بازگشت</button>
                    </a></div>
            </div>

        </div>

@endsection

