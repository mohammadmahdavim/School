@extends('layouts.teacher')
@section('css')
    <style>

        #neonShadow {
            transition: 0.3s;
            background-color: #fe0028;
            animation: glow 1s infinite;
            transition: 0.5s;
        }

        #neonShadow:hover {
            transform: translateX(-20px) rotate(30deg);
            border-radius: 5px;
            background-color: blue;
            transition: 0.5s;
        }

        @keyframes glow {
            0% {
                box-shadow: 5px 5px 20px rgb(93, 52, 168), -5px -5px 20px rgb(93, 52, 168);
            }

            50% {
                box-shadow: 5px 5px 20px rgb(81, 224, 210), -5px -5px 20px rgb(81, 224, 210)
            }
            100% {
                box-shadow: 5px 5px 20px rgb(93, 52, 168), -5px -5px 20px rgb(93, 52, 168)
            }
        }

        .container ul {
            margin: 0;
            margin-top: 10px;
            list-style: none;
            position: relative;
            padding: 1px 30px;
            color: #000000;
            font-size: 13px;
        }

        .container ul:before {
            content: "";
            width: 1px;
            height: 100%;
            position: absolute;
            border-left: 2px dashed #000000;
        }

        .container ul li {
            position: relative;
            margin-left: 30px;
            background-color: #03B4FA;
            padding: 14px;
            border-radius: 6px;
            width: 250px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.12), 0 2px 2px rgba(0, 0, 0, 0.08);
        }

        .container ul li:not(:first-child) {
            margin-top: 60px;
        }

        .container ul li > span {
            width: 2px;
            height: 100%;
            background: #000000;
            left: 248px;
            top: 0;
            position: absolute;
        }

        .container ul li > span:before, .container ul li > span:after {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 1px solid #000000;
            position: absolute;
            background: #86b7e7;
            left: -4px;
            top: -4px;
        }

        .container ul li span:after {
            top: 100%;
        }

        .container ul li > div {
            margin-left: 10px;
        }

        .container div .title, .container div .type {
            font-weight: 600;
            font-size: 12px;
        }

        .container div .info {
            font-weight: 300;
        }

        .container div > div {
            margin-top: 5px;
        }

        .container span.number {
            height: 100%;
        }

        .container span.number span {
            position: absolute;
            font-size: 13px;
            left: 7px;
            font-weight: bold;
        }

        .container span.number span:first-child {
            top: -1px;
        }

        .container span.number span:last-child {
            top: 100%;
        }
    </style>

