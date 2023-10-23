@extends('layouts.student')
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
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card " STYLE=";overflow: scroll;height: 500px">
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
                                    <a href="/student/online/join/{{$online->id}}">
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
                                                                <img class="rounded-circle"
                                                                     src="/assets/profile/avatar.png"
                                                                     alt="...">
                                                            @endisset
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>


                                                <div class="info">
                                                    <span><b>نام {{config('global.teacher')}}:</b></span>

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

                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if(!empty($messages))

                <div class="card bg-info-bright">
                    <div class="card-body">
                        <h5 class="card-title">قرار ملاقات های امروز</h5>

                        <table id="example1" class="table  table-striped table-bordered ">
                            <thead>
                            <tr style="text-align: center">
                                <th>شمارنده</th>
                                <th>عنوان</th>
                                <th>ساعت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $idn = 1; ?>

                            @foreach($meetings as $row)
                                <tr style="text-align: center" class="form-group">
                                    <td style="text-align: center">{{$idn}}</td>

                                    <td>{{$row->title}}</td>
                                    <td>{{$row->start}}</td>

                                    <td style="text-align: center">

                                        @if($row->online==1)
                                            <a href="/student/moshaver/join/{{$row->id}}" target="_blank">
                                                <button class="btn  btn-info btn-sm">ورود</button>
                                            </a>
                                            @if($row->record==1)
                                                <a href="/student/moshaver/records/{{$row->id}}" target="_blank">
                                                    <button class="btn btn-sm btn-warning">فیلم</button>
                                                </a>
                                            @endif
                                        @endif
                                    </td>


                                </tr>
                                <?php $idn = $idn + 1 ?>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            @endif

        </div>
        <div class="col-md-4">
            @if(!empty($messages))

                <div class="card bg-success-bright">
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
            @endif

        </div>
        <div class="col-md-4">
            <div class="card bg-info-bright">
                <div class="card-body">
                    <h5 class="card-title">الگو مطالعه</h5>
                    @if($patterns!='[]')
                        @foreach($patterns as $pattern)
                            <div class="" role="alert">
                                <span>{{$pattern->name}}</span>
                                <br>
                                <button class="btn btn-info">
                                    <a href="/student/pattern/doros/{{$pattern->id}}">لیست دروس</a>
                                </button>
                            </div>
                            <br>
                        @endforeach
                    @else
                        <span>هیچ الگویی تعریف نشده است.</span>
                    @endif

                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="section_title">درس های من</h4>
        </div>
        @foreach($doros as $dars)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="student/dars/{{$dars->id}}">
                    <div class="card custom_card">
                        @if($dars->file)
                            <img
                                src="{{url('images/'.$dars->file)}}"
                                height="200">
                        @else
                            <img src="/assets/profile/avatar.png"
                                 height="200">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;color: black">{{$dars->name}}</h5>
                            <dl class="list-inline">
                                <dt class="list-inline-item" style="color: black">{{config('global.teacher')}}:</dt>
                                <dd class="list-inline-item">
                                    @if($dars->teacher)
                                        {{$dars->teacher->users ? $dars->teacher->users->f_name : ''}}
                                        {{$dars->teacher->users ? $dars->teacher->users->l_name : ''}}
                                    @endif
                                </dd>
                            </dl>
                            <dl class="list-inline">
                                <dt class="list-inline-item" style="color: black">زمان برگزاری:</dt>
                                <br>
                                @foreach($dars->tagvim as $tagvim)
                                    @if($tagvim)
                                        <dd class="list-inline-item">


                                            {{$tagvim->days->name}}:

                                            {{$tagvim->times->start}}-
                                            {{$tagvim->times->end}}


                                        </dd>
                                    @endif
                                @endforeach
                            </dl>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
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
                        <th>تایم و درس</th>

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
                                                                               درس: {{$day->dars->name}}

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


