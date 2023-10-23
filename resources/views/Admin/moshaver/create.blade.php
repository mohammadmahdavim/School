@extends('layouts.admin')
@section('css')

    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

@endsection('css')
@section('script')

    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
    <!-- end::datepicker -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد جلسه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">جلسات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد جلسه</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/moshaver/store" method="post" >

                {{csrf_field()}}
                @include('Admin.errors')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">ایجاد
                        جلسه</h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">

                    <div class=" col-md-6">
                        <br>
                        <label>نام مشاور</label>
                        <input style="text-align: center"
                               class="form-control"
                               type="text" id="techername" name="techername"
                               value="{!!  auth()->user()->f_name!!}-{!!  auth()->user()->l_name!!}" readonly>
                        <br>
                        <label>تاریخ جلسه </label>
                        <input style="text-align: center" type="text" name="date1" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date1')}}" required autocomplete="off">
                    </div>


                    <div class=" col-md-6">
                        <br>

                        <label>عنوان جلسه </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}">
                        <br>
                        <label>ساعت شروع</label>
                        <div class="m-b-40">

                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                                </div>
                                <input style="text-align: center" name="start" type="text" class="form-control"
                                       value="00:00">
                            </div>
                        </div>
                    </div>



                </div>
                <br>
                <div class="form-group , col-md-6" style="padding-right: 20px">
                    <div class="custom-control custom-switch">
                        <input onclick="check()" name="archive" type="checkbox" class="custom-control-input"
                               id="customSwitch">
                        <label class="custom-control-label" for="customSwitch">ایجاد جلسه آنلاین</label>
                    </div>
                </div>
                <div class="row" id="selectstudent" style="display: none">
                    <div class="col-md-4">
                        <br>
                        <label>فیلم ضبط شده کلاس</label>
                        <select class="form-control" name="record" id="record">
                            <option value="0">عدم دسترسی {{config('global.students')}}</option>
                            <option value="1">دسترسی {{config('global.students')}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label>تعداد مجاز ورود</label>
                        <input style="text-align: center" name="member" type="number" class="form-control"
                        >
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label>سرور</label>
                        <select class="form-control" name="server" id="server">
                            <option value="1">سرور اول</option>
                            <option value="2">سرور دوم </option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12 responsive">
                    <br>
                    <label>توضیحات </label>
                    <br>
                    <textarea id="editor-demo1" name="description"
                    >{{old('description')}}</textarea>
                </div>


                <br>

                <button class="btn btn-info" type="submit">ثبت جلسه
                </button>



            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('content')

<script>
    function check() {
        var checkBox = document.getElementById("customSwitch");
        var selectclass = document.getElementById("selectclass");
        var selectstudent = document.getElementById("selectstudent");
        if (checkBox.checked == true) {

            selectstudent.style.display = "block";
            selectclass.style.display = "none";
        } else {
            selectstudent.style.display = "none";
            selectclass.style.display = "block";
        }
    }
</script>


