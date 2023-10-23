@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
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
    <!-- end::select2 -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ویرایش جلسه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">جلسات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش جلسه</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/moshaver/update/{{$row->id}}" method="post" >

                {{csrf_field()}}
                @include('Admin.errors')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">ویرایش
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
                               dir="ltr" value="{{$row->date}}" required autocomplete="off">
                    </div>


                    <div class=" col-md-6">
                        <br>

                        <label>عنوان جلسه </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{$row->title}}">
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
                                       value="{{$row->start}}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group , col-md-6" style="padding-right: 20px">
                    <div class="custom-control custom-switch">
                        <input @if($row->online==1) checked @endif onclick="check()" name="archive" type="checkbox" class="custom-control-input"
                               id="customSwitch">
                        <label class="custom-control-label" for="customSwitch">ایجاد جلسه آنلاین</label>
                    </div>
                </div>
                <div class="row" id="selectstudent" @if($row->online==0) style="display: none" @endif >
                    <div class="col-md-4">
                        <br>
                        <label>فیلم ضبط شده کلاس</label>
                        <select class="form-control" name="record" id="record">
                            <option @if($row->record==0) selected @endif value="0">عدم دسترسی {{config('global.students')}}</option>
                            <option @if($row->record==1) selected @endif value="1">دسترسی {{config('global.students')}}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label>تعداد مجاز ورود</label>
                        <input style="text-align: center" name="member" value="{{$row->member}}" type="number" class="form-control"
                        >
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label>سرور</label>
                        <select class="form-control" name="server" id="server">
                            <option @if($row->server==1) selected @endif value="1">سرور اول</option>
                            <option @if($row->server==2) selected @endif value="2">سرور دوم </option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-10 responsive">
                    <br>
                    <label>توضیحات </label>
                    <br>
                    <textarea id="editor-demo1" name="description"
                    >{{$row->description}}</textarea>
                </div>


                <br>
                <button class="btn btn-info" type="submit">ثبت جلسه
                </button>



            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script>
        kamaDatepicker('date1', {buttonsColor: "red"});

        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: false
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('date2', customOptions);

        kamaDatepicker('date3', {
            nextButtonIcon: "timeir_next.png"
            , previousButtonIcon: "timeir_prev.png"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
        });

        // for testing sync functionallity
        $("#date2").val("1311/10/01");
    </script>
    <script type="text/javascript">
        $(".chosen").chosen();
    </script>
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
@endsection('content')


