@extends('layouts.admin')
@section('css')


    <!-- begin::swiper -->
    <link rel="stylesheet" href="/admin/vendors/swiper/swiper.min.css" type="text/css">
    <!-- end::swiper -->
@endsection('css')
@section('script')



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
                    <h3 class="card-title">{{$row->title}}</h3>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3" style="text-align: left">
                    <p class="navbar-text">{{$time}}</p>
                </div>

            </div>
            <div class="swiper-container text-center swiper-demo2">
                <div class="swiper-wrapper">
                    @foreach(\App\HomeImage::where('matlab_id',$row->id)->orderby('created_at', 'desc')->get() as $image)
                        <div class="swiper-slide">
                            <img src="{{url('images/'.$image->resize_image)}}"
                                 class="img-fluid" alt="...">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            {{--@endif--}}
            <br>
            <br>
            <br>
            <h5 class="card-title">{{$row->little_body}}</h5>

            <div class="mail-container-read">

                {!! $row->body !!}

            </div>
            <br>
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-1" style="text-align: left"><a href="/admin/roydad/edit/{{$row->id}}">
                        <button class="btn btn-primary">ویرایش</button>
                    </a></div>
                <br>
                <br>
                <div class="col-md-1" style="text-align: left"><a href="/admin/roydad/show/{{$row->place}}">
                        <button class="btn btn-dark">بازگشت</button>
                    </a></div>
            </div>

        </div>
    </div>

@endsection

