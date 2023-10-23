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
            <h3>ویرایش سوال برای آزمون {{$questions[0]->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش سوال برای
                        آزمون {{$questions[0]->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <button type="button" class="btn btn-primary" title="افزودن سوال جدید" data-toggle="modal"
                    data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i></button>
            @if($questions[0]->filename)
                <a href="{{ route('exam.download', $questions[0]->id) }}"
                   class="btn btn-outline-warning">
                    <i class="icon-download"></i>&nbsp; دانلود فایل کلی آزمون </a>
            @endif
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">ایجاد سوال جدید</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/teacher/exam/questions" method="post" enctype="multipart/form-data">

                            {{csrf_field()}}
                            @include('Admin.errors')
                            <input name="exam_id" value="{{$questions[0]->id}}" hidden>
                            <div class="modal-body">
                                <div class="row">


                                    <div class="col-md-12">
                                        <br>
                                        <label>صورت سوال </label>
                                        <br>
                                        <textarea required rows="6" cols="40" type="text" id="title"
                                                  name="question[title][]"
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
                                            <input type="radio" value="1" name="option[correct][]" class="checkbox">
                                            <input type="file" name="image[1][]">

                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" type="text" required name="option[2][]"
                                                   value="گزینه ۲">
                                            <input type="radio" value="2" name="option[correct][]" class="checkbox">
                                            <input type="file" name="image[2][]">

                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" type="text" required name="option[3][]"
                                                   value="گزینه ۳">
                                            <input type="radio" value="3" name="option[correct][]" class="checkbox">
                                            <input type="file" name="image[3][]">

                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" type="text" required name="option[4][]"
                                                   value="گزینه ۴">
                                            <input type="radio" value="4" name="option[correct][]" class="checkbox">
                                            <input type="file" name="image[4][]">

                                        </div>
                                    </div>
                                    <br>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                                <button type="submit" class="btn btn-primary">ایجاد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div style="text-align: center">
                <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                    ویرایش سوال برای آزمون {{$questions[0]->title}}
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
            <?php
            $id = 1;
            ?>
            <div id="questions">
                @foreach($questions[0]->questions as $question)
                    <form action="/teacher/exam/questionsupdate/{{$question->id}}" method="post">
                        {{csrf_field()}}
                        @include('Admin.errors')

                        <div id="questions{{$question->id}}">

                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <div style="text-align: left">
                                        <button type="submit" class="btn btn-success" title="ویرایش"
                                                onclick="updateData({{$question->id}})"><i
                                                class="icon-pencil"></i></button>
                                        <button type="button" class="btn btn-danger" title="حذف"
                                                onclick="deleteData({{$question->id}})"><i
                                                class="icon-trash"></i></button>

                                    </div>
                                    <label>صورت سوال {{$id}} </label>


                                    <br>

                                    <textarea rows="6" cols="40" type="text" id="title" name="question[title][]"
                                              class="form-control">
                                        {{$question->title}}

                                </textarea>
                                    <br>

                                </div>
                                <div class=" col-md-6">
                                    <br>
                                    @if(!empty($question->file))
                                        {{--@dd($question->file);--}}
                                        <img class="" width="410" height="300"
                                             src="{{url('/images/exam/'.$question->file)}}"
                                             alt="...">

                                    @endif
                                </div>
                                <div class=" col-md-6">
                                    <br>
                                    @if(!empty($question->image))
                                        {{--@dd($question->image);--}}
                                        <img class="" width="410" height="300"
                                             src="{{url('/images/exam/'.$question->image)}}"
                                             alt="...">

                                    @endif
                                </div>
                            </div>
                            <br>
                            <label>گزینه ها</label>

                            <div class=" col-md-12">
                                @foreach($question->myoptions as $myoptions)
                                    <?php
                                    $images = \App\OptionImage::where('question_id', $myoptions->question_id)->get();
                                    ?>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <input @if($myoptions->correct==1) checked @endif type="radio" value="1"
                                                   name="option[correct][]" class="checkbox">
                                            <input class="form-control" type="text" required name="option[1][]"
                                                   value="{{$myoptions[1]}}">
                                            @if($images!='[]')
                                                @if($one=$images->where('option_id',1)->first())
                                                    <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                         width="250">
                                                @endif
                                            @endif


                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" @if($myoptions->correct==2) checked @endif value="2"
                                                   name="option[correct][]" class="checkbox">
                                            <input class="form-control" type="text" required name="option[2][]"
                                                   value="{{$myoptions[2]}}">
                                            @if($images!='[]')
                                                @if($one=$images->where('option_id',2)->first())
                                                    <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                         width="250">
                                                @endif
                                            @endif

                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" @if($myoptions->correct==3) checked @endif value="3"
                                                   name="option[correct][]" class="checkbox">
                                            <input class="form-control" type="text" required name="option[3][]"
                                                   value="{{$myoptions[3]}}">
                                            @if($images!='[]')
                                                @if($one=$images->where('option_id',3)->first())
                                                    <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                         width="250">
                                                @endif
                                            @endif

                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" value="4" @if($myoptions->correct==4) checked
                                                   @endif name="option[correct][]" class="checkbox">
                                            <input class="form-control" type="text" required name="option[4][]"
                                                   value="{{$myoptions[4]}}">
                                            @if($images!='[]')
                                                @if($one=$images->where('option_id',4)->first())
                                                    <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                         width="250">
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                @endforeach

                                <br>

                            </div>
                            <div style="text-align: left">

                            </div>

                            <hr>
                            <hr>

                        </div>
                    </form>
                    <?php
                    $id = $id + 1;
                    ?>
                @endforeach

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
    <script>
        function deleteData(id) {
            swal({
                title: "آیا از حذف مطمئن هستید؟",
                text: "اگر حذف شود تمام  جواب های مرتبط حذف می گردد!!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{  url('/teacher/examquestion/delete/')  }}" + '/' + id,
                            type: "GET",

                            success: function () {
                                swal({
                                    title: "حذف با موفقیت انجام شد!",
                                    icon: "success",

                                });
                                window.location.reload(true);
                            },
                            error: function () {
                                swal({
                                    title: "خطا...",
                                    text: data.message,
                                    type: 'error',
                                    timer: '1500'
                                })

                            }
                        });
                    } else {
                        swal("عملیات حذف لغو گردید");
                    }
                });

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



