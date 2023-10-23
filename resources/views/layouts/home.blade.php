<!DOCTYPE html>
<html lang="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@include('includ.name')</title>
    <meta name="name" content="@include('includ.name')">
    {{--<meta name="description" content="{{config('global.school')}} دوره دوم جهان تربیت واقع در منطقه ۸ تهران">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{--<link rel="apple-touch-icon" href="/home/images/favicon.png">--}}
    <link rel="shortcut icon" href="/homee/images/favicon.ico">
    <link rel="stylesheet" href="/homee/css/bootstrap.min.css">
    <link rel="stylesheet" href="/homee/css/plugins.css">
    <link rel="stylesheet" href="/homee/css/style.css">
    <link rel="stylesheet" href="/homee/css/custom.css">
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <link rel="stylesheet" href="/assets/vendors/swiper/swiper.min.css">

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="{{'/uploads/'.\App\Setting::all()->first()->logo}}">
    <!-- end::favicon -->

</head>

<body>
<!-- Preloader -->
<div class="tm-preloader">
    <span class="tm-preloader-box"></span>
    <button class="tm-button tm-button-sm tm-button-white">لغو پیش بارگیری<b></b></button>
</div>
<!--// Preloader -->
<!-- Wrapper -->
<div id="wrapper" class="wrapper">
    <!-- Header -->
    <div class="header sticky-header">
        <!-- Header Top Area -->
        <div class="header-toparea">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="header-topinfo">
                            <ul>
                                <li><a href=""><i class="fa fa-phone"></i>{{$rows->phone}}</a>
                                </li>
                                <li><a href=""><i
                                            class="fa fa-envelope-o"></i>{{$rows->email}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="header-topinfo text-right">
                            <ul>
                                <li><i class="fa fa-clock-o"></i>{{$rows->day}}:{{$rows->time}}
                                    <a href="/login">
                                        <button class="btn btn-danger btn-rounded ">ورود به پنل</button>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Header Top Area -->

        <!-- Header Bottom Area -->
        <div class="header-bottomarea">
            <div class="container">
                <div class="header-bottominner rtl  ">
                    <a href="/"> <img style="height: 90px;width: 90px"   class="rounded-circle" src=" {{'/uploads/'.\App\Setting::all()->first()->logo}}"></a>
                    <nav class="tm-navigation">
                        <ul>
                            <li class=""><a href="/">خانه</a></li>
                            <li class="tm-navigation-dropdown"><a>افراد</a>
                                <ul>
                                    <li><a href="/view/برترها">برترها</a></li>
                                    <li><a href="/view/پرسنل">پرسنل {{config('global.school')}}</a></li>
                                    <li><a href="/view/نمایندگان">نمایندگان کلاس ها</a></li>
                                </ul>
                            </li>
                            <li class="tm-navigation-dropdown"><a>رویدادها</a>
                                <ul>
                                    <li><a href="/view/اخبار">اخبار</a></li>
                                    <li><a href="/view/مسابقات">مسابقات</a></li>
                                    <li><a href="/view/افتخارات">افتخارات</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="/blogs">وبلاگ {{config('global.student')}}</a></li>
                            <li><a href="/view/گالری تصویر">گالری تصاویر</a></li>
                            <li><a href="/pre-registration" style="color: red">پیش ثبت نام</a></li>
                            <li><a href="/question" style="color: blue">تالار گفتمان</a></li>

                        </ul>
                    </nav>
                    <div class="header-icons">
                        <ul>
                            <li>
                                <button title="Search" class="header-searchtrigger"><i class="fa fa-search"></i>
                                </button>
                            </li>
                            <li>
                                <a href="/login">
                                    <button title="ورود" class="header-loginformtrigger" type="button"><i
                                            class="fa fa-user"></i></button>
                                </a>
                            </li>
                            <li>

                            </li>
                        </ul>
                    </div>
                    <!-- Header Searchform -->
                    <div class="header-searchbox">
                        <form action="/search" class="widget-search-form" method="post">
                            @csrf
                            <input name="search" id="serrch" type="text" placeholder="جستجوی...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!--// Header Searchform -->

                </div>
                <div class="header-mobilemenu clearfix">
                    <div class="tm-mobilenav"></div>
                </div>
            </div>
        </div>
        <!--// Header Bottom Area -->

    </div>
    <!--// Header -->

@yield('slider')

<!-- Main -->
@yield('main')

<!-- Footer Area -->
    <div class="footer fixed-footer">
        <!-- Footer Widgets Area -->
        <div class="footer-toparea" style="padding-top: 120px" data-bgimage="/homee/images/bg/footer-bg.jpg"
             data-overlay="2">
            <div class="container">
                <div class="row widgets footer-widgets">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget (Widget Info) -->
                        <div class="single-widget widget-info">
                            <p>
                                {{$rowsss->body}}
                            </p>
                        </div>
                        <a href="manage">
                            <button class="btn btn-primary">سخن مدیریت</button>
                        </a>
                        <!--// Single Widget (Widget Info) -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget (Widget Contact) -->
                        <div class="single-widget widget-quicklinks">
                            <h5 class="widget-title">لینک های سریع</h5>
                            <ul>
                                @foreach($rowss as $ro)
                                    <li><a href="{{$ro->site}}">{{$ro->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--// Single Widget (Widget Contact) -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget (Widget Blog) -->
                        <div class="single-widget widget-recentpost">
                            <h5 class="widget-title">پست های اخیر</h5>
                            <ul>
                                @foreach($recents as $recent)
                                    <li>
                                        @if(\App\HomeImage::where('matlab_id',$recent->id)->first())
                                            <a href="/single/{{$recent->id}}" class="widget-recentpost-image">
                                                <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$recent->id)->first()['resize_image'])}}"
                                                     alt="blog thumbnail">
                                            </a>
                                        @else
                                            <a href="/single/{{$recent->id}}" class="widget-recentpost-image">
                                                <img src="homee/images/logo.png"
                                                     alt="blog thumbnail">
                                            </a>

                                        @endif
                                        <div class="widget-recentpost-content">
                                            <h6><a href="/single/{{$recent->id}}">
                                                    {{$recent->title}}</a></h6>
                                            <span></span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--// Single Widget (Widget Blog) -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget (Widget Newsletter) -->
                        <div class="single-widget widget-newsletter">
                            <h5 class="widget-title">در تماس باشید</h5>
                            <p>سوالات مختلف، راه حل مسائل خود در {{config('global.school')}} را از ما دریافت کنید</p>
                            <form id="tm-mailchimp-form" class="widget-newsletter-form">


                                <input id="mc-email" type="email" placeholder="ادرس پست الکترونیکی را وارد کن">
                                <button id="mc-submit" type="submit" class="tm-button">مشترک شوید<b></b></button>
                            </form>
                            <!-- Mailchimp Alerts -->
                            <div class="tm-mailchimp-alerts">
                                <div class="tm-mailchimp-submitting"></div>
                                <div class="mailchimp-success"></div>
                                <div class="tm-mailchimp-error"></div>
                            </div>
                            <!--// Mailchimp Alerts -->
                        </div>
                        <!--// Single Widget (Widget Newsletter) -->
                    </div>
                </div>
            </div>
        </div>
        <!--// Footer Widgets Area -->

        <!-- Footer Copyright Area -->
        <div class="footer-copyrightarea">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8 col-12">
                        <p class="footer-copyright"><a href="#"> شرکت اترک وب</a>تمام حقوق محفوظ است</p>
                    </div>
                </div>
            </div>
        </div>
        <!--// Footer Copyright Area -->
    </div>
    <!--// Footer Area -->

    <!--// Wrapper -->

    <!-- Js Files -->
    <script src="/homee/js/modernizr-3.6.0.min.js"></script>
    <script src="/homee/js/jquery.min.js"></script>
    <script src="/homee/js/popper.min.js"></script>
    <script src="/homee/js/bootstrap.min.js"></script>
    <script src="/homee/js/plugins.js"></script>
    <script src="/homee/js/main.js"></script>


    <!--// Js Files -->
    <script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')

<!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->


    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::swiper -->
    <script src="/assets/vendors/swiper/swiper.min.js"></script>
    <script src="/assets/js/examples/swiper.js"></script>
    <!-- end::swiper -->
</body>

</html>
