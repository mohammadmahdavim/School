@extends('layouts.student')
@section('css')
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
            outline: none;
        }

        #neonShadow {
            height: 50px;
            width: 100px;
            border: none;
            border-radius: 50px;
            transition: 0.3s;
            background-color: red;
            animation: glow 1s infinite;
            transition: 0.5s;
        }

        span:hover {
            transition: 0.3s;
            opacity: 1;
            font-weight: 700;
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


    </style>
@endsection('css')
@section('script')

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')

    <div class="container-fluid">
        <div class="bts_warp">

            <h2 class="bts_title">{{$dars->name}}</h2>
            <div class="bts_border">
            </div>
            <h3 class="bts_second_title">پایه {{auth()->user()->paye}}
                -
                کلاس {{auth()->user()->class}}
            </h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card horizontal_card">
                    <div class="row no-gutters">
                        <div class="col-xl-9 col-lg-8 col-sm-8">
                            <div class="card-body">
                                <figure class="avatar avatar-sm avatar-state-success">
                                    @if(!empty($dars->teacher->users->resizeimage))
                                        <img class="rounded-circle"
                                             src="{{url('uploads/'.$dars->teacher->users->resizeimage)}}"
                                             alt="...">
                                    @else
                                        <img class="rounded-circle" src="/assets/profile/avatar.png"
                                             alt="...">
                                    @endif
                                </figure>
                                <span class="user_display_name"> {{config('global.teacher')}}:
                                     {{$dars->teacher ? $dars->teacher->users->f_name : ''}}
                                    {{$dars->teacher ? $dars->teacher->users->l_name : ''}}
                                    </span>
                                <div class="dars_time">
                                    @foreach($dars->tagvim as $tagvim)
                                        @if($tagvim)
                                            <dd class="list-inline-item" style="color: #0000cc">


                                                {{$tagvim->days->name}}:

                                                {{$tagvim->times->start}}-
                                                {{$tagvim->times->end}}


                                            </dd>
                                        @endif
                                    @endforeach
                                </div>
                                <p class="card-text">
                                    {!! $dars->teacher ? $dars->teacher->description : '' !!}

                                </p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-4 d-none d-sm-block bg-secondary">

                            @if($dars->file)
                                <img class="card-img-top"
                                     src="{{url('images/'.$dars->file)}}"
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
                    <h4>محتوای آموزشی</h4>
                    <div class="ex-header">
                    </div>
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
                                        <div class="col-md-9">
                                            <h2 class="accordion-menu mb-0">
                                                <button class="btn btn-link btn-block text-right collapsed"
                                                        type="button"
                                                        data-toggle="collapse" data-target="#collapse{{$film->id}}"
                                                        aria-expanded="false" aria-controls="collapse{{$film->id}}">
                                                    {{$film->title}}
                                                </button>
                                            </h2>
                                        </div>
                                        <div class="col-md-3" style="text-align: left">
                                            @if($film->filename)
                                                <a href="/film/count/{{$film->id}}" class="btn btn-outline-warning">

                                                    <i
                                                        class="icon-download"></i> دانلود </a>
                                            @else
                                                <a href="{{$film->link}}">{{$film->link}}</a>
                                            @endif
                                        </div>
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
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="bg-lgreen card widget_card">
                            <div class="card-body">
                                <h5 class="card-title">تکالیف</h5>
                                <div class="table-responsive">
                                    <table class="table borderless ">
                                        <thead>
                                        <tr>
                                            <th scope="col">عنوان</th>
                                            <th scope="col">مهلت</th>
                                            <th scope="col">فایل</th>
                                            <th scope="col">توضیحات</th>
                                            <th scope="col">نمره</th>
                                            <th scope="col">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($tamrin=='[]')
                                            <h5>تکلیفی درج نشده است.</h5>
                                        @endif
                                        @foreach($tamrin as $tamri)
                                            <tr>
                                                <td>
                                                    <p>{{$tamri->title}}</p>
                                                </td>
                                                <td>
                                                    <button type="text" id="mark4" name="mark4"
                                                            @if(getexpire($tamri->expire) == 'پایان فرصت') class="btn btn-danger"
                                                            @else class="btn btn-success" @endif >{{getexpire($tamri->expire)}}
                                                    </button>
                                                </td>
                                                <td>
                                                    @if($tamri->mime)
                                                        <a href="{{ route('books.download', $tamri->id) }}"
                                                           class="btn btn-outline-dark">
                                                            <i class="icon-download"></i> دانلود </a>
                                                    @endif
                                                    @if($tamri->status==1 && !empty($tamri->pmime))

                                                        <a href="{{ route('jtamrinteacher.download', $tamri->id) }}"
                                                           class="btn btn-outline-warning">
                                                            <i class="icon-download"></i> دانلود </a>
                                                        <br>
                                                        <br>

                                                        <label>دانلود پاسخ تمرین
                                                        </label>
                                                    @endif
                                                </td>
                                                <td title="{!! $tamri->description !!}">توضیحات</td>
                                                <td>{{getmark($tamri->id)}}</td>
                                                @if(auth()->user()->role=='دانش آموز')
                                                    <td>
                                                        @if( getexpire($tamri->expire) == 'پایان فرصت' or auth()->user()->role=='اولیا')
                                                            <div style="color:#040000"> فرصت تحویل تمرین به پایان رسیده
                                                                است.
                                                            </div>



                                                        @else
                                                            <div>

                                                                @if(empty($row=\App\JTamrin::where('tamrin_id',$tamri->id)->where('user_id', auth()->user()->id)->first()) )
                                                                    <a href="/student/jtamrin{{$tamri->id}}">
                                                                        <button style="font-family: 'B Koodak'"
                                                                                class="btn btn-success">
                                                                            ارسال
                                                                            تکلیف
                                                                        </button>
                                                                    </a>
                                                                @else
                                                                    <a href="/student/jtamrin/edit/{{$tamri->id}}">
                                                                        <button class="btn btn-info"
                                                                                style="font-family: 'B Koodak'">
                                                                            ویرایش
                                                                            تکلیف ارسال کرده
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                            </div>

                                                        @endif
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="bg-lyellow card widget_card">
                            <div class="card-body">
                                <h5 class="card-title">امتحانات</h5>
                                <table class="table borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">زمان پاسخدهی</th>
                                        <th scope="col">مهلت</th>
                                        <th scope="col">نتیجه</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($exams=='[]')
                                        <h5>امتحانی درج نشده است.</h5>
                                    @endif
                                    @foreach($exams as $exam)
                                        <tr>
                                            <td>{{$exam->title}}</td>
                                            <td>{{$exam->time}} دقیقه</td>
                                            <td>
                                                <button type="text" id="mark4" name="mark4"
                                                        @if(getexpireexam($exam->expire) == 'پایان فرصت') class="btn btn-danger"
                                                        @else class="btn btn-success" @endif >{{getexpireexam($exam->expire)}}
                                                </button>
                                            </td>
                                            <td>
                                                @if(getexpireexam($exam->expire) == 'پایان فرصت')

                                                    @if(!empty($exam->mymarks[0]))
                                                        <span
                                                            style="color: black">{{round($exam->mymarks[0]->mark,2)}}</span>
                                                    @endif
                                                @endif


                                            </td>
                                            <td>
                                                @if(getexpireexam($exam->expire) == 'پایان فرصت')
                                                    <a href="/student/exam/view/{{$exam->id}}">
                                                        <button class="btn btn-warning">مشاهده پاسخ ها</button>
                                                    </a>
                                                @else
                                                    <a href="/student/takeexam/{{$exam->id}}">
                                                        <button class="btn btn-primary"> آزمون دهید</button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-4">
                <div class="widget_header">
                    <h4>همکلاسی های من</h4>
                    <div class="ex-header"><span class="students_num">{{count($students)}} نفر</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <ul>
                            @foreach($students as $student)
                                <li>
                                    <figure class="avatar avatar-sm">
                                        @if(!empty($student->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$student->filename)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endif                                    </figure>
                                    <span class="user_display_name">
                                        {{$student->f_name}}
                                        {{$student->l_name}}
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

<?php
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

}

function getexpireexam($expire)
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

}

function getmark($tamrinid)
{
    $iduser = auth()->user()->id;
    if (auth()->user()->role == 'اولیا') {
        $iduser = auth()->user()->id - 1000;
    }
    $mark = \App\JTamrin::where('tamrin_id', $tamrinid)->where('user_id', $iduser)->pluck('mark')->first();
    return $mark;
}

?>
