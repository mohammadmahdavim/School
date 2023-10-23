@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->

    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

@endsection('css')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد آزمون</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد آزمون</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/teacher/exam" method="post" autocomplete="off" enctype="multipart/form-data">
                <input style="text-align: center"
                       class="form-control" hidden
                       type="text" id="techername" name="techername"
                       value="{!!  auth()->user()->f_name!!}-{!!  auth()->user()->l_name!!}" readonly disabled>
                {{csrf_field()}}
                @include('Admin.errors')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                        ایجاد آزمون جدید
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
                <div class="form-group , col-md-6" style="padding-right: 20px">
                    <div class="custom-control custom-switch">
                        <input onclick="check()" name="archive" type="checkbox" class="custom-control-input"
                               id="customSwitch">
                        <label class="custom-control-label" for="customSwitch">قرار گرفتن در آرشیو</label>
                    </div>

                </div>

                <div class="row">

                    <div class=" col-md-6">

                        <label>فرصت آزمون از تاریخ ... </label>
                        <input style="text-align: center" type="text" name="date1" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date1')}}" required autocomplete="off">
                        <br>
                        <label>فرصت آزمون تا تاریخ ... </label>
                        <input style="text-align: center" type="text" name="date-picker-shamsi-list" id=""
                               class="form-control text-right "
                               dir="ltr" value="{{old('date-picker-shamsi-list')}}" required autocomplete="off">
                        <br>
                        <label>از ساعت</label>
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
                        <label>تا ساعت</label>
                        <div class="m-b-40">
                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                                </div>
                                <input style="text-align: center" name="texpire" type="text" class="form-control"
                                       value="23:59">
                            </div>
                        </div>

                    </div>

                    <div class=" col-md-6">
                        <label>عنوان آزمون </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}" required>
                        <br>
                        <label>زمان آزمون</label>
                        <input style="text-align: center" class="form-control" type="number" required name="time"
                               placeholder="زمان آزمون را به دقیقه وارد نمایید." value="{{old('time')}}">
                        <br>
                        <label>تعداد سوالات</label>
                        <input style="text-align: center" class="form-control" type="number" required
                               name="countquestions" value="{{old('countquestions')}}"
                               placeholder="تعداد سوالی که هر {{config('global.student')}} پاسخ می دهد.">
                        <br>
                        <br>

                        <label>انتخاب فایل سوالات(اختیاری) </label>
                        <input style="text-align: center" type="file" id="file" name="file"
                               class="form-control">
                        <br>
                    </div>
                    <div class="col-md-6">


                        <br>
                        <div class="form-group card-body" style="background-color: #f6f6f8">
                            <label>نوع آزمون را مشخص کنید.</label>
                            {{--                   --}}
                            <div class="form-group">

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio" name="type" class="custom-control-input"
                                           checked value="0">
                                    <label class="custom-control-label" for="customRadio">آزمون تستی</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="type"
                                           class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customRadio2">آزمون تشریحی</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">


                        <br>
                        <div class="form-group card-body" style="background-color: #f6f6f8">
                            <label>نوع ترتیب سوالات </label>
                            {{--                   --}}
                            <div class="form-group">

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioRandom" name="random" class="custom-control-input"
                                           checked value="0">
                                    <label class="custom-control-label" for="customRadioRandom">به ترتیب</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioRandom2" name="random"
                                           class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customRadioRandom2">تصادفی</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-6" id="selectclass">

                        <label>درس و کلاس </label>
                        <select id="rowteacher" name="rowteacher[]" multiple
                                class="js-example-basic-single form-control">

                            @foreach($allclas as $allclass)
                            @if($allclass->darss!='[]' and $allclass->class!='[]')
                                <option style="text-align: right" value="{{$allclass->id}}">
                                    درس {{$allclass->darss[0]->name}} کلاس {{$allclass->class[0]->classnamber}}
                                </option>
                                @endif
                            @endforeach
                        </select>

                        <div class="form-group , col-md-6" style="padding-right: 20px">
                            <div class="custom-control custom-switch">
                                <input   name="mark_status" type="checkbox" class="custom-control-input"
                                       id="mark_status">
                                <br>
                                <label class="custom-control-label" for="mark_status">این آزمون در کارنامه لحاظ شود؟</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-12">

                        <br>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">ایجاد آزمون
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>

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

    </script>
@endsection('content')
@section('script')

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
@endsection('script')


<script>
    function check() {
        var checkBox = document.getElementById("customSwitch");
        var selectclass = document.getElementById("selectclass");
        if (checkBox.checked == true) {
            selectclass.style.display = "none";
        } else {
            selectclass.style.display = "block";
        }
    }
</script>
