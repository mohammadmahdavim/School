@extends('layouts.admin')
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
            <h3>سوالات برای آزمون {{$exam->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سوالات برای آزمون {{$exam->title}} -
                        درس
                        {{$dars->darsname->name}}
                    </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')

    <div class="card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        <h3> سوالات آزمون {{$exam->title}}</h3>
                    </div>
                    <div class="col-md-3" style="text-align: left">
                        @if($exam->filename)
                            <a href="{{ route('exam.download', $exam->id) }}"
                               class="btn btn-outline-warning">
                                <i class="icon-download"></i> دانلود فایل کلی آزمون </a>
                        @endif
                    </div>
                    <div class="col-md-3" style="text-align: left">
                        <a href="/admin/exam/doros/{{$exam->id}}"
                           class="btn btn-warning">
                            لیست دروس </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <form action="/admin/exam/countQuestion/{{$dars->id}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input class="form-control" type="number" value="{{count($questions)}}"
                                           name="countquestions">

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">ارسال</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">

                    @foreach($questions as $question)
                        <div class="col-md-3">
                            <br>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#سوال{{$question->id}}">
                                {{$question->title}}

                            </button>

                            <div class="modal fade bd-example-modal-lg" id="سوال{{$question->id}}" tabindex="-1"
                                 role="dialog"
                                 aria-labelledby="{{$question->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="{{$question->id}}">{{$question->title}}
                                            </h5>
                                            @if($question->file)
                                                <a href="{{ route('exam_question.download', $question->id) }}"
                                                   class="btn btn-outline-warning">
                                                    <i class="icon-download"></i>&nbsp; دانلود تصویر سوال </a>
                                            @endif
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/admin/exam/questions/update/{{$question->id}}" method="post"
                                              enctype="multipart/form-data">

                                            {{csrf_field()}}
                                            @include('Admin.errors')
                                            <input name="exam_id" value="{{$exam->id}}" hidden>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <br>
                                                        <label>صورت سوال </label>
                                                        <br>
                                                        <textarea required rows="6" cols="40" type="text" id="title"
                                                                  name="description"
                                                                  class="form-control">
                                                                    {{$question->description}}

                                                         </textarea>
                                                        <br>

                                                    </div>
                                                    <div class=" col-md-6">
                                                        <br>
                                                        <label>آپلود تصویر به عنوان صورت سوال(اختیاری)</label>
                                                        <input class="form-control" type="file" name="file"
                                                               placeholder="زمان آزمون را به دقیقه وارد نمایید.">
                                                    </div>
                                                    <div class=" col-md-6">
                                                        @if(!empty($question->file))
                                                            {{--@dd($question->image);--}}
                                                            <img class="" width="200" height="150"
                                                                 src="{{url('/images/exam/'.$question->file)}}"
                                                                 alt="...">
                                                        @endif
                                                    </div>

                                                </div>
                                                <br>
                                                <label>گزینه ها</label>

                                                <div class=" col-md-12">
                                                    <div class="row">

                                                        <div class="col-md-3">
                                                            <input class="form-control" type="text" required
                                                                   name="1"
                                                                   value="{{$question->myoptions[0][1]}}">
                                                            <input type="radio" value="1" name="correct"
                                                                   @if($question->myoptions[0]['correct']==1) checked
                                                                   @endif
                                                                   class="checkbox">


                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="text" required
                                                                   name="2"
                                                                   value="{{$question->myoptions[0][2]}}">
                                                            <input type="radio" value="2" name="correct"
                                                                   @if($question->myoptions[0]['correct']==2) checked
                                                                   @endif
                                                                   class="checkbox">


                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="text" required
                                                                   name="3"
                                                                   value="{{$question->myoptions[0][3]}}">
                                                            <input type="radio" value="3" name="correct"
                                                                   @if($question->myoptions[0]['correct']==3) checked
                                                                   @endif
                                                                   class="checkbox">


                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="text" required
                                                                   name="4"
                                                                   value="{{$question->myoptions[0][4]}}">
                                                            <input type="radio" value="4" name="correct"
                                                                   @if($question->myoptions[0]['correct']==4) checked
                                                                   @endif
                                                                   class="checkbox">


                                                        </div>
                                                    </div>
                                                    <br>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    انصراف
                                                </button>
                                                <button type="submit" class="btn btn-primary">ارسال</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br>
                <div class="card">
                    <div class="card-body bg-info-bright">
                        <span>کلید</span>
                        <form action="/admin/exam/question/key" method="post">
                            @csrf
                            <?php
                            $number = 1;
                            ?>
                            @foreach($questions as $key=>$question)
                                <fieldset id="group{{$key+1}}">
                                    <span>{{$number}} -</span>

                                    <input @if($question->myoptions[0]->correct==1) checked @endif  type="radio"
                                           value="1" name="option[{{$question->myoptions[0]->id}}]">
                                    <input @if($question->myoptions[0]->correct==2) checked @endif type="radio"
                                           value="2" name="option[{{$question->myoptions[0]->id}}]">
                                    <input @if($question->myoptions[0]->correct==3) checked @endif type="radio"
                                           value="3" name="option[{{$question->myoptions[0]->id}}]">
                                    <input @if($question->myoptions[0]->correct==4) checked @endif type="radio"
                                           value="4" name="option[{{$question->myoptions[0]->id}}]">
                                </fieldset>

                                <?php $number += 1 ?>
                            @endforeach
                            <button class="btn btn-sm btn-success">ثبت</button>
                        </form>
                    </div>
                </div>

            </div>
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



