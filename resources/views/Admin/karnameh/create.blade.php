@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">

@endsection('css')
@section('script')
    <script type="text/javascript" src="/assets/js/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/js/form_multiselect.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">



@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تولید کارنامه</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <label style="text-align: center;color: black"> تولید کارنامه جدید</label>

            <form action="{{url('admin/karnameh/store') }}" method="post">

                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-3 m-t-b-20">
                        <label>نام کارنامه</label>
                        <input type="text"  name="name"
                               class="form-control text-right"
                               dir="ltr"
                                required autocomplete="off">
                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <label>از تاریخ</label>
                        <input type="text" id="date-picker-shamsi" name="start"
                               class="form-control text-right date-picker-shamsi"
                               dir="ltr"
                               placeholder="... از تاریخ" required autocomplete="off">
                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <label>تا تاریخ</label>
                        <input type="text" name="date-picker-shamsi-list" class="form-control text-right" dir="ltr"
                               placeholder=" ... تا تاریخ" required autocomplete="off">
                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <label>کلاس</label>
                        <div class="multi-select-full">
                            <select name="class[]" class="multiselect-info"
                                    style="text-align: right"
                                    multiple="multiple">
                                @foreach($class as $cla)
                                    <option value="{{$cla->	classnamber}}">{{$cla->classnamber}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit">تولید کارنامه
                        </button>
                    </div>

                </div>
            </form>
            <script src="/js/sweetalert.min.js"></script>
            @include('sweet::alert')
        </div>
    </div>

@endsection('content')

