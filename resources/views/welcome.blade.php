
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <title>داشبورد </title>

    <meta content="width  =device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!--[if IE]>
       <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
       <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="/public/assets/plugins/bootstrap/css/bootstrap.rtl.css" />
    <link rel="stylesheet" href="/public/assets/css/main.css" />
    <link rel="stylesheet" href="/public/assets/css/theme.css" />
    <link rel="stylesheet" href="/public/assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="/public/assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="/public/assets/css/layout2.css" rel="stylesheet" />
    <link href="/public/assets/plugins/flot/examples/examples.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/assets/plugins/timeline/timeline.css" />
@yield('css')
<!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

      @yield('script')
        <![endif]-->

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="padTop53 " >

<!-- MAIN WRAPPER -->
<div id="wrap" >


    <!-- HEADER SECTION -->
    <div id="top">

        <nav class="navbar navbar-inverse navbar-fixed-top " style="padding: 10px;">
            <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                <i class="icon-align-justify"></i>
            </a>
            <!-- LOGO SECTION -->
            <header class="navbar-header">

                <a href="index.html" class="navbar-brand">
                    <img src="assets/img/logo.png" alt="" height="30" class="rounded-circle "/>
                    <h1 class="site-title">ایران نهzdsdcsdاد</h1>
                </a>
            </header>
            <!-- END LOGO SECTION -->
            <ul class="nav navbar-top-links navbar-left">

                <!-- MESSAGES SECTION -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="label label-success">2</span>    <i class="icon-envelope-alt"></i>&nbsp; <i class="icon-chevron-down"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>محمد</strong>
                                    <span class="pull-left text-muted">
                                            <em>امروز</em>
                                        </span>
                                </div>
                                <div>متن پیغام برای تست پیغام تستی
                                    <br />
                                    <span class="label label-primary">مهم</span>

                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>علیرضا</strong>
                                    <span class="pull-left text-muted">
                                            <em>دیروز</em>
                                        </span>
                                </div>
                                <div>متن پیغام برای تست پیغام تستی
                                    <br />
                                    <span class="label label-success"> متوسط </span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>مهدی</strong>
                                    <span class="pull-left text-muted">
                                            <em>31 خرداد 93</em>
                                        </span>
                                </div>
                                <div>متن پیغام برای تست پیغام تستی تست تست پیغام
                                    <br />
                                    <span class="label label-danger"> کم </span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <i class="icon-angle-left"></i>
                                <strong>خواندن همه پیغام ها</strong>
                            </a>
                        </li>
                    </ul>

                </li>
                <!--END MESSAGES SECTION -->

                <!--TASK SECTION -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="label label-danger">5</span>   <i class="icon-tasks"></i>&nbsp; <i class="icon-chevron-down"></i>
                    </a>


                </li>
                <!--END TASK SECTION -->

                <!--ALERTS SECTION -->
                <li class="chat-panel dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="label label-info">8</span>   <i class="icon-comments"></i>&nbsp; <i class="icon-chevron-down"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-alerts">

                        <li>
                            <a href="#">
                                <div>
                                    <span class="pull-left text-muted small"> 4 دقیقه پیش</span>
                                    <i class="icon-comment" ></i> کامنت جدید
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <span class="pull-left text-muted small">9 دقیقه پیش</span>
                                    <i class="icon-twitter info"></i> 3 دنبال کننده جدید
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <span class="pull-left text-muted small" > 20 دقیقه پیش</span>
                                    <i class="icon-envelope"></i> ارسال پیغام
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <span class="pull-left text-muted small"> 1 ساعت پیش</span>
                                    <i class="icon-tasks"></i> وظایف جدید
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <span class="pull-left text-muted small"> 2 ساعت پیش</span>
                                    <i class="icon-upload"></i> ورود به سایت
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <i class="icon-angle-left"></i>
                                <strong>مشاهده همه اعلان ها</strong>
                            </a>
                        </li>
                    </ul>

                </li>
                <!-- END ALERTS SECTION -->

                <!--ADMIN SETTINGS SECTIONS -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                    </a>

                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="icon-user"></i> مشاهده پروفایل </a>
                        </li>
                        <li><a href="#"><i class="icon-gear"></i> تنظیمات </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="icon-signout"></i> خروج </a>
                        </li>
                    </ul>

                </li>
                <!--END ADMIN SETTINGS -->
            </ul>

        </nav>

    </div>
    <!-- END HEADER SECTION -->



    <!-- MENU SECTION -->
    <div class="media user-media well-small">
        <a class="user-link" href="#">
            <img size="5px" class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/Webp.net-resizeimage.jpg" />
        </a>
        <br />
        <div class="media-body">
            {{--<h5 class="media-heading">{{auth()->User()->name()}}</h5>--}}
            <ul class="list-unstyled user-info">

                <li>
                    @if(Auth::check())
                        <form action="logout" method="post">
                            <button>خروج از حساب کاربری</button>
                            {!!csrf_field()!!}

                        </form>
                    @else
                        <a href="login" class="btn-dropbox">ورود</a>
                        <br>
                        <a href="register" >عضویت</a>
                    @endif
                </li>

            </ul>
        </div>
        <br />
    </div>
@yield('navbar')
<!--END MENU SECTION -->
    <div id="right">


        <ul id="menu" >


            <li class="panel active">
                <a href="/" >
                    <i class="icon-table"></i> داشبورد


                </a>
            </li>



            <li >
                <a href="articles"   >
                    مقاله ها

            </li>
            <li >
                <a href="courses"  >
                    دوره ها

            </li>
            @can('show-users')
                <li class="panel ">
                    <a href="users" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        کاربران
                </li>
            @endcan
            <li class="panel ">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                    پرداخت های موفق
            </li>
            <li class="panel ">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                    پرداخت های ناموفق
            </li>
            @can('show-comment')
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        کل نظرات
                </li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">

                        نظرات تایید شده
                        <span class="badge"> 0</span>
                </li>
            @endcan
        </ul>

    </div>




    <!--PAGE CONTENT -->
@yield('content')
<!--END PAGE CONTENT -->

    <!-- RIGHT STRIP  SECTION -->


    <!-- END RIGHT STRIP  SECTION -->
</div>

@yield('left')

<!--END MAIN WRAPPER -->

<!-- FOOTER -->
<div id="footer">
    <p>کلیه حقوق سایت متعلق به <a href="http://www.i-nahad.ir">ایران نهاد</a> می باشد.</p>
</div>
<!--END FOOTER -->


<!-- GLOBAL SCRIPTS -->


<!-- END PAGE LEVEL SCRIPTS -->


</body>

<!-- END BODY -->
</html>
