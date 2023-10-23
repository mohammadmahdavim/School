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

{{--<link rel="stylesheet" href="/assets/vendors/swiper/swiper.min.css">--}}

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
                <a href="/teacher/students">
                    <i class="icon-users4"></i> &nbsp &nbsp
                    <span> اطلاعات {{config('global.students')}}</span></a>
                <ul>
                    {{--<li>--}}
                    {{--<a href="/teacher/students">--}}
                    {{--کل {{config('global.students')}}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    @foreach($data->unique('class_id') as $cls)
                        <li>
                            <a href="/teacher/students/single/{{$cls->class[0]->classnamber}}">
                                {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                            </a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="/teacher/students">
                    <i class="icon-users4"></i> &nbsp &nbsp
                    <span> لیست حضور غیاب</span></a>
                <ul>
                    @foreach($data->unique('class_id') as $cls)
                        <li>
                            <a href="/teacher/students/rollcall/{{$cls->class[0]->classnamber}}">
                                {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                            </a></li>
                    @endforeach
                </ul>
            </li>
                <li>
                    <a href="/teacher/students">
                        <i class="icon-users4"></i> &nbsp &nbsp
                        <span> لیست ثبت انضباط</span></a>
                    <ul>
                        @foreach($data->unique('class_id') as $cls)
                            <li>
                                <a href="/teacher/discipline/create/{{$cls->class[0]->classnamber}}">
                                    {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                </a></li>
                        @endforeach
                    </ul>
                </li>

            <li>
                <a href="#"><i class="icon-pencil7"></i> &nbsp &nbsp <span
                    >نمره</span></a>
                <ul>
                    <li>
                        <a href="#">ایجاد آیتم نمره</a>
                        <ul>

                            @foreach($data as $cls)
                                <a href="/teacher/createmarkshow/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                    <li>
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                        -{{$cls->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach

                        </ul>

                    </li>
                    <li>
                        <a href="#">مشاهده آیتم های وارد کرده</a>
                        <ul>
                            @foreach($data as $cls)
                                <a href="/teacher/viewmark/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                    <li>
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                        -{{$cls->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach
                            {{--@foreach($claas as $cls)--}}
                            {{--<a href="/teacher/viewmark/{{$cls->classnamber}}">--}}
                            {{--<li value="{{$cls->classnamber}}">{{$cls->paye}}--}}
                            {{---{{$cls->classnamber}}</li>--}}
                            {{--</a>--}}
                            {{--@endforeach--}}

                        </ul>

                    </li>
                    <li>
                        <a href="#">نمره دهی</a>
                        <ul>
                            @foreach($data as $cls)
                                <a href="/teacher/mark/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                    <li>
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                        -{{$cls->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach


                        </ul>

                    </li>

                </ul>
            </li>

            <li>
                <a href="#"><i class="icon-stack-text"></i>&nbsp &nbsp<span
                    >تولید کارنامه</span></a>
                <ul>
                    @foreach($karnamehs as $karnameh)
                        <li><a href="#">{{$karnameh->name}}</a>
                            <ul>
                                @foreach($data as $cls)
                                    <a href="/teacher/karnameh/create/{{$karnameh->id}}/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                        <li style="font-size: smaller">
                                            {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                            -{{$cls->darss[0]->name}}

                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-magazine"></i>&nbsp &nbsp<span
                    >مشاهده کارنامه</span></a>
                <ul>
                    @foreach($karnamehs as $karnameh)
                        <li><a href="#">{{$karnameh->name}}</a>
                            <ul>
                                @foreach($data as $cls)
                                    <a href="/teacher/karnameh/show/{{$karnameh->id}}/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                        <li style="font-size: smaller">                                            {{$cls->class[0]->paye}}
                                            -{{$cls->class[0]->classnamber}}-{{$cls->darss[0]->name}}

                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    @foreach($newkarname as $newkarnam)
                        <li><a href="#">{{$newkarnam->name}}</a>
                            <ul>
                                @foreach($data as $cls)
                                    <a href="/teacher/newkarnameh/show/{{$newkarnam->name}}/{{$cls->class[0]->classnamber}}">
                                        <li style="font-size: smaller">                                            {{$cls->class[0]->paye}}
                                            -{{$cls->class[0]->classnamber}}-{{$cls->darss[0]->name}}

                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack-empty"></i>
                    &nbsp &nbsp<span
                    >تکالیف</span></a>
                <ul>
                    <li><a href="/teacher/uploadtamrin">آپلود
                            تکالیف</a></li>
                    <li><a href="/teacher/outboxtamrin/archive">
                            آرشیو من</a></li>
                    <li><a href="">تکالیف ارسال شده</a>
                        <ul>

                            @foreach($data as $cls)
                                <a href="/teacher/outboxtamrin{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                    <li>{{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                        -{{$cls->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach
                        </ul>

                    </li>
                    <li><a href="">تکالیف دریافت شده</a>
                        <ul>
                            @foreach($data as $cls)
                                <a href="/teacher/inboxtamrin{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                    <li>{{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                        -{{$cls->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stats-growth"></i> &nbsp &nbsp <span
                    >نمودار ها</span></a>
                <ul>
                    {{--<li><a href="#">تعداد {{config('global.students')}}</a>--}}
                    {{--<ul>--}}
                    {{--<li><a href="/teacher/paye">پایه محور--}}
                    {{--</a></li>--}}
                    {{--<li><a href="/teacher/class">کلاس محور</a></li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    <li><a href="#">مقایسه نمره ها </a>
                        <ul>
                            <li><a href="#">مقایسه {{config('global.students')}}</a>
                                <ul>
                                    @foreach($data as $dars)
                                        <a href="/teacher/chartmark{{$dars->class[0]->classnamber}}/{{$dars->darss[0]->id}}">
                                            <li value=""> {{$dars->class[0]->paye}}-{{$dars->class[0]->classnamber}}
                                                -{{$dars->darss[0]->name}}
                                            </li>
                                        </a>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a href="/teacher/classmark">مقایسه دروس</a>
                            </li>

                        </ul>
                    </li>
                    <li><a href=""> پیشرفت دروس</a>
                        <ul>
                            @foreach($data as $dars)
                                <li>
                                    <a href="/teacher/develop{{$dars->class[0]->classnamber}}/{{$dars->darss[0]->id}}">
                                        <h8>{{$dars->class[0]->paye}}-{{$dars->class[0]->classnamber}}
                                            -{{$dars->darss[0]->name}}</h8>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    {{--                    <li><a href="">غیبت ها</a>--}}
                    {{--                        <ul>--}}
                    {{--                            @foreach($data as $dars)--}}
                    {{--                                <li>--}}
                    {{--                                    <a href="#">--}}
                    {{--                                        --}}{{--<a href="/teacher/students/single/{{$dars->class[0]->classnamber}}/{{$dars->darss[0]->id}}">--}}
                    {{--                                        {{$dars->class[0]->paye}}-{{$dars->class[0]->classnamber}}--}}
                    {{--                                        -{{$dars->darss[0]->name}}--}}
                    {{--                                    </a></li>--}}
                    {{--                            @endforeach--}}

                    {{--                        </ul>--}}
                    {{--                    </li>--}}
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-video-camera"></i>
                    &nbsp &nbsp<span
                    >محتوای آموزشی</span></a>
                <ul>
                    <li><a href="teacher/uploadfilm" style="font-family: 'B Titr'">
                            ارسال
                            مطلب</a>
                        <ul>
                            @foreach($sections as $section)
                                <li>
                                    <a href="/teacher/uploadfilm/{{$section->id}}">
                                        {{$section->section}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/teacher/outboxfilm/archive" style="font-family: 'B Titr'">
                            آرشیو من</a></li>
                    <li><a href="">مطالب ارسال شده</a>
                        <ul>
                            @foreach($data as $dars)
                                <a href="/teacher/outboxfilm/{{$dars->class[0]->classnamber}}/{{$dars->darss[0]->id}}">
                                    <li value="{{$dars->name}}">{{$dars->class[0]->paye}}
                                        -{{$dars->class[0]->classnamber}}-{{$dars->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach
                        </ul>

                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-pencil"></i>
                    &nbsp &nbsp<span
                    >آزمون آنلاین</span></a>
                <ul>
                    <li><a href="/teacher/exam/create" style="font-family: 'B Titr'">
                            ایجاد آزمون جدید</a></li>
                    <li><a href="/teacher/exams/archive" style="font-family: 'B Titr'">
                            آرشیو من</a></li>
                    <li><a href="/teacher/exam">آزمون های تستی</a>
                    <li><a href="/teacher/exams/descriptive">آزمون های تشریحی</a>

                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-window-maximize"></i>
                    &nbsp &nbsp<span
                    >کلاس آنلاین</span></a>
                <ul>
                    <li><a href="/teacher/online_class/create">
                            ایجاد کلاس
                        </a></li>

                    <li><a href="">کلاس های ایجاد شده</a>
                        <ul>

                            @foreach($data as $cls)
                                <a href="/teacher/online/{{$cls->class[0]->classnamber}}">
                                    <li>
                                        کلاس
                                        {{$cls->class[0]->classnamber}}
                                    </li>
                                </a>
                            @endforeach
                        </ul>

                    </li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-book3"></i>
                    &nbsp &nbsp<span
                    >دفتر کلاسی</span></a>
                <ul>
                    @foreach($data as $cls)
                        <a href="/teacher/daftar/date/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                            <li>
                                {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                -{{$cls->darss[0]->name}}
                            </li>
                        </a>
                    @endforeach


                </ul>

            </li>
            <li>
                <a href="#"><i class="icon-pen"></i>
                    &nbsp &nbsp<span
                    >ثبت گزارش روزانه</span></a>
                <ul>
                    <li>
                        <a href="#">نمره دهی</a>
                        <ul>
                            @foreach($data as $cls)
                                <a href="/teacher/mark/date/{{$cls->class[0]->classnamber}}/{{$cls->darss[0]->id}}">
                                    <li>
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                        -{{$cls->darss[0]->name}}
                                    </li>
                                </a>
                            @endforeach


                        </ul>

                    </li>
                    <li>
                        <a href="/teacher/students">
                            <span> لیست حضور غیاب</span></a>
                        <ul>
                            @foreach($data->unique('classnamber') as $cls)
                                <li>
                                    <a href="/teacher/students/rollcall/{{$cls->class[0]->classnamber}}">
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                    </a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="/teacher/students">
                            <span> موارد انضباطی</span></a>
                        <ul>
                            @foreach($data->unique('classnamber') as $cls)
                                <li>
                                    <a href="/teacher/discipline/create/{{$cls->class[0]->classnamber}}">
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                    </a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="/teacher/students">
                            <span> گزارش مشاوره ای</span></a>
                        <ul>
                            @foreach($data->unique('classnamber') as $cls)
                                <li>
                                    <a href="/teacher/moshaver/sabt/{{$cls->class[0]->classnamber}}">
                                        {{$cls->class[0]->paye}}-{{$cls->class[0]->classnamber}}
                                    </a></li>
                            @endforeach
                        </ul>
                    </li>


                </ul>


            </li>
            <li>
                <a href="/teacher/tagvim">
                    <i class="icon-bookmarks"></i>
                    &nbsp &nbsp
                    <span> برنامه</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- end::side menu -->

<!-- begin::navbar -->
<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            <a href="/teacher">
                <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>
            </a>
        </div>
        <div style="text-align: left">
            <div class="header-body">


                <ul class="navbar-nav">
                    <spane style="color: #a8e4ff;text-align: center">
                        <li class="nav-item">
                            {{auth()->user()->role}}
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

                    </li>


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
                            <a href="/admin/home" class="dropdown-item">دسترسی به ادمین</a>
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
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-danger-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p>تعداد کلاس های من</p>

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
                        <p>تعداد {{config('global.students')}} من</p>

                    </div>
                    <div class="p-2">
                        <h2 class="m-b-0 text-black font-weight-800 primary-font">{{getstudent($cuont=0)}}</h2>

                    </div>
                    <div class="icon-block icon-block-outline-black icon-block-floating m-l-20">

                        <i class="icon-man"></i>
                    </div>


                </div>


            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-primary-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <h6>تعداد روزهای حضور </h6>

                    </div>
                    <div class="p-2">
                        <h5 class="m-b-0 text-black font-weight-800 black-font">{{getdays($count=0)}} روز در
                            هفته</h5>
                    </div>

                    <div class="icon-block icon-block-outline-black icon-block-floating m-l-20">
                        <i class="icon-user-tie"></i>
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
    $classid = \App\teacher::where('user_id', $id)->pluck('class_id');
    $claascount = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->whereIn('classnamber', $classid)->count();

    return $claascount;
}

function getdays()
{
    $id = auth()->user()->id;
    $countdays = \App\TeacherPrograme::where('teacher_id', $id)->count();
    return $countdays;

}

function getstudent()
{
    $id = auth()->user()->id;
    $classid = \App\teacher::where('user_id', $id)->pluck('class_id');
    $countstudent = \App\student::whereIn('classid', $classid)->count();
    return $countstudent;
}

?>
