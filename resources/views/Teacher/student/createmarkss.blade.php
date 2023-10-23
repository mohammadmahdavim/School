@extends('layouts.teacher')
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
            <h3>ایجاد آیتم نمره دهی درس {{$darss->name}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمره</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        ایجاد آیتم نمره دهی درس {{$darss->name}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')




    {{--<div style="text-align: left;padding-top: 20px;padding-left: 20px">--}}
    {{--<div class="table-responsive"><a href="/teacher/viewmark/{{$idc}}">--}}

    {{--</a></div>--}}
    {{--</div>--}}
    <div class="card">
        <div class="card-body">
            <div class="row  ">
                <div class="col-md-4 m-t-b-20" style="text-align:right">
                    <button class="btn btn-danger">تا الان برای این درس {{$items}} آیتم وارد کردید</button>

                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 m-t-b-20" style="text-align: left">
                    <a href="/teacher/viewmark/{{$idc}}/{{$idd}}">
                        <button class="btn btn-success"><span
                            >  تا حالا چه آیتم هایی ایجاد کردم؟   <i class="icon-move-left"
                                                                     style="color: #0a6aa1"></i>  </span>
                        </button>
                    </a>
                </div>
            </div>
            <form action="/teacher/createmark" method="post">
                {{--<form action="{{route('profile.update', auth()->user()->id)}}" method="patch"  >--}}
                {{csrf_field()}}
                @include('Admin.errors')
                @method('put')

                <div class="row">

                    <div class="col-md-6">
                        <br>
                        <label>نام و نام خانوداگی دبیر </label>
                            <input class="form-control" type="text"
                                   value="{{auth()->user()->f_name}} {{auth()->user()->l_name}}"
                                   id="name" name="name" readonly>

                        <br>

                        <label>درس </label>

                        <select class="form-control" name="dars" id="dars">
                            <option value="{{$darss->id}}">{{$darss->name}}-{{$darss->paye}}</option>
                        </select>

                    </div>


                    <div class="col-md-6">

                        <br>
                        <label>نام آیتم</label>

                        <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" placeholder="مثال:کلاسی" required>

<br>
                        <label>کلاس </label>

                        <select class="form-control" id="classid" name="classid">
                            <option value="{{$classid}}">{{$classid}}</option>
                        </select>
                        <input class="form-control" style="text-align: center" type="text" id="max" name="max" value="{{20}}"  hidden="hidden">


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