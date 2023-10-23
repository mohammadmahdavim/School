<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> سامانه یکپارچه {{config('global.school')}}</title>
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
    <link rel="shortcut icon" href="{{'/uploads/'.\App\Setting::all()->first()->logo}}">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->
    @yield('css')

</head>
<body>

<!-- begin::page loader-->
<div class="page-loader text-info">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            @if(auth()->user()->role=='دانش آموز' or auth()->user()->role=='اولیا')
                <a class="navbar-brand" href="/student"><i class="icon ti-home"></i>
                    <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>

            @elseif(auth()->user()->role=='معلم')
                <a class="navbar-brand" href="/teacher"><i class="icon ti-home"></i>
                    <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>
            @elseif(auth()->user()->role=='مدیر')
                <a class="navbar-brand" href="/admin/home"><i class="icon ti-home"></i>

                    <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>

            @elseif(auth()->user()->role=='ناظم')
                <a class="navbar-brand" href="/nazem"><i class="icon ti-home"></i>
                    <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>
            @elseif(auth()->user()->role=='معاون')
                <a class="navbar-brand" href="/moaven"><i class="icon ti-home"></i>
                    <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>
            @elseif(auth()->user()->role=='مشاور')
                <a class="navbar-brand" href="/moshver"><i class="icon ti-home"></i>
                    <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>
            @endif


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

                        </a>
                        {{--<a href="/mails/inbox" class="d-lg-none d-sm-block nav-link search-panel-open">--}}

                        {{--</a>--}}

                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown">
                            <figure class="avatar avatar-sm avatar-state-success">
                                @if(auth()->user()->resizeimage)
                                    <img class="rounded-circle"
                                         src="{{url('uploads/'.auth()->user()->resizeimage)}}"
                                         alt="...">
                                @else
                                    <img class="rounded-circle" src="/assets/profile/avatar.png"
                                         alt="...">
                                @endisset
                            </figure>
                        </a>
                        <div class=" dropdown-menu dropdown-menu-right">
                            <a href="/profile" class="dropdown-item">پروفایل</a>
                            <a href="/mails/inbox" class="dropdown-item">پیام ها</a>
                            @if(auth()->user()->role=='دانش آموز' or auth()->user()->role=='اولیا')
                                <a href="/student" class="dropdown-item"> ورود به پنل</a>
                            @elseif(auth()->user()->role=='معلم')
                                <a href="/teacher" class="dropdown-item">ورود به پنل</a>
                            @else
                                <a href="/admin/home" class="dropdown-item">ورود به پنل</a>
                            @endif
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
<div style="text-align: center">
    <!-- end::navbar -->

    <!-- begin::main content -->

    <div class="main-content col-md-11">

        <div class="container-fluid">

            <!-- begin::page header -->
        @yield('header')

        <!-- end::page header -->

            @yield('content')


        </div>

    </div>
</div>

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
