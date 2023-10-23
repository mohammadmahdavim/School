@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

@endsection('css')
@section('script')
    <script type="text/javascript" src="/assets/js/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/js/form_multiselect.js"></script>


    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد کلاس آنلاین</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کلاس آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد کلاس</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/online/store" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                        ایجاد کلاس آنلاین
                    </h4>
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
                        <label> نام دبیر </label>
                        <select id="teacher" name="teacher"
                                class="form-control">

                            @foreach($teachers as $teacher)
                                <option style="text-align: right" value="{{$teacher->id}}">
                                    {{$teacher->l_name}}-{{$teacher->f_name}}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <label>عنوان </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}">


                    </div>


                    <div class=" col-md-6" id="selectclass">
                        <br>
                        <label> کلاس </label>
                        <select id="rowteacher" name="class_id"
                                class="form-control">

                            @foreach($allclas as $allclass)
                                <option style="text-align: right" value="{{$allclass->classnamber}}">
                                    کلاس {{$allclass->classnamber}}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <label>درس </label>
                        <br>

                        <select id="dars" name="dars"
                                class="form-control">

                            @foreach($doros as $doro)
                                <option style="text-align: right">
                                    {{$doro->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <br>

                            <label>تاریخ شروع</label>
                            <input style="text-align: center" type="text" name="date" id="date-picker-shamsi"
                                   class="form-control text-right"
                                   dir="ltr" value="{{old('date')}}" required autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <br>

                            <label>تاریخ پایان</label>
                            <input style="text-align: center" type="text" name="date-picker-shamsi-list" id=""
                                   class="form-control text-right"
                                   dir="ltr" value="{{old('date-picker-shamsi-list')}}" required autocomplete="off">
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <br>

                            <label>ساعت پایان</label>
                            <div class="m-b-40">
                                <div class="input-group clockpicker-autoclose-demo">
                                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                                    </div>
                                    <input style="text-align: center" name="end" type="text" class="form-control"
                                           value="23:59">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>فیلم ضبط شده کلاس</label>
                            <select class="form-control" name="record" id="record">
                                <option value="0">عدم دسترسی {{config('global.students')}}</option>
                                <option value="1">دسترسی {{config('global.students')}}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>تعداد مجاز ورود</label>
                            <input style="text-align: center" name="member" type="number" class="form-control"
                            >
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>سرور</label>
                            <select class="form-control" name="server" id="server">
                                <option value="1">سرور اول</option>
                                <option value="2">سرور دوم</option>
                                <option value="sky">اسکای روم</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <label>روز</label>
                            <select class="form-control" name="day_id" id="day_id">
                                @foreach($days as $day)
                                    <option value="{{$day->id}}">
                                        {{$day->name}}

                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-10 responsive">
                        <br>
                        <label>توضیحات </label>
                        <br>
                        <textarea id="editor-demo1" name="description"
                        >{{old('description')}}</textarea>
                    </div>

                    <div class="form-group , col-md-10">
                        <br>
                        <label>آپلود فایل(طرح درس) </label>
                        <input type="file" id="file" name="file" class="form-control" value="{{old('file')}}">
                    </div>

                    <div class="form-group , col-md-12">

                        <br>
                        <button class="btn btn-info" type="submit">ایجاد
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection('content')
<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
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
