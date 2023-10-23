@extends('layouts.teacher')
@section('css')
    <style>
        .dropup {
            position: relative;
            display: inline-block;
        }

        h4.section_title {
            margin-bottom: 1.5rem;
            color: #1a3380;
            padding-right: 5px;
        }

        .card.custom_card {
            transition: 100ms;
        }

        .card.custom_card .card-body {
            padding: 10px;
            margin-bottom: 0rem;
        }

        .card.custom_card .card-title {
            text-align: center;
            margin-bottom: 0.5rem !important;
        }

        .card.custom_card .list-inline {
            margin-bottom: 0rem;
            color: gray;
            font-size: 15px;
        }

        .card.custom_card .list-inline dt {
            font-weight: normal;
            opacity: 0.7;
        }

        .card.custom_card .list-inline dd {
            font-weight: 500;
        }

        .card.custom_card:hover {
            box-shadow: 0px 0px 0px 3px #0000ff45;
            transform: translateY(-5px);
            transition: 200ms;
            background: #ebf0ff;
        }

        .bts_warp {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -moz-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -moz-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 20px 0;
            padding-top: 0;
            flex-wrap: wrap;
        }

        h2.bts_title {
            margin: 0px 0px 0px 0;
            font-weight: 500;
            color: #1a3a9e;
            padding: 0 0 0 40px;
        }

        div.bts_border {
            border-bottom: 1px #1a3a9e solid;
            margin-top: 10px;
            flex-grow: 1;
        }

        h3.bts_second_title {
            margin: 0px 0px 0px 0;
            font-weight: 500;
            color: #1a3a9e;
            padding: 0 20px 0 0;
            font-size: 20px;
            white-space: nowrap;
        }

        .bts_subrow {
            flex-basis: 100%;
            justify-content: space-between;
            display: flex;
        }

        .style-2 h3.bts_second_title {
            padding: 0 0 0 20px;
        }

        .style-2 div.bts_border {
            margin-top: 0;
        }

        .small-font {
            font-size: 15px !important;
        }

        a.btn_custom {
            padding: 7px 25px;
            background-color: #1e8ce9;
            margin: 0 5px;
            display: inline-block;
            color: #fff;
            font-size: 15px;
        }

        a.btn_custom:hover {
            background-color: #107cd8;
        }

        a.btn_custom.btn_custom_light {
            background-color: #eff2fa;
            color: #7d87af;
        }

        a.btn_custom.btn_custom_light:hover {
            background-color: #e0e7f9;
        }

        .widget_card {
            font-size: medium;
        }

        .widget_header {
            padding-bottom: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .widget_card table {
            font-size: medium;
        }

        .card.widget_card .table.borderless th, .card.widget_card .table.borderless td, .card.widget_card .table.borderless tr {
            background: none;
        }

        .card.widget_card .table th, .card.widget_card .table td, .card.widget_card .table tr {
            padding: 0.65rem;
        }

        .widget_header h4 {
            font-size: 19px;
            padding-right: 5px;
        }

        .widget_header .ex-header {
            padding: 5px 0;
        }

        .add_new_item {
            padding: 7px 15px;
            background-color: #aeafe1;
            color: #fff;
            font-weight: 100;
        }

        .add_new_item:hover {
            color: #fff;
            background-color: #7b7cda;
        }

        .add_new_item i {
            padding-left: 7px;
        }

        .students_num {
            color: #6464c7;
            font-size: 15px;
            font-weight: 500;
            padding: 0 10px;
        }

        .accordion .card {
            box-shadow: none;
            border: none;
        }

        .accordion .card .card-header {
            background-color: #ebebeb;
            border-radius: 8px !important;
            margin-bottom: 15px;
            display: block;
        }

        .accordion .card .card-header .text-right {
            font-size: 17px;
            font-weight: 500;
            color: #646363;
            display: block;
            cursor: pointer;
            padding: 12px 20px;
        }

        .accordion-menu > button {
            display: block;
            position: relative;
        }

        .accordion-menu > button:after {
            content: "\f078"; /* fa-chevron-down */
            font-family: 'FontAwesome';
            position: absolute;
            left: 10px;
        }

        .accordion-menu > button[aria-expanded="true"]:after {
            content: "\f077"; /* fa-chevron-up */
        }

        .card.horizontal_card {
            font-size: 15px;
        }

        .user_display_name {
            font-size: 16px;
            padding-right: 5px;
        }

        .dars_time {
            color: #3f51b5;
            font-size: 16px;
            font-weight: 500;
            margin: 15px 0 10px 0;
        }

        .bg-lgreen {
            background-color: #f0ffd0;
        }

        .bg-lyellow {
            background-color: #fff8be;
        }

        .borderless td, .borderless th {
            border: none !important;
        }

        .widget_card .card-title {
            font-weight: 500 !important;
            margin-bottom: 0rem !important;
            padding-right: 10px;
        }

        .bg-lgreen.card table.table th, .bg-lyellow.card table.table th {
            color: #75ac00;
            font-weight: 400;
        }

        .card.widget_card .table th:not(:first-child), .card.widget_card .table td:not(:first-child) {
            text-align: center;
        }

        button.btn.btn-success.btn-intable {
            line-height: 10px;
            box-shadow: 0 0 0 4px #0acf97;
            border-radius: 1px;
        }

        button.btn.btn-success.btn-intable:hover {
            box-shadow: 0 0 0 4px #00b179;
        }

        .action_box {
            display: flex;
            justify-content: center;
        }

        .action_box a {
            padding: 1px 10px;
            text-align: center;
            font-size: small;
            min-width: 56px;
            color: #505050;
            transition: 0s;
            font-weight: 400;
        }

        .action_box a.action_box_delete {
            background: #e0e0e0;
        }

        .action_box a.action_box_edit {
            background: #b6f7a7;
        }

        .action_box a.action_box_info {
            background: #0000cc;
        }

        .action_box a.action_box_delete:hover {
            background: #ea283b57;
            color: #000;
        }

        .action_box a.action_box_edit:hover {
            background: #60ca47;
            color: #fff;
            font-weight: 400;
        }

        .accordion-menu .action_box {
            position: absolute;
            left: 56px;
            top: 12px;
            height: 26px;
            z-index: 1000;
        }

    </style>

@endsection('css')
@section('script')
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')
    <div class="container-fluid">
        <div class="bts_warp style-2">
            <h3 class=" bts_second_title">
                کلاس {{$clas->class[0]->classnamber}}
                -
                پایه {{$clas->class[0]->paye}}

            </h3>
            <div class="bts_border">
            </div>
            <div class="bts_subrow">
                <h2 class="bts_title">{{$clas->darss[0]->name}}</h2>
                <div class="btc_leftactions">
                    <a href="/teacher/students/rollcall/{{$idclas}}" class="btn_custom bg-warning">حضور و غیاب</a><a
                        href="/teacher/develop{{$idclas}}/{{$clas->dars}}" class="btn_custom">نمودار
                        پیشرفت</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card horizontal_card">
                    <div class="row no-gutters">
                        <div class="col-xl-9 col-lg-8 col-sm-8">
                            <div class="card-body">
                                <div class="widget_header pb-0">
                                    <div>
                                        <figure class="avatar avatar-sm avatar-state-success">
                                            <img class="rounded-circle" src="/assets/profile/avatar.png" alt="...">
                                        </figure>
                                        <span class="user_display_name"> دبیر:
                                        {{$clas->users->f_name}} {{$clas->users->l_name}}
                                        </span>
                                        <br>
                                        @foreach($clas->darss[0]->tagvimteacher->where('class_id',$clas->class_id) as $tagvim)
                                            <div class="dars_time">
                                                <span>{{$tagvim->days->name}}</span>-
                                                <span>{{$tagvim->times->name}}</span>
                                            </div>
                                        @endforeach

                                    </div>
                                    <button type="button" class="btn btn-primary m-l-5 m-t-5" data-toggle="modal"
                                            data-target=".bd-example-modal-lg">ویرایش توضیحات
                                    </button>
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form method="post" action="/teacher/class/edit/{{$clas->id}}">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{$clas->darss[0]->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <textarea id="editor-demo1" name="description">
                                                    {!! $clas->description !!}
                                                      </textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">بستن
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">ذخیره تغییرات
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    {!! $clas->description !!}

                                </p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-4 d-none d-sm-block bg-secondary">
                            @if($clas->darss[0]->file)
                                <img class="card-img-top"
                                     src="{{url('images/'.$clas->darss[0]->file)}}"
                                >
                            @else
                                <img class="card-img-top" src="/assets/profile/avatar.png"
                                >
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-9 col-lg-8 col-sm-8">


                <div class="widget_header">
                    <h4> کلاس های آنلاین فعال امروز</h4>
                    <div class="ex-header"><a href="/teacher/online_class/create" class="add_new_item"><i class="fa fa-plus"
                                                                                                   data-unicode="f067"></i>افزودن
                            کلاس جدید</a>
                    </div>
                </div>
                <div class="card widget_card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mb-0 table-fixed small-font"
                                   id="myTable">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>درس</th>
                                    <th>ساعت شروع</th>
                                    <th>ساعت پایان</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($onlines=='[]')
                                    <h5>آزمونی درج نشده است.</h5>
                                @endif
                                @foreach($onlines as $online)
                                    <tr>
                                        <td>{{$online->title}}</td>
                                        <td>{{$online->dars}}</td>
                                        <td>{{$online->start}} </td>
                                        <td>{{$online->end}} </td>
                                        <td>
                                            <a href="/teacher/online/join/{{$online->id}}">
                                                <button class="btn btn-info">ورود</button>
                                            </a>
                                            <a href="/teacher/online/edit/{{$online->id}}">
                                                <button class="btn btn-success">ویرایش</button>
                                            </a>
                                            <button class="btn btn-danger" onclick="deletclass({{$online->id}})"><i
                                                    class="icon-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="widget_header">
                    <h4>محتوای آموزشی</h4>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @if($films=='[]')
                                <h5>محتوایی درج نشده است.</h5>
                            @endif
                            @foreach($films as $film)
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="accordion-menu mb-0">
                                            <button class="btn btn-link btn-block text-right collapsed" type="button"
                                                    data-toggle="collapse" data-target="#collapse{{$film->id}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse{{$film->id}}">
                                                {{$film->title}}
                                            </button>
                                            <div class="action_box">
                                                <button title="حذف" class="btn btn-danger btn-sm"
                                                        onclick="deletefilm({{$film->id}})"><i
                                                        class="icon-trash"></i></button>
                                                <a href="/teacher/film/edite/{{$film->id}}" class="action_box_edit">ویرایش</a>
                                            </div>
                                        </h2>
                                    </div>
                                    <div id="collapse{{$film->id}}" class="collapse" aria-labelledby="headingOne"
                                         data-parent="#accordionExample" style="">
                                        <div class="card-body">
                                            {!! $film->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="widget_header">
                    <h4>مدیریت تکالیف</h4>
                    <div class="ex-header"><a href="/teacher/uploadtamrin" class="add_new_item"><i class="fa fa-plus"
                                                                                                   data-unicode="f067"></i>افزودن
                            تکلیف جدید</a>
                    </div>
                </div>
                <div class="card widget_card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover mb-0 table-fixed small-font"
                               id="myTable">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تاریخ ارسال</th>
                                <th>فرصت تحویل</th>
                                <th>تحویل شده</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($tamrins=='[]')
                                <h5>تکلیفی درج نشده است.</h5>
                            @endif
                            @foreach($tamrins as $tamrin)
                                <tr>
                                    <td>{{$tamrin->title}}</td>
                                    <td>{{$tamrin->created_at->toDateString()}}</td>
                                    <td>{{getexpire($tamrin->expire)}}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                 style="width:{{getbar($idclas,$tamrin->id)}}%;" aria-valuenow="25"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100">{{  getbar($idclas,$tamrin->id)}}
                                                %
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="action_box">
                                            <button title="حذف" class="btn btn-danger btn-sm"
                                                    onclick="deletetamrin({{$tamrin->id}})"><i
                                                    class="icon-trash"></i></button>
                                            <a href="/teacher/tamrin/edite/{{$tamrin->id}}" class="action_box_edit">ویرایش</a>
                                            <a href="/teacher/tamrin/jtamrin/{{$tamrin->id}}" class="action_box_info">مدیریت</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget_header">
                    <h4>مدیریت آزمون ها</h4>
                    <div class="ex-header"><a href="/teacher/exam/create" class="add_new_item"><i class="fa fa-plus"
                                                                                                  data-unicode="f067"></i>افزودن
                            آزمون جدید</a>
                    </div>
                </div>
                <div class="card widget_card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mb-0 table-fixed small-font"
                                   id="myTable">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>تاریخ پایان</th>
                                    <th>زمان پاسخدهی</th>
                                    <th>مشاهده سوالات</th>
                                    <th>مشاهده {{config('global.students')}}</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($exams=='[]')
                                    <h5>آزمونی درج نشده است.</h5>
                                @endif
                                @foreach($exams as $exam)
                                    <tr>
                                        <td>{{$exam->exam->title}}</td>
                                        <td>{{$exam->exam->expire}}</td>
                                        <td>{{$exam->exam->time}} دقیقه</td>
                                        <td><a href="/teacher/exam/{{$exam->exam->id}}">
                                                <button class="btn btn-info">کلیک کنید</button>
                                            </a></td>
                                        <td><a href="/teacher/exam/student/{{$idclas}}/{{$exam->exam->id}}">
                                                <button class="btn btn-primary">کلیک کنید</button>
                                            </a></td>

                                        <td>
                                            <div class="action_box">
                                                <button title="حذف" class="btn btn-danger btn-sm"
                                                        onclick="deleteexam({{$exam->exam->id}})"><i
                                                        class="icon-trash"></i></button>
                                                <a href="/teacher/exam/{{$exam->exam->id}}/edit"
                                                   class="action_box_edit">ویرایش</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-4">
                <div class="widget_header">
                    <h4>{{config('global.students')}} کلاس</h4>
                    <div class="ex-header"><span class="students_num">{{count($students)}} نفر</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <ul>
                            @foreach($students as $student)
                                <li>
                                    <figure class="avatar avatar-sm">
                                        @if(!empty($user->resizeimage))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$student->resizeimage)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endif
                                    </figure>
                                    <span class="user_display_name">
                                    {{$student->f_name}} {{$student->l_name}}
                                </span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
<script>
    function deletefilm(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود از باکس {{config('global.students')}} نیز حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/film/Delete/')  }}" + '/' + id,
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

    function deletetamrin(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود از باکس {{config('global.students')}} نیز حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/tamrin/Delete/')  }}" + '/' + id,
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

    function deleteexam(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام سوالات و جواب های مرتبط حذف می گردد!!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/exam/delete/')  }}" + '/' + id,
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
    function deletclass(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود از باکس {{config('global.students')}} نیز حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/online/Delete/')  }}" + '/' + id,
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
<?php
function getbar($idclas, $tamrin)

{
    $contst = \App\student::where('classid', $idclas)->count();
    $answercount = \App\JTamrin::where('tamrin_id', $tamrin)->count();
    $percent = round(($answercount / $contst) * 100);
    return $percent;


}

function getexpire($expire)
{

    $date = explode('/', $expire);
    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
    $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
    $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
    $nowTimestamp = \Morilog\Jalali\Jalalian::forge("now")->getTimestamp();

    if ($dateEx >= $nowTimestamp) {


        $time = $dateEx - time(); // to get the time since that moment

        $tokens = array(
            31536000 => 'سال',
            2592000 => 'ماه',
            604800 => 'هفته',
            86400 => 'روز',
            3600 => 'ساعت',
            60 => 'دقیقه',
            1 => 'ثانیه'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);

            return $numberOfUnits . ' ' . $text . ' مانده';
        }
    } else {

        return 'پایان فرصت';
    }


//        if ($days >= 1) {
//            return $days . " " . 'روز مانده';
//        } elseif ($days == 0) {
//            return 'تا ساعت دوازده امشب فرصت باقی مانده است';
//        }


//$a=\Illuminate\Support\Carbon::now();
}
?>

