@extends('layouts.student')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('css')
@endsection('css')
@section('script')


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>کارنامه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کارنامه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کارنامه ماهانه سایت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="card">
        <div class="card-body">
            <form action="/student/karnameh/render/month" method="post">
                {{csrf_field()}}
                <label> انتخاب ماه برای مشاهده کارنامه</label>

                <div class="row text-center justify-content-md-center">
                    <div class="col-md-3 m-t-b-20">
                        <select id="month" name="month" class="select2-dropdown form-control">
                            <option value="7">مهر</option>
                            <option value="8">آبان</option>
                            <option value="9">آذر</option>
                            <option value="10">دی</option>
                            <option value="11">بهمن</option>
                            <option value="12">اسفند</option>
                            <option value="1">فروردین</option>
                            <option value="2">اردیبهشت</option>
                            <option value="3">خرداد</option>
                        </select>
                    </div>
                    <div class="col-md-2 m-t-b-20">
                        <button class="btn btn-success">اعمال ماه</button>
                    </div>
                </div>
            </form>
            <div id="karnamehrender">

            </div>

        </div>

    </div>

@endsection('content')




