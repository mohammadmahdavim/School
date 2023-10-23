@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <style>
        hr {
            border-top: 2px dashed red;
        }
    </style>
@endsection('css')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد سوال برای آزمون {{$exam->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد سوال برای آزمون {{$exam->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/teacher/exam/questions" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                <input name="exam_id" value="{{$exam->id}}" hidden>
                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                        ایجاد سوال برای آزمون {{$exam->title}}                    </h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div id="questions">
                    <div id="questions0">

                        <div class="row">


                            <div class="col-md-12">
                                <br>
                                <label>صورت سوال </label>
                                <br>
                                <textarea rows="6" cols="40" type="text" name="question[title][]"
                                          class="form-control">
                        </textarea>
                                <br>

                            </div>
                            <div class=" col-md-6">
                                <br>
                                <label>آپلود تصویر به عنوان صورت سوال(اختیاری)</label>
                                <input class="form-control" type="file" name="question[file][]"
                                       placeholder="زمان آزمون را به دقیقه وارد نمایید.">
                            </div>
                            <div class=" col-md-6">
                                <br>
                                <label>آپلود تصویر سوال(اختیاری)</label>
                                <input class="form-control" type="file" name="question[image][]"
                                       placeholder="زمان آزمون را به دقیقه وارد نمایید.">
                            </div>
                        </div>
                        <br>
                        <label>گزینه ها</label>

                        <div class=" col-md-12">
                            <div class="row">

                                <div class="col-md-3">
                                    <input class="form-control" type="text" required name="option[1][]"
                                           value="گزینه ۱">
                                    <input type="checkbox" value="1" name="option[correct][]" class="checkbox">
                                    <input type="file" name="image[1][]">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" required name="option[2][]"
                                           value="گزینه ۲">
                                    <input type="checkbox" value="2" name="option[correct][]" class="checkbox">
                                    <input type="file" name="image[2][]">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" required name="option[3][]"
                                           value="گزینه ۳">
                                    <input type="checkbox" value="3" name="option[correct][]" class="checkbox">
                                    <input type="file" name="image[3][]">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" required name="option[4][]"
                                           value="گزینه ۴">
                                    <input type="checkbox" value="4" name="option[correct][]" class="checkbox">
                                    <input type="file" name="image[4][]">

                                </div>
                            </div>
                            <br>

                        </div>
                        <hr>

                    </div>
                    <div id="questions1">
                        <div class="row" id="pluspart2">
                            <div class="col-5"></div>
                            <div class="col-1">
                                <a onclick="addpart1('questions',2,1)">
                                    <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                                        <div class="fonticon-wrap">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            {{--<div class="col-5"></div>--}}
                            <div class="col-1">
                                <a onclick="removepart1('questions',7,1)">
                                    <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                                        <div class="fonticon-wrap">
                                            <button class="btn btn-danger"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="form-group , col-md-12">

                    <br>
                    <button class="btn btn-info" type="submit">ایجاد آزمون
                    </button>

                </div>

            </form>
        </div>
    </div>
    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
    <script>
        removepart1 = function (div, num, id) {
            if (id != 1) {
                var idminus = id - 1;
                document.getElementById(div + id).style.display = "none";
                document.getElementById(div + id).remove();
                document.getElementById(div + idminus).innerHTML = "";
                document.getElementById(div + idminus).innerHTML = "<div class=\"row\" id=\"pluspart" + num + "\">\n" +
                    "                                                        <div class=\"col-5\"></div>\n" +
                    "                                                        <div class=\"col-1\">\n" +
                    "                                                            <a onclick=\"addpart1('" + div + "'," + num + "," + idminus + ")\">\n" +
                    "                                                                <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                    "                                                                    <div class=\"fonticon-wrap\">\n" +
                    "                                                                        <button class='btn btn-success'> <i class=\"fa fa-plus\"></i> </button>\n" +
                    "                                                                    </div>\n" +
                    "                                                                </div>\n" +
                    "                                                            </a>\n" +
                    "                                                        </div><div class=\"col-1\">\n" +
                    "                                                <a onclick=\"removepart1('" + div + "'," + num + "," + idminus + ")\">\n" +
                    "                                                    <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                    "                                                        <div class=\"fonticon-wrap\">\n" +
                    "                                                          <button class='btn btn-danger'> <i class=\"fa fa-minus\"></i> </button>\n" +
                    "                                                        </div>\n" +
                    "                                                    </div>\n" +
                    "                                                </a>\n" +
                    "                                            </div>\n" +
                    "                                                        <div class=\"col-5\"></div>\n" +
                    "                                                    </div>";
            }
        };

        addpart1 = function (div, num, id) {
            var idplus = id + 1;
            document.getElementById("pluspart" + num).style.display = "none";
            document.getElementById("pluspart" + num).remove();
            document.getElementById(div + id).innerHTML += document.getElementById(div + "0").innerHTML + "<div class=\"row\" id=\"pluspart" + num + "\">\n" +
                "                                                        <div class=\"col-5\"></div>\n" +
                "                                                        <div class=\"col-1\">\n" +
                "                                                            <a onclick=\"addpart1('" + div + "'," + num + "," + idplus + ")\">\n" +
                "                                                                <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                "                                                                    <div class=\"fonticon-wrap\">\n" +
                "                                                                        <button class='btn btn-success'> <i class=\"fa fa-plus\"></i></button>\n" +
                "                                                                    </div>\n" +
                "                                                                </div>\n" +
                "                                                            </a>\n" +
                "                                                        </div><div class=\"col-1\">\n" +
                "                                                <a onclick=\"removepart1('" + div + "'," + num + "," + idplus + ")\">\n" +
                "                                                    <div class=\"col-md-4 col-sm-6 col-12 fonticon-container\">\n" +
                "                                                        <div class=\"fonticon-wrap\">\n" +
                "                                                             <button class='btn btn-danger'> <i class=\"fa fa-minus\"></i> </button>\n" +
                "                                                        </div>\n" +
                "                                                    </div>\n" +
                "                                                </a>\n" +
                "                                            </div>\n" +
                "                                                        <div class=\"col-5\"></div>\n" +
                "                                                    </div>";
            document.getElementById(div + id).insertAdjacentHTML('afterend', '<div id=\"' + div + idplus + '\"></div>');
        };

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
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')



