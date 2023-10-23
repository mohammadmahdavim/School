@extends('layouts.teacher')
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
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
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
    <!-- end::select2 -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد تکلیف</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تکالیف</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد تکلیف</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/teacher/uploadtamri.store" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                @method('put')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">آپلود
                        تمرین</h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="form-group , col-md-6" style="padding-right: 20px">
                    <div class="custom-control custom-switch">
                        <input onclick="check()" name="archive" type="checkbox" class="custom-control-input"
                               id="customSwitch">
                        <label class="custom-control-label" for="customSwitch">قرار گرفتن در آرشیو</label>
                    </div>
                </div>
                <div class="row">

                    <div class=" col-md-6">
                        <br>
                        <label>نام دبیر</label>
                        <input style="text-align: center"
                               class="form-control"
                               type="text" id="techername" name="techername"
                               value="{!!  auth()->user()->f_name!!}-{!!  auth()->user()->l_name!!}" readonly>
                        <br>
                        <label>فرصت تحویل تا تاریخ ... </label>
                        <input style="text-align: center" type="text" name="date1" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date1')}}" required autocomplete="off">
                        <label>فرصت تحویل تا ساعت ... </label>
                        <div class="m-b-40">

                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                                </div>
                                <input style="text-align: center" name="time" type="text" class="form-control"
                                       value="00:00:00">
                            </div>
                        </div>

                    </div>


                    <div class=" col-md-6" id="selectclass">
                        <br>
                        <label>درس و کلاس </label>
                        <select id="rowteacher" name="rowteacher"
                                class="form-control">

                            @foreach($allclas as $allclass)
                                <option style="text-align: right" value="{{$allclass->id}}">
                                    درس {{$allclass->darss[0]->name}} کلاس {{$allclass->class[0]->classnamber}}
                                </option>
                            @endforeach
                        </select>
                        <br>

                        <div class=" col-md-6">

                            <label>نمره </label>
                            <br>
                            <input style="text-align: center" type="text" id="mark" name="mark"
                                   class="form-control" value="{{old('mark')}}">
                        </div>
                        <div class="form-group , col-md-6" style="padding-right: 20px">
                            <div class="custom-control custom-switch">
                                <input   name="mark_status" type="checkbox" class="custom-control-input"
                                         id="mark_status">
                                <br>
                                <label class="custom-control-label" for="mark_status">این تمرین در کارنامه لحاظ شود؟</label>
                            </div>

                        </div>
                    </div>
                    <div class=" col-md-6">
                        <br>

                        <label>عنوان تمرین </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}">
                    </div>
                    <div class="col-md-6 m-t-b-20" id="selectstudent" style="display: none">
                        <label>افراد</label>

                        <div class="multi-select-full" >
                            <select name="users[]" class="multiselect-info"
                                    style="text-align: right"
                                    multiple="multiple">

                                @foreach($allstudents as $allstudent)
                                    <option value="{{$allstudent->id}}"
                                    >{{$allstudent->f_name}} {{$allstudent->l_name}}- کلاس {{$allstudent->class}}</option>
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
                        <label>آپلود فایل </label>
                        <input type="file" id="file" name="file" class="form-control" value="{{old('file')}}">
                    </div>
                    <div class="form-group , col-md-10">
                        <br>
                        <label>آپلود فایل پاسخ</label>
                        <input type="file" id="file2" name="file2" class="form-control" value="{{old('file2')}}">
                    </div>


                    <div class="form-group , col-md-12">

                        <br>
                        <button class="btn btn-info" type="submit">ارسال تکلیف
                        </button>

                    </div>

                </div>
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
