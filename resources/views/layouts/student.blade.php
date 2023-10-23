<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @include('includ.name')</title>
    <link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <link rel="stylesheet" href="/assets/vendors/swiper/swiper.min.css">

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/custom.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="{{'/uploads/'.$setting->logo}}">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->
    @yield('css')

    <style>
        .btn-smll {
            padding: 10px 8px;
            font-size: 10px;
            border-radius: 8px;
            Height: 10px;
        }

        #rcorners1 {
            border-radius: 20px 10px 20px 10px;
            padding: 20px;
            width: 300px;
            height: 100px;
        }
    </style>
</head>
<body>

<!-- begin::page loader-->
<div class="page-loader text-info">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<!-- begin::sidebar -->
<div class="sidebar">
    <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="pill" href="#messages" role="tab"
               aria-controls="messages" aria-selected="true">
                <i class="fa fa-envelope"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="pill" href="#notifications" role="tab"
               aria-controls="notifications" aria-selected="false">
                <i class="fa fa-bell"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab"
               aria-controls="settings" aria-selected="false">
                <i class="ti-settings"></i>
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">

            <div class="tab-pane-footer">
                <a href="#" class="btn btn-primary btn-block">گفتگوی جدید</a>
            </div>
        </div>
        <div class="tab-pane" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <div class="tab-pane-body">
                <h5 class="font-weight-bold m-b-20">اعلان ها</h5>
                <div>
                    <p class="text-muted">امروز</p>
                    <ul class="list-group list-group-flush m-b-10">
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title bg-success rounded-circle">آ</span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">
                                    <span class="badge small badge-danger">جدید</span>
                                    ثبت نام کاربر جدید.
                                </p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">8 دقیقه پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-cloud-upload"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">فایل ها با موفقیت آپلود شدند.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">50 دقیقه پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="text-muted">دیروز</p>
                    <ul class="list-group list-group-flush m-b-10">
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title bg-warning rounded-circle">V</span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">ثبت نام کاربر جدید.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">5 ساعت پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-file-o"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">صورتحساب شما آماده شد.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">10 ساعت پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <figure class="avatar avatar-xs m-l-10">
                                    <span class="avatar-title rounded-circle">
                                        <i class="fa fa-cloud-upload"></i>
                                    </span>
                                </figure>
                            </div>
                            <div>
                                <p class="m-b-0">فایل ها با موفقیت آپلود شدند.</p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">16 ساعت پیش</li>
                                    <li class="list-inline-item">
                                        <a href="#">علامت خوانده شده</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">مشاهده</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane-footer">
                <a href="#" class="btn btn-primary btn-block">علامت خوانده شده به همه</a>
            </div>
        </div>
        <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="tab-pane-body">

                <div class="m-b-30">
                    <h5 class="font-weight-bold m-b-20">تنظیمات</h5>
                    <h6 class="font-weight-bold">سیستم</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>به روز رسانی خودکار</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>وضعیت کنونی</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                <label class="custom-control-label" for="customSwitch2"></label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between p-l-r-0">
                            <span>پیشنهادات کاربران</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                <label class="custom-control-label" for="customSwitch3"></label>
                            </div>
                        </li>
                    </ul>
                </div>
                {{--<div class="m-b-30">--}}
                {{--<h6 class="font-weight-bold">حساب کاربری</h6>--}}
                {{--<ul class="list-group list-group-flush">--}}
                {{--<li class="list-group-item d-flex justify-content-between p-l-r-0">--}}
                {{--<span>امنیت حساب کاربری ارشد</span>--}}
                {{--<div class="custom-control custom-switch">--}}
                {{--<input type="checkbox" class="custom-control-input" id="customSwitch4">--}}
                {{--<label class="custom-control-label" for="customSwitch4"></label>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li class="list-group-item d-flex justify-content-between p-l-r-0">--}}
                {{--<span>حفاظت حساب کاربری</span>--}}
                {{--<div class="custom-control custom-switch">--}}
                {{--<input type="checkbox" class="custom-control-input" id="customSwitch5" checked>--}}
                {{--<label class="custom-control-label" for="customSwitch5"></label>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="m-b-30">--}}
                {{--<h6 class="font-weight-bold">اعلان ها</h6>--}}
                {{--<ul class="list-group list-group-flush">--}}
                {{--<li class="list-group-item d-flex justify-content-between p-l-r-0">--}}
                {{--<span>اعلان های مرورگر</span>--}}
                {{--<div class="custom-control custom-switch">--}}
                {{--<input type="checkbox" class="custom-control-input" id="customSwitch6">--}}
                {{--<label class="custom-control-label" for="customSwitch6"></label>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li class="list-group-item d-flex justify-content-between p-l-r-0">--}}
                {{--<span>اعلان های موبایل</span>--}}
                {{--<div class="custom-control custom-switch">--}}
                {{--<input type="checkbox" class="custom-control-input" id="customSwitch7">--}}
                {{--<label class="custom-control-label" for="customSwitch7"></label>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li class="list-group-item d-flex justify-content-between p-l-r-0">--}}
                {{--<span>اشتراک ایمیل</span>--}}
                {{--<div class="custom-control custom-switch">--}}
                {{--<input type="checkbox" class="custom-control-input" id="customSwitch8">--}}
                {{--<label class="custom-control-label" for="customSwitch8"></label>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li class="list-group-item d-flex justify-content-between p-l-r-0">--}}
                {{--<span>اعلان های sms</span>--}}
                {{--<div class="custom-control custom-switch">--}}
                {{--<input type="checkbox" class="custom-control-input" id="customSwitch9" checked>--}}
                {{--<label class="custom-control-label" for="customSwitch9"></label>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
            </div>
            <div class="tab-pane-footer">
                <a href="#" class="btn btn-primary btn-block">ذخیره تنظیمات</a>
            </div>
        </div>
    </div>
</div>
<!-- end::sidebar -->

<!-- begin::side menu -->
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            @if(auth()->user()->role=='دانش آموز' or auth()->user()->role=='اولیا')
                <li><a class="navbar-brand" href="/student"><i class="icon ti-home"></i> <span>داشبورد</span></a></li>

            @elseif(auth()->user()->role=='معلم')
                <li><a class="navbar-brand" href="/teacher"><i class="icon ti-home"></i> <span>داشبورد</span></a></li>
            @elseif(auth()->user()->role=='مدیر')
                <li><a class="navbar-brand" href="/admin"><i class="icon ti-home"></i> <span>داشبورد</span></a></li>
            @elseif(auth()->user()->role=='ناظم')
                <li><a class="navbar-brand" href="/nazem"><i class="icon ti-home"></i> <span>داشبورد</span></a></li>
            @elseif(auth()->user()->role=='معاون')
                <li><a class="navbar-brand" href="/moaven"><i class="icon ti-home"></i> <span>داشبورد</span></a></li>
            @elseif(auth()->user()->role=='مشاور')
                <li><a class="navbar-brand" href="/moshaver"><i class="icon ti-home"></i> <span>داشبورد</span></a></li>
            @endif

            <li>
                <a href="#"><i class="icon-pencil7"></i> &nbsp &nbsp<span>درس های من</span> </a>
                <ul>
                    @foreach($doros as $dars)
                        <li><a href="/student/dars/{{$dars->id}}">
                                {{$dars->name}}
                            </a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-pencil7"></i> &nbsp &nbsp<span>نمرات من</span> </a>
                <ul>
                    @foreach($doros as $dars)
                        <li><a href="/student/mark{{$dars->id}}">
                                {{$dars->name}}
                            </a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-magazine"></i> &nbsp &nbsp<span>کارنامه من</span> </a>
                <ul>
                    <li><a href="/student/karname/month">کارنامه ماهانه سایت</a>
                    </li>
                    <li><a href="#">کارنامه اصلی {{config('global.school')}}</a>
                        <ul>
                            @foreach($karnamehs as $karnameh)
                                <li><a href="/student/karname/school/{{$karnameh->id}}">{{$karnameh->name}}</a>
                                </li>
                            @endforeach
                            @foreach($newkarname as $newkarnam)
                                <li>
                                    <a href="/student/newkarname/school/{{$newkarnam->name}}/{{$newkarnam->user_id}}">{{$newkarnam->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack-text"></i>&nbsp &nbsp <span>تکالیف من</span></a>
                <ul>
                    <li><a href="/student/tamrinoutbox"><i class="icon-upload"></i>&nbsp
                            &nbsp<span>تکالیف ارسال کرده</span></a>
                    </li>
                    <li><a href="/student/tamrininbox"><i class="icon-download"></i>&nbsp &nbsp<span>تکالیف دریافت
                                شده</span></a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="icon-chart"></i>&nbsp &nbsp <span>نمودار ها</span></a>
                <ul>
                    <li><a href="#"><i class="icon-stats-bars2"></i>&nbsp &nbsp<span>نمودارهای مقایسه</span></a>
                        <ul>
                            <li><a href="/student/chartsahm"> سهم
                                    دروس
                                    در معدل کل</a></li>
                            <li><a href="/student/charttamrin"> وضعیت تحویل تمارین</a></li>
                            <li><a href="/student/chartmark"> نمره هر
                                    درس </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-stats-dots"></i>&nbsp &nbspنمودارهای پیشرفت </a>
                        <ul>
                            <li><a href="#">دروس</a>
                                <ul>
                                    @foreach($doros as $dars)
                                        <a href="/student/chartmarks{{$dars->id}}">
                                            <li>  {{$dars->name}} </li>
                                        </a>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a href="/student/moadel">معدل محور</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack-text"></i>&nbsp &nbsp <span>کتابخانه</span></a>
                <ul>
                    <li><a href="/student/library/school"><span>
                                 کتاب های {{config('global.school')}}
                                </span></a></li>
                    <li><a href="/student/library/mybook"><span>در دست من</span></a>
                    </li>
                    <li><a href="/student/library/myreserve"><span>
                                 رزرو کرده
                                </span></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-users4"></i> &nbsp &nbsp <span>مشاوره</span></a>
                <ul>
                    <li><a href="/student/moshaver/barname"><span>
                                 برنامه ها
                                </span></a></li>
                    <li><a href="/student/moshaver"><span>جلسات</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-users4"></i> &nbsp &nbsp <span>انتخابات و نظر سنجی</span></a>
                <ul>
                    <li><a href="/student/selection/"><span>
                                 شرکت نکرده
                                </span></a></li>
                    <li><a href="/student/selection/past"><span>شرکت کرده</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/student/finance"><i class="icon-cash"></i> &nbsp &nbsp<span>مالی</span>
                </a>
            </li>
            <li>
                <a href="/student/discipline"><i class="icon-users4"></i> &nbsp &nbsp<span>موارد انضباطی ثبت شده</span>
                </a>
            </li>
            <li>
                <a href="/student/rollcall"><i class="icon-users4"></i> &nbsp &nbsp<span>غیبت های من</span> </a>
            </li>
            <li>
                <a href="{{ route('barnamedars.download', auth()->user()->class) }}"><i class="icon-download"></i>&nbsp
                    &nbsp<span>دانلود برنامه درسی</span> </a>
            </li>
            <li>
                <a href="{{ route('barnameemtehan.download', auth()->user()->class) }}"><i class="icon-download"></i>&nbsp
                    &nbsp<span>دانلود برنامه امتحانی</span> </a>
            </li>
            <li>
                <a href="/"><i class="icon-stack-empty"></i>
                    &nbsp &nbsp<span
                    > مطالب آموزشی</span></a>
                <ul>
                    @foreach($doros as $dars)
                        <li><a href="/myfilm/{{$dars->id}}">
                                {{$dars->name}}
                            </a></li>
                    @endforeach
                </ul>
            </li>
            {{--<li>--}}
            {{--<a href="/student/tuition"><i class="icon-cash"></i>--}}
            {{--&nbsp &nbsp<span--}}
            {{-->شهریه</span></a>--}}
            {{--</li>--}}
            <li>
                <a href="/student/exam"><i class="icon-pencil"></i>
                    &nbsp &nbsp<span
                    >آزمون</span></a>
            </li>
            <li>
                <a href="/student/tagvim">
                    <i class="icon-bookmarks"></i>
                    &nbsp &nbsp
                    <span> برنامه کلاسی</span></a>
            </li>
            <li>
                <a href="/student/online/index">
                    <i class="fa fa-window-maximize"></i>
                    &nbsp &nbsp
                    <span> کلاس های آنلاین</span></a>
            </li>
            <li>
                <a href="/student/pattern">
                    <i class="fa fa-window-maximize"></i>
                    &nbsp &nbsp
                    <span>الگو مطالعه</span></a>
            </li>
        </ul>


    </div>
</div>
<!-- end::side menu -->

<!-- begin::navbar -->
<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            <a href="/student">
                <span class="logo-text d-none d-lg-block">@include('includ.name')</span>
            </a>
        </div>
        <div style="text-align: left">
            <div class="header-body">


                <ul class="navbar-nav">
                    <spane style="color: #a8e4ff;text-align: center">
                        <li class="nav-item">

                            @if(auth()->user()->role=='دانش آموز')

                                {{config('global.student')}}

                            @else
                                {{config('global.parent')}}
                            @endif
                            عزیز

                            @if(auth()->user()->sex=='مرد')
                                آقای
                            @elseif(auth()->user()->sex=='خانم')خانم
                            @endif
                            &nbsp
                            <span style="color: red">

                    {{auth()->user()->f_name}}
                                {{auth()->user()->l_name}}
</span>
                            &nbsp
                            خوش آمدید.
                        </li>
                    </spane>
                    <li class="nav-item">
                        <a href="/mails/inbox" class="nav-link ">
                            <i class="fa fa-envelope"></i>
                            @if($count != 0)<span class="btn btn-danger btn-smll">{{$count}}</span>@endif

                        </a>
                        {{--<a href="/mails/inbox" class="d-lg-none d-sm-block nav-link search-panel-open">--}}

                        {{--</a>--}}

                    </li>
                    {{--<li class="nav-item">--}}
                    {{--<a href="/mails/inbox" class="nav-link nav-link-notify ">--}}
                    {{--<i class="fa fa-envelope"></i>--}}
                    {{--</a>--}}
                    {{--</li>--}}


                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown">
                            <figure class="avatar avatar-sm avatar-state-success">
                                @if(!empty(auth()->user()->resizeimage))
                                    <img class="rounded-circle" src="{{url('uploads/'.auth()->user()->resizeimage)}}"
                                         alt="...">
                                @else
                                    <img class="rounded-circle" src="/assets/profile/avatar.png"
                                         alt="...">
                                @endisset
                            </figure>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/profile" class="dropdown-item">پروفایل</a>
                            <a href="/mails/inbox" class="dropdown-item">پیام ها</a>
                            <div class="dropdown-divider"></div>
                            <a href="/" class="text-warning dropdown-item">صفحه اول سایت</a>
                            <a href="/logout" class="text-danger dropdown-item">خروج</a>
                        </div>
                    </li>
                    <li class="nav-item d-lg-none d-sm-block">
                        <a href="#" class="nav-link side-menu-open">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- end::navbar -->

<!-- begin::main content -->
<main class="main-content">

    <div class="container-fluid">

        <!-- begin::page header -->
    @yield('header')

    <!-- end::page header -->
        <div class="row noprint" id="printbtn">
            <div class="col-lg-4 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-danger-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p>رتبه در کلاس</p>

                    </div>
                    <div class="p-2">
                        <h2 class="m-b-0 text-black font-weight-800 primary-font">{{getclass($count=0)}}</h2>

                    </div>

                    <div class="icon-block icon-block-outline-black icon-block-floating m-l-20">
                        <i class="icon-home8"></i>
                    </div>


                </div>


            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-success-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p>رتبه در {{config('global.paye')}}</p>

                    </div>
                    <div class="p-2">
                        <h2 class="m-b-0 text-black font-weight-800 primary-font">{{getpaye($count=0)}}</h2>

                    </div>
                    <div class="icon-block icon-block-outline-black icon-block-floating m-l-20">
                        <i class="icon-user-tie"></i>
                    </div>


                </div>


            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-primary-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p> آخرین معدل </p>

                    </div>
                    <div class="p-2">
                        <h2 class="m-b-0 text-black font-weight-800 black-font">{{getamoadel()}}</h2>

                    </div>

                    <div class="icon-block icon-block-outline-black icon-block-floating m-l-20">

                        <i class="icon-man"></i>
                    </div>


                </div>


            </div>
        </div>
        @yield('content')


    </div>

</main>
<!-- end::main content -->

<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::chart -->

<!-- end::chart -->

<!-- begin::swiper -->

<!-- end::swiper -->

<!-- begin::custom scripts -->
<script src="/assets/js/custom.js"></script>
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->
@yield('script')

</body>
</html>
<?php
function getclass()
{
    $id = auth()->user()->id;
    if (auth()->user()->role == 'اولیا') {
        $id = auth()->user()->id - 1000;
    }
    $class = \App\User::where('id', $id)->first()['class'];
    $collection = \Illuminate\Support\Facades\DB::table('s_mkarnamehs')->where('class_id', $class)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->orderBy('avg', 'DESC')
        ->groupBy('user_id')
        ->get();
    $mymark = \Illuminate\Support\Facades\DB::table('s_mkarnamehs')->where('user_id', $id)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark)'))
        ->pluck('avg(mark)');
    $data = $collection->where('avg', $mymark[0]);
    $value = $data->keys()->first() + 1;
    return $value;
}

function getpaye()
{
    $id = auth()->user()->id;
    if (auth()->user()->role == 'اولیا') {
        $id = auth()->user()->id - 1000;
    }
    $class = \App\User::where('id', $id)->first()['class'];
    $paye = \App\clas::where('classnamber', $class)->first()['paye'];
    $classs = \App\clas::where('paye', $paye)->pluck('classnamber');
    $collection = \Illuminate\Support\Facades\DB::table('s_mkarnamehs')->wherein('class_id', $classs)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->orderBy('avg', 'DESC')
        ->groupBy('user_id')
        ->get();
    $mymark = \Illuminate\Support\Facades\DB::table('s_mkarnamehs')->where('user_id', $id)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark)'))
        ->pluck('avg(mark)');
    $data = $collection->where('avg', $mymark[0]);
    $value = $data->keys()->first() + 1;
    return $value;
}

function getamoadel()
{
    $idk = \App\SKarnameh::latest()->pluck('karnameh_id')->first();
    $mykarnamehs = \App\SKarnameh::where('karnameh_id', $idk)->where('user_id', auth()->user()->id)->get();
    $marks = 0;
    $vaheds = 0;
    foreach ($mykarnamehs as $mykarnameh) {
        $vahed = \App\dars::where('id', $mykarnameh->dars_id)->first()['vahed'];
        $mark = ($mykarnameh->mark) * $vahed;
        $vaheds = $vaheds + $vahed;
        $marks = $marks + $mark;
    }
    if ($vaheds == 0) {
        $moadel = 0;
    } else
        $moadel = round($marks / $vaheds, 2);

    return $moadel;

}

?>
