@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->

@endsection('css')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ویرایش آزمون</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش آزمون</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/teacher/exam/update/sync/{{$exam->id}}" method="put" >

                {{csrf_field()}}
                @include('Admin.errors')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                        ویرایش آزمون جدید
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
                    <div class="form-group , col-md-6" style="padding-right: 20px">
                        <div class="custom-control custom-switch">
                            <input onclick="check()" @if($exam->archive==1) checked @endif  name="archive" type="checkbox" class="custom-control-input" id="customSwitch" >
                            <label class="custom-control-label" for="customSwitch">قرار گرفتن در آرشیو</label>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class=" col-md-6">
                        <br>
                        <label>نام دبیر</label>
                        <input style="text-align: center"
                               class="form-control"
                               type="text" id="techername" name="techername"
                               value="{!!  auth()->user()->f_name!!}-{!!  auth()->user()->l_name!!}" readonly disabled>
                        <br>
                        <label>فرصت آزمون تا تاریخ ... </label>
                        <input style="text-align: center" type="text" name="date1" id="date-picker-shamsi-list"
                               class="form-control text-right"
                               dir="ltr"  value="{{$exam->expire}}" required autocomplete="off">
                    </div>


                    <div class=" col-md-6">
                        <br>
                        <label>عنوان آزمون </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control"  value="{{$exam->title}}" required>
                        <br>
                        <label>زمان آزمون</label>
                        <input class="form-control" type="number" required name="time"  value="{{$exam->time}}">
                        <br>

                    </div>
                    <div class=" col-md-6" @if($exam->archive==1) style="display:none" @endif id="selectclass">


                        <label>درس و کلاس </label>
                        <select id="rowteacher" name="rowteacher[]" multiple
                                class="js-example-basic-single form-control" >

                            @foreach($allclas as $allclass)
                                <option style="text-align: right" value="{{$allclass->id}}">
                                    درس {{$allclass->darss[0]->name}} کلاس {{$allclass->class[0]->classnamber}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group , col-md-12">

                        <br>
                        <button class="btn btn-info" type="submit">ایجاد آزمون
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
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

@endsection('script')


<script>
    function check() {
        var checkBox = document.getElementById("customSwitch");
        var selectclass = document.getElementById("selectclass");
        if (checkBox.checked == true){

            selectclass.style.display = "none";
        } else {
            selectclass.style.display = "block";
        }
    }
</script>
