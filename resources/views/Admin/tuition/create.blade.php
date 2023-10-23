@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
@endsection('css')
@section('script')

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد شهریه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">شهریه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد شهریه</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/tuition" method="post">

                {{csrf_field()}}
                @include('Admin.errors')
                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">ایجاد
                        شهریه</h4>
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
                        <label>عنوان</label>
                        <br>
                        <br>
                        <input class="form-control" autocomplete="off" style="text-align: center" type="text"
                               name="title">
                    </div>

                    <div class=" col-md-6">
                        <br>
                        <label> کلاس (این شهریه شامل چه کلاس هایی می شود؟)</label>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" onclick="selectme()" class="custom-control-input" id="chkall">
                                <label class="custom-control-label" for="chkall">انتخاب همه</label>
                            </div>
                            <select id="classid" name="class_id[]"
                                    class="js-example-basic-single form-control" multiple>
                                @foreach($classschool as $classchool)
                                    <option style="text-align: right"
                                            value="{{$classchool->id}}">{{$classchool->classnamber}}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class=" col-md-6">
                        <br>
                        <label>مبلغ(ریال) </label>
                        <input style="text-align: center" type="number" name="price"
                               class="form-control text-right"
                               dir="ltr" autocomplete="off">
                    </div>

                    <div class=" col-md-6">
                        <br>
                        <label>فرصت پرداخت تا تاریخ ... </label>
                        <input style="text-align: center" type="text" name="date1" id="date-picker-shamsi-list"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date1')}}" autocomplete="off">
                    </div>


                    <div class="form-group , col-md-12">

                        <br>
                        <button class="btn btn-info" type="submit">ارسال
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

    <script>

        function selectme() {

            $('#classid').select2();
            if ($("#chkall").is(':checked')) {

                $('select').select2('destroy').find('option').prop('selected', 'selected').end().select2()

            } else {
                $('select').select2('destroy').find('option').prop('selected', false).end().select2()
            }
        }

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


