@extends('layouts.teacher')
@section('css')

    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>

    <!-- end::select2 -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ثبت مورد انظباطی</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">ثبت مورد انظباطی</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="/teacher/discipline/index/{{$id}}">
                <button class="btn btn-outline-danger">مشاهده موارد ثبت شده</button>
            </a>
            <form method="POST" action="/teacher/discipline/store" autocomplete="off">

                {{csrf_field()}}
                @include('Admin.errors')

                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading" style="text-align: center">
                            <h5 class="panel-title">ثبت مورد انضباطی جدید</h5>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-4">
                                <br>
                                <label>نام {{config('global.student')}}</label>
                                <select class="js-example-basic-single" id="student" name="student" dir="rtl">
                                    <option value="">نام {{config('global.student')}} را بنویسید</option>
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->f_name}} {{$student->l_name}} -
                                            کلاس{{$student->class}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <br>
                                <label>مورد انضباطی </label>
                                <select class="form-control" id="discipline" name="discipline">
                                    <option value="">مورد انضباطی را انتخاب کنید</option>
                                    @foreach($disciplines as $discipline)
                                        <option value="{{$discipline->id}}">{{$discipline->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <br>
                                <label>تاریخ</label>
                                <input name="date"  id="date-picker-shamsi" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-12" style="text-align: center">
                            <label>توضیحات</label>
                            <input type="text" name="description" class="form-control">
                        </div>


                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button class="btn btn-primary btn-block">ثبت</button>
                            </div>
                        </div>
                    </div>

                </div>


        </div>

    </div>





@endsection('content')
