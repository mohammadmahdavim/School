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
            <h3 class="card-title" style="text-align: center">{{$row->title}}</h3>

            <h5 class="card-title" style="text-align: center">{{$row->little_body}}</h5>

            <div class="mail-container-read">

                {!! $row->body !!}

            </div>
            <br>
            <hr>
            <div class="row">
                <div class="form-group col-md-4">
                    <label><b>دسته بندی مخصوص نمونه کار ها</b><br></label>
                    <br>
                    <select name="tag" id="tag" class="form-control"
                    >
                        <option selected>{{\App\PortfolioDetail::where('home_id',$row->id)->first()['tag']}}</option>


                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><b>وضعیت</b><br></label>
                    <br>
                    <select name="status" id="status" class="form-control"

                    >
                        <option selected>{{\App\PortfolioDetail::where('home_id',$row->id)->first()['status']}}</option>

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><b>تاریخ شروع</b><br></label>
                    <input id="date1" type="text" name="date-picker-shamsi" class="form-control text-right"
                           dir="ltr" value="{{\App\PortfolioDetail::where('home_id',$row->id)->first()['date']}}" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label><b>مشتری</b><br></label>
                    <input type="text" id="Customer" name="Customer" class="form-control"
                           value="{{\App\PortfolioDetail::where('home_id',$row->id)->first()['Customer']}}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-1" style="text-align: left"><a href="/admin/Portfolio/edit/{{$row->id}}">
                        <button class="btn btn-primary">ویرایش</button>
                    </a></div>
                <br>
                <br>
                <div class="col-md-1" style="text-align: left"><a href="/admin/Portfolio/show">
                        <button class="btn btn-dark">بازگشت</button>
                    </a></div>
            </div>

        </div>
    </div>

@endsection