@endsection('css')
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#exampleModal").modal('show');
        });
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')

    <div class="card">
        <div class="card-body">

            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>کلاس</th>
                        <th>درس</th>
                        <th>ساعت</th>
                        <th>تعداد {{config('global.student')}}</th>
                        <th>ورود به کلاس</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($teacherclass as $class)

                        <tr style="text-align: center">

                            <td>
                                {{$class->class_id}}
                            </td>
                            <td>{{$class->darss[0]->name}}</td>
                            <td>
                                @foreach($class->darss ? $class->darss[0]->tagvimteacher->where('class_id',$class->class_id) : $class->darss->tagvimteacher->where('class_id',$class->class) as $tagvim)
                                    <span>{{$tagvim->days->name}}</span>: &nbsp;

                                    <span>{{$tagvim->times->start}}-{{$tagvim->times->end}}</span>
                                    <br>
                                @endforeach
                            </td>
                            <td>{{count($class->class[0]->student)}}</td>
                            <td>
                                <a href="/teacher/class/{{$class->id}}">
                                    <button class="btn btn-primary">ورود</button>

                                </a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-md-6 " STYLE="background-color: #F1FAF3;overflow: scroll;height: 500px">
            <div class="card-body">
                <h5 class="card-title">کلاس های امروز</h5>
                <div class="container ">
                    <ul style="font-size: larger">
                        @foreach($onlines as $online)
                            <?php
                            $hour = \Morilog\Jalali\Jalalian::now()->getHour();
                            $minute = \Morilog\Jalali\Jalalian::now()->getMinute();
                            $time_now = ($hour * 60) + $minute;
                            $start = explode(':', $online->start);
                            $start_class = ($start[0] * 60) + $start[1];
                            $end = explode(':', $online->end);
                            $end_class = ($end[0] * 60) + $end[1];
                            if ($start_class <= $time_now and $time_now <= $end_class) {
                                $status = 'now';
                            } elseif ($time_now >= $end_class) {
                                $status = 'before';
                            } elseif ($time_now <= $start_class) {
                                $status = 'after';
                            }
                            ?>
                            @if($status=='now')
                                <a href="/teacher/online/join/{{$online->id}}">
                                    <br>
                                    @endif
                                    <li
                                        @if($status=='now') ID="neonShadow"
                                        @elseif($status=='before') style="background-color: #000000;color: red" @endif >
                                        <div class="row">
                                            <div class="col-md-9">
                                                <span><b>عنوان :</b></span>
                                                {{$online->title}}
                                            </div>
                                            <div class="col-md-3">

                                                <div style="text-align: left">
                                                    <figure class="avatar avatar-sm avatar-state-success ">
                                                        @if($online->author_class->resizeimage)
                                                            <img class="rounded-circle"
                                                                 src="{{url('uploads/'.$online->author_class->resizeimage)}}"
                                                                 alt="...">
                                                        @else
                                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                                 alt="...">
                                                        @endisset
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>

                                        <div>


                                            <div class="info">
                                                <span><b>نام دبیر:</b></span>

                                                {{$online->author_class->f_name}} {{$online->author_class->l_name}}
                                            </div>
                                            <div class="info">
                                                <span><b>نام درس:</b></span>
                                                {{$online->dars}}

                                            </div>
                                        </div>
                                        <span
                                            class="number"><span>{{$online->start}}</span> <span>{{$online->end}}</span></span>
                                    </li>
                                    @if($status=='now')

                                </a>
                            @endif
                                <a href="/teacher/online/list/{{$online->id}}">

                                <span style="text-align: center;color: darkred">
                                        <button class="btn btn-sm btn-info">حضور و غیاب</button>

                                    </span>
                                </a>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="card col-md-6">
            <div class="card-body">
                <h5 class="card-title">پیام های شما</h5>

                @foreach($messages as $message)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! $message->message !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card  col-md-4">
            <div class="card-body">
                <h5 class="card-title">غایب های امروز

                </h5>

                @foreach($rollcalls as $rollcall)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$rollcall->user->f_name}} {{$rollcall->user->l_name}} - ({{$rollcall->user->class}})
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card  col-md-4">
            <div class="card-body">
                <h5 class="card-title">موارد انضباطی امروز

                </h5>


                @foreach($disiplins as $disiplin)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$disiplin->user->f_name}} {{$disiplin->user->l_name}} - ({{$disiplin->user->class}})
                        : {{$disiplin->CDisciplines->name}}
                    </div>
                @endforeach
            </div>
        </div>


    </div>

    @if(!empty($modal))

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">پیام مدیریت</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if(!empty($modal))
                            {!! $modal->message !!}
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="card">
        <div class="card-body">

            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>روز هفته</th>
                        <th>تایم و کلاس</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($udays as $uday)

                        <tr style="text-align: center">

                            <td>{{$uday->days->name}}</td>
                            <td>
                                @foreach($days as $day)
                                    @if($uday->day==$day->day)
                                        <span style="color: #0000cc">
                                                                                    ساعت: {{$day->times->start}}-{{$day->times->end}}

                                        </span>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <span style="color: black">
                                                                               کلاس: {{$day->class_id}}

                                    </span>
                                        <br>
                                    @endif
                                @endforeach
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection('content')


