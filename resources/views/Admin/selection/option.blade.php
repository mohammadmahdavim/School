@extends('layouts.admin')
@section('css')

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
            <h3>ایجاد گزینه برای {{$row->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد گزینه برای{{$row->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/selection/optionstore" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                <input name="selection_id" value="{{$row->id}}" hidden>

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

                            <div class=" col-md-6">
                                <br>
                                <label>نام و یا عنوان گزینه</label>
                                <input class="form-control" type="text" name="question[title][]"
                                >
                            </div>


                            <div class=" col-md-6">
                                <br>
                                <label>آپلود تصویر (اختیاری)</label>
                                <input class="form-control" type="file" name="question[file][]"
                                       placeholder="زمان آزمون را به دقیقه وارد نمایید.">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <label>توضیحات </label>
                            <br>
                            <textarea rows="6" cols="40" type="text" id="description" name="question[description][]"
                                      class="form-control">
                        </textarea>
                            <br>

                        </div>
                        <br>
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
                    <button class="btn btn-info" type="submit">ثبت و ذخیره
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


@endsection('script')



