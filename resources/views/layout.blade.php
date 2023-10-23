

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="fa">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>سامانه یکپارچه مدرسه</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/colors.css" rel="stylesheet" type="text/css">
@yield('css')
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="/assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/pickers/jalali.js"></script>


    <script type="text/javascript" src="/assets/js/core/app.js"></script>
    <script type="text/javascript" src="/assets/js/pages/dashboard.js"></script>
    <!-- /theme JS files -->
    @yield('script')
</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-git-compare"></i>
                    <span class="visible-xs-inline-block position-right">بروزرسانی ها</span>
                    <span class="badge bg-warning-400">9</span>
                </a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-heading">
                        اخرین بروزرسانی ها
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-sync"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body width-350">
                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                            </div>

                            <div class="media-body">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت ...
                                <div class="media-annotation">۴ دقیقه قبل</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
                            </div>

                            <div class="media-body">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت ...
                                <div class="media-annotation">۳۶ دقیقه قبل</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
                            </div>

                            <div class="media-body">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت ...
                                <div class="media-annotation">۲ ساعت قبل</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
                            </div>

                            <div class="media-body">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت ...
                                <div class="media-annotation">۱۸:۳۶</div>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                            </div>

                            <div class="media-body">
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت ...
                                <div class="media-annotation">۰۵:۴۶</div>
                            </div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="تمام فعالیت ها"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-people"></i>
                    <span class="visible-xs-inline-block position-right">کاربران</span>
                </a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-heading">
                        کاربران انلاین
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-gear"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body width-300">
                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">مجتبی</a>
                                <span class="display-block text-muted text-size-small">توسعه دهنده وب</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-success"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">علی</a>
                                <span class="display-block text-muted text-size-small">بازاریاب</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-danger"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">فریبا</a>
                                <span class="display-block text-muted text-size-small">مدیر پروژه</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-success"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">محمد</a>
                                <span class="display-block text-muted text-size-small">توسعه دهنده کسب و کار</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-warning-300"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">وحید</a>
                                <span class="display-block text-muted text-size-small">طراح گرافیک</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-grey-400"></span></div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="تمام کاربران"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">پیام ها</span>
                    <span class="badge bg-warning-400">۲</span>
                </a>

                <div class="dropdown-menu dropdown-content width-350">
                    <div class="dropdown-content-heading">
                        پیام ها
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-compose"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body">
                        <li class="media">
                            <div class="media-left">
                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <span class="badge bg-danger-400 media-badge">۵</span>
                            </div>

                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">علی</span>
                                    <span class="media-annotation pull-right">۰۴:۵۸</span>
                                </a>

                                <span class="text-muted">به قالب مدیریتی اساک خوش امدید...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <span class="badge bg-danger-400 media-badge">۴</span>
                            </div>

                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">رضا</span>
                                    <span class="media-annotation pull-right">۱۲:۱۶</span>
                                </a>

                                <span class="text-muted">به قالب مدیریتی اساک خوش امدید...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">وحید</span>
                                    <span class="media-annotation pull-right">هم اکنون</span>
                                </a>

                                <span class="text-muted">به قالب مدیریتی اساک خوش امدید...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">سجاد</span>
                                    <span class="media-annotation pull-right">هم اکنون</span>
                                </a>

                                <span class="text-muted">به قالب مدیریتی اساک خوش امدید...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">صادق</span>
                                    <span class="media-annotation pull-right">هم اکنون</span>
                                </a>

                                <span class="text-muted">به قالب مدیریتی اساک خوش امدید...</span>
                            </div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="تمام پیام ها"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/placeholder.jpg" alt="">
                    <span>علی</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i>پروفایل من</a></li>
                    <li><a href="#"><span class="badge badge-warning pull-right">۵۸</span> <i class="icon-comment-discussion"></i> پیام ها</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> تنظیمات حساب کاربری</a></li>
                    <li><a href="#"><i class="icon-switch2"></i> خروج</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<!-- /main navbar -->



<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">علی دانافر</span>
                                <div class="text-size-mini text-muted">
                                    <i class="icon-pin text-size-small"></i> &nbsp;ایران, قوچان
                                </div>
                            </div>

                            <div class="media-right media-middle">
                                <ul class="icons-list">
                                    <li>
                                        <a href="#"><i class="icon-cog3"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                            <li class="navigation-header"><span>اصلی</span> <i class="icon-menu" title="Main pages"></i></li>
                            <li class="active"><a href="index.html"><i class="icon-home4"></i> <span>داشبورد</span></a></li>
                            <li>

                            </li>
                            <!-- /main -->

                            <!-- Forms -->
                            <li class="navigation-header"><span>فرم ها</span> <i class="icon-menu" title="Forms"></i></li>
                            <li>
                                <a href="#"><i class="icon-pencil3"></i> <span>اجزای فرم</span></a>
                                <ul>
                                    <li><a href="form_inputs_basic.html">ورودی های عمومی</a></li>
                                    <li><a href="form_checkboxes_radios.html">چک باکس ها و رادیو</a></li>
                                    <li><a href="form_input_groups.html">گروه های ورودی</a></li>
                                    <li><a href="form_controls_extended.html">ورودی های کنترل شده</a></li>
                                    <li>

                                    </li>
                                    <li ><a href="form_validation.html">اعتبارسنجی</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="wizard_steps.html"><i class="icon-footprint"></i> <span>فرم Wizard</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-select2"></i> <span>انتخاب کننده</span></a>
                                <ul>
                                    <li><a href="picker_color.html">رنگ ها</a></li>
                                </ul>
                            </li>
                            <li>
                            </li>
                            <!-- /forms -->

                            <!-- Appearance -->
                            <li class="navigation-header"><span>ظاهر</span> <i class="icon-menu" title="Appearance"></i></li>
                            <li>
                                <a href="#"><i class="icon-grid"></i> <span>اجزا</span></a>
                                <ul>
                                    <li><a href="components_tabs.html">ظاهر زبانه ها</a></li>
                                    <li><a href="components_navs.html">اکاردئون</a></li>
                                    <li><a href="components_buttons.html">دکمه ها</a></li>
                                    <li><a href="components_notifications_pnotify.html">نوتیفیکیشن (اطلاعیه ها)</a></li>
                                    <li ><a href="components_alerts.html">هشدارها</a></li>
                                    <li ><a href="components_pagination.html">صفحه بندی</a></li>
                                    <li ><a href="components_loaders.html">لودر و بروگرس بار</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-puzzle2"></i> <span>ظاهر محتوا</span></a>
                                <ul>
                                    <li><a href="appearance_content_panels.html">پنل ها</a></li>
                                    <li><a href="appearance_draggable_panels.html">پنل های قابل جابجایی</a></li>
                                    <li><a href="appearance_text_styling.html">استایل متن ها</a></li>
                                    <li><a href="appearance_typography.html">تایپوگرافی</a></li>
                                </ul>
                            </li>
                            <li>

                            </li>
                            <li>
                                <a href="#"><i class="icon-spinner2 spinner"></i> <span>انیمیشن ها</span></a>
                                <ul>
                                    <li><a href="animations_css3.html">انیمیشن های CSS3</a></li>
                                    <li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-thumbs-up2"></i> <span>ایکون ها</span></a>
                                <ul>
                                    <li><a href="icons_glyphicons.html">Glyphicons</a></li>
                                    <li><a href="icons_icomoon.html">Icomoon</a></li>
                                    <li><a href="icons_fontawesome.html">Font awesome</a></li>
                                </ul>
                            </li>
                            <!-- /appearance -->

                            <!-- Data visualization -->
                            <li>
                            </li>

                            </li>
                            <!-- /data visualization -->

                            <!-- Extensions -->
                            <li class="navigation-header"><span>افزودنه ها</span> <i class="icon-menu" title="Extensions"></i></li>
                            <li>
                            </li>
                            <li >
                                <a href="uploader_bootstrap.html"><i class="icon-upload"></i> <span>اپلود فایل</span></a>
                            </li>
                            <li>
                                <!-- /extensions -->

                                <!-- Tables -->
                            <li class="navigation-header"><span>جدول ها</span> <i class="icon-menu" title="Tables"></i></li>
                            <li>
                                <a href="table_styling.html"><i class="icon-grid7"></i> <span>جدول ها</span></a>
                            </li>
                            </li>
                            </li>
                            <!-- /tables -->

                            <!-- Page kits -->
                            <li class="navigation-header"><span>صفحات دیگر</span> <i class="icon-menu" title="Page kits"></i></li>
                            <li>
                                <a href="#"><i class="icon-cash3"></i> <span>صورتحساب</span></a>
                                <ul>
                                    <li><a href="invoice_template.html">قالب های صورتحساب</a></li>
                                    <li><a href="invoice_archive.html">ارشیو صورتحساب ها</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-people"></i> <span>صفحات کاربری</span></a>
                                <ul>
                                    <li><a href="user_pages_list.html">لیست کاربران</a></li>
                                    <li><a href="user_pages_profile_cover.html">پروفایل همراه کاور</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-user-plus"></i> <span>ورود و عضویت</span></a>
                                <ul>
                                    <li><a href="login_simple.html">ورود ساده</a></li>
                                    <li><a href="login_advanced.html">اطلاعات بیشتر در فرم ورود</a></li>
                                    <li><a href="login_registration.html">عضویت ساده</a></li>
                                    <li><a href="login_registration_advanced.html">اطلاعات بیشتر در فرم عضویت</a></li>
                                    <li><a href="login_unlock.html">انبلاک شدن کاربر</a></li>
                                    <li><a href="login_password_recover.html">بازیابی کلمه عبور</a></li>
                                    <li><a href="login_hide_navbar.html">مخفی کردن نوار هدر</a></li>
                                    <li><a href="login_transparent.html">جعبه شفاف</a></li>
                                    <li><a href="login_background.html">گزینه ها پس زمینه</a></li>
                                    <li><a href="login_validation.html">همراه اعتبار سنجی اطلاعات</a></li>
                                    <li><a href="login_tabbed.html">دارای تب ورود و عضویت</a></li>
                                    <li><a href="login_modals.html">بصورت پاپ اپ</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-lifebuoy"></i> <span>پشتیبانی</span></a>
                                <ul>
                                    <li><a href="support_conversation_layouts.html">طرح بندی گفتگوها</a></li>
                                    <li><a href="support_knowledgebase.html">پیگاه دانش</a></li>
                                    <li><a href="support_faq.html">سوالات متداول</a></li>
                                </ul>
                            </li>
                            <li>
                            </li>
                            <li>
                                <a href="#"><i class="icon-images2"></i> <span>گالری</span></a>
                                <ul>
                                    <li><a href="gallery_grid.html">بصورت شبکه ای</a></li>
                                    <li><a href="gallery_titles.html">رسانه به همراه عنوان</a></li>
                                    <li><a href="gallery_description.html">رسانه به همراه توضیحات</a></li>
                                    <li><a href="gallery_library.html">کتابخانه رسانه</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="icon-warning"></i> <span>صفحات ارور</span></a>
                                <ul>
                                    <li><a href="error_403.html">ارور ۴۰۳</a></li>
                                    <li><a href="error_404.html">ارور ۴۰۴</a></li>
                                    <li><a href="error_405.html">ارور ۴۰۵</a></li>
                                    <li><a href="error_500.html">ارور ۵۰۰</a></li>
                                    <li><a href="error_503.html">ارور ۵۰۳</a></li>
                                    <li><a href="error_offline.html">صفحه افلاین</a></li>
                                </ul>
                            </li>
                            <!-- /page kits -->

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->
@yield('sidebar')
        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-right6 position-left"></i> <span class="text-semibold">خانه</span> - داشبورد</h4>
                    </div>

                    <div class="heading-elements">
                        <div class="heading-btn-group">
                            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>امار</span></a>
                            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>صورتحساب ها</span></a>
                            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>برنامه</span></a>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="index.html"><i class="icon-home2 position-left"></i> خانه</a></li>
                        <li class="active">داشبورد</li>
                    </ul>

                    <ul class="breadcrumb-elements">
                        <li><a href="#"><i class="icon-comment-discussion position-left"></i> پشتیبانی</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-gear position-left"></i>
                                تنظیمات
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#"><i class="icon-user-lock"></i> امنیت حساب کاربری</a></li>
                                <li><a href="#"><i class="icon-statistics"></i> انالیز</a></li>
                                <li><a href="#"><i class="icon-accessibility"></i> دسترسی</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="icon-gear"></i>تمام تنظیمات</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-lg-7">

                        <!-- Traffic sources -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">منابع ترافیک</h6>
                                <div class="heading-elements">
                                    <form class="heading-form" action="#">
                                        <div class="form-group">
                                            <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                                <input type="checkbox" class="switch" checked="checked">
                                                بروزرسانی زنده:
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul class="list-inline text-center">
                                            <li>
                                                <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                                            </li>
                                            <li class="text-left">
                                                <div class="text-semibold">بازدید کنندگان جدید</div>
                                                <div class="text-muted">۲,۳۴۹</div>
                                            </li>
                                        </ul>

                                        <div class="col-lg-10 col-lg-offset-1">
                                            <div class="content-group" id="new-visitors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <ul class="list-inline text-center">
                                            <li>
                                                <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                                            </li>
                                            <li class="text-left">
                                                <div class="text-semibold">جلسات جدید</div>
                                                <div class="text-muted">۰۸:۲۰</div>
                                            </li>
                                        </ul>

                                        <div class="col-lg-10 col-lg-offset-1">
                                            <div class="content-group" id="new-sessions"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <ul class="list-inline text-center">
                                            <li>
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                                            </li>
                                            <li class="text-left">
                                                <div class="text-semibold">بیشترانلاین</div>
                                                <div class="text-muted"><span class="status-mark border-success position-left"></span> ۵,۳۷۸ </div>
                                            </li>
                                        </ul>

                                        <div class="col-lg-10 col-lg-offset-1">
                                            <div class="content-group" id="total-online"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="chart" id="traffic-sources"></div>
                        </div>
                        <!-- /traffic sources -->

                    </div>

                    <div class="col-lg-5">

                        <!-- Sales stats -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">امار فروش</h6>
                                <div class="heading-elements">
                                    <form class="heading-form" action="#">
                                        <div class="form-group">
                                            <select class="change-date select-sm" id="select_date">
                                                <optgroup label="<i class='icon-watch pull-right'></i> Time period">
                                                    <option value="val1">۱ اسفند</option>
                                                    <option value="val2">۲ اسفند</option>
                                                    <option value="val3" selected="selected">۴ اسفند</option>
                                                    <option value="val4">۵ اسفند</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i class="icon-calendar5 position-left text-slate"></i> ۵,۶۸۹</h5>
                                            <span class="text-muted text-size-small">سفارشات هفتگی</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i class="icon-calendar52 position-left text-slate"></i> ۳۲,۵۶۸</h5>
                                            <span class="text-muted text-size-small">سفارشات ماهانه</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group">
                                            <h5 class="text-semibold no-margin"><i class="icon-cash3 position-left text-slate"></i> ۳۵,۲۱۰ ریال</h5>
                                            <span class="text-muted text-size-small">میانگین درامد</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="chart content-group-sm" id="app_sales"></div>
                            <div class="chart" id="monthly-sales-stats"></div>
                        </div>
                        <!-- /sales stats -->

                    </div>
                </div>
                <!-- /main charts -->


                <!-- Dashboard content -->
                <div class="row">
                    <div class="col-lg-8">

                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">کمپین های بازاریابی</h6>
                                <div class="heading-elements">
                                    <span class="label bg-success heading-text">۲۸ فعال</span>
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-sync"></i>بروزرسانی داده ها</a></li>
                                                <li><a href="#"><i class="icon-list-unordered"></i> گزارش ورود به سیستم</a></li>
                                                <li><a href="#"><i class="icon-pie5"></i> امار</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><i class="icon-cross3"></i>پاک کردن لیست</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-lg text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-5">
                                            <div class="media-left">
                                                <div id="campaigns-donut"></div>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">۳۸,۲۸۹ <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+۱۶.۲%)</small></h5>
                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li>
                                                        <span class="status-mark border-success"></span>
                                                    </li>
                                                    <li>
                                                        <span class="text-muted">۱۲ اسفند , ساعت ۲۰:۱۲</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                        <td class="col-md-5">
                                            <div class="media-left">
                                                <div id="campaign-status-pie"></div>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">۲,۴۵۸ <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (- ۴.۹%)</small></h5>
                                                <ul class="list-inline list-inline-condensed no-margin">
                                                    <li>
                                                        <span class="status-mark border-danger"></span>
                                                    </li>
                                                    <li>
                                                        <span class="text-muted">ساعت ۴:۲۰</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                        <td class="text-right col-md-2">
                                            <a href="#" class="btn bg-indigo-300"><i class="icon-statistics position-left"></i> مشاهده کزارش</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>کمپین</th>
                                        <th class="col-md-2">مشتری</th>
                                        <th class="col-md-2">تغیرات</th>
                                        <th class="col-md-2">بودجه</th>
                                        <th class="col-md-2">وضعیت</th>
                                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="active border-double">
                                        <td colspan="5">امروز</td>
                                        <td class="text-right">
                                            <span class="progress-meter" id="today-progress" data-progress="30"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">فیس بوک</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-blue position-left"></span>
                                                    ۰۲:۰۰ - ۰۳:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">Mintlime</span></td>
                                        <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> ۲.۴۳%</span></td>
                                        <td><h6 class="text-semibold">۳۲۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-blue">فعال</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i> مشاهده صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i> ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعال کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">یوتیوب</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-danger position-left"></span>
                                                    ۱۳:۰۰ - ۱۴:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">CDsoft</span></td>
                                        <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> ۳.۱۲%</span></td>
                                        <td><h6 class="text-semibold">۵۰,۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-danger">بسته شده</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i>مشاهده صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i>ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعل کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">تبلیغات اسپاتی</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-grey-400 position-left"></span>
                                                    ۱۰:۰۰ - ۱۱:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">Diligence</span></td>
                                        <td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - ۸.۰۲%</span></td>
                                        <td><h6 class="text-semibold">۱۵۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-grey-400">معلق</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i>مشاهده صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i> ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعال کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">توئیتر</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-grey-400 position-left"></span>
                                                    ۰۴:۰۰ - ۰۵:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">Deluxe</span></td>
                                        <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> ۲.۷۸%</span></td>
                                        <td><h6 class="text-semibold"۵۰,۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-grey-400">معلق</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i> مشاهده صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i> ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعال کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr class="active border-double">
                                        <td colspan="5">دیروز</td>
                                        <td class="text-right">
                                            <span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">بینگ</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-success position-left"></span>
                                                    ۱۵:۰۰ - ۱۶:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">Metrics</span></td>
                                        <td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - ۵.۷۸%</span></td>
                                        <td><h6 class="text-semibold">۳۹,۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-success-400">در انتظار</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropup">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i>مشاهده صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i> ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعال کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">امازون</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-danger position-left"></span>
                                                    ۱۸:۰۰ - ۱۹:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">Blueish</span></td>
                                        <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> ۶.۷۹%</span></td>
                                        <td><h6 class="text-semibold">۸۳۰,۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-blue">فعال</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropup">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i> نمایش صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i>ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعال کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">دیریبل</a></div>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark border-blue position-left"></span>
                                                    ۲۰:۰۰ - ۲۱:۰۰
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-muted">Teamable</span></td>
                                        <td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> ۹.۸۳%</span></td>
                                        <td><h6 class="text-semibold">۳۱۰۰۰ ریال</h6></td>
                                        <td><span class="label bg-danger">بسته شده</span></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropup">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-stats"></i> نمایش صورت وضعیت</a></li>
                                                        <li><a href="#"><i class="icon-file-text2"></i> ویرایش کمپین</a></li>
                                                        <li><a href="#"><i class="icon-file-locked"></i> غیرفعال کردن کمپین</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-gear"></i> تنظیمات</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /marketing campaigns -->


                        <!-- Quick stats boxes -->
                        <div class="row">
                            <div class="col-lg-4">

                                <!-- Members online -->
                                <div class="panel bg-teal-400">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-teal-800">+۵۳,۶%</span>
                                        </div>

                                        <h3 class="no-margin">۳,۴۵۰</h3>
                                        اعضای انلاین
                                        <div class="text-muted text-size-small">۴۸۹</div>
                                    </div>

                                    <div class="container-fluid">
                                        <div class="chart" id="members-online"></div>
                                    </div>
                                </div>
                                <!-- /members online -->

                            </div>

                            <div class="col-lg-4">

                                <!-- Current server load -->
                                <div class="panel bg-pink-400">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-sync"></i> بروزرسانی داده ها</a></li>
                                                        <li><a href="#"><i class="icon-list-unordered"></i> گزارش ورود به سیستم</a></li>
                                                        <li><a href="#"><i class="icon-pie5"></i> امار</a></li>
                                                        <li><a href="#"><i class="icon-cross3"></i> پاک کردن لیست</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <h3 class="no-margin">۴۹.۴%</h3>
                                        جریان لود سرور
                                        <div class="text-muted text-size-small">۳۴.۶%</div>
                                    </div>

                                    <div class="chart" id="server-load"></div>
                                </div>
                                <!-- /current server load -->

                            </div>

                            <div class="col-lg-4">

                                <!-- Today's revenue -->
                                <div class="panel bg-blue-400">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="reload"></a></li>
                                            </ul>
                                        </div>

                                        <h3 class="no-margin">۳۶۰,۰۰۰</h3>
                                        درامد امروز
                                        <div class="text-muted text-size-small">۹۸۰,۰۰ ریال</div>
                                    </div>

                                    <div class="chart" id="today-revenue"></div>
                                </div>
                                <!-- /today's revenue -->

                            </div>
                        </div>
                        <!-- /quick stats boxes -->


                        <!-- Support tickets -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">تیکت های پشتیبانی</h6>
                                <div class="heading-elements">
                                    <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-xlg text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-4">
                                            <div class="media-left media-middle">
                                                <div id="tickets-status"></div>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">۱۴,۳۲۷ <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+۲.۹%)</small></h5>
                                                <span class="text-muted"><span class="status-mark border-success position-left"></span> ۱۰:۰۰ صبح</span>
                                            </div>
                                        </td>

                                        <td class="col-md-3">
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-alarm-add"></i></a>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">
                                                    ۱,۱۳۲ <small class="display-block no-margin">بیشترین تیکت ها</small>
                                                </h5>
                                            </div>
                                        </td>

                                        <td class="col-md-3">
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-spinner11"></i></a>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">
                                                    ۰۶:۲۵:۰۰ <small class="display-block no-margin">زمان پاسخ</small>
                                                </h5>
                                            </div>
                                        </td>

                                        <td class="text-right col-md-2">
                                            <a href="#" class="btn bg-teal-400"><i class="icon-statistics position-left"></i> گزارش</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th style="width: 50px">زمان</th>
                                        <th style="width: 300px;">کاربر</th>
                                        <th>توضیحات</th>
                                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="active border-double">
                                        <td colspan="3">تیکت های فعال</td>
                                        <td class="text-right">
                                            <span class="badge bg-blue">۲۴</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <h6 class="no-margin">۱۲ <small class="display-block text-size-small no-margin">ساعت</small></h6>
                                        </td>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
                                                    <span class="letter-icon"></span>
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">علی</a>
                                                <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> فعال</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-default display-inline-block">
                                                <span class="text-semibold">سلام</span>
                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی....</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-undo"></i> پاسخ سریع</a></li>
                                                        <li><a href="#"><i class="icon-history"></i> تمام تاریخچه</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-checkmark3 text-success"></i> حل شده</a></li>
                                                        <li><a href="#"><i class="icon-cross2 text-danger"></i>بستن</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <h6 class="no-margin">۱۶ <small class="display-block text-size-small no-margin">ساعت</small></h6>
                                        </td>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                            </div>

                                            <div class="media-body">
                                                <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">رضا</a>
                                                <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> فعال</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-default display-inline-block">
                                                <span class="text-semibold">سلام</span>
                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-undo"></i> پاسخ سریع</a></li>
                                                        <li><a href="#"><i class="icon-history"></i> تمام تاریخچه</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-checkmark3 text-success"></i> حل شده</a></li>
                                                        <li><a href="#"><i class="icon-cross2 text-danger"></i>بستن</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">
                                            <h6 class="no-margin">۲۰ <small class="display-block text-size-small no-margin">ساعت</small></h6>
                                        </td>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs">
                                                    <span class="letter-icon"></span>
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">محمد</a>
                                                <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> فعال</div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-default display-inline-block">
                                                <span class="text-semibold">سلام</span>
                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-undo"></i> پاسخ سریع</a></li>
                                                        <li><a href="#"><i class="icon-history"></i> تمام تاریخچه</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-checkmark3 text-success"></i> حل شده</a></li>
                                                        <li><a href="#"><i class="icon-cross2 text-danger"></i>بستن</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    </li>
                                    </ul>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /support tickets -->


                    </div>

                    <div class="col-lg-4">

                        <!-- Progress counters -->
                        <div class="row">
                            <div class="col-md-6">

                                <!-- Available hours -->
                                <div class="panel text-center">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li class="dropdown text-muted">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-sync"></i> بروزرسانی داده ها</a></li>
                                                        <li><a href="#"><i class="icon-list-unordered"></i> گزارش ورود</a></li>
                                                        <li><a href="#"><i class="icon-pie5"></i> امار</a></li>
                                                        <li><a href="#"><i class="icon-cross3"></i> پاک کردن لیست</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Progress counter -->
                                        <div class="content-group-sm svg-center position-relative" id="hours-available-progress"></div>
                                        <!-- /progress counter -->


                                        <!-- Bars -->
                                        <div class="chart" id="hours-available-bars"></div>
                                        <!-- /bars -->

                                    </div>
                                </div>
                                <!-- /available hours -->

                            </div>

                            <div class="col-md-6">

                                <!-- Productivity goal -->
                                <div class="panel text-center">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li class="dropdown text-muted">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-sync"></i> بروزرسانی داده ها</a></li>
                                                        <li><a href="#"><i class="icon-list-unordered"></i> گزارش ورود</a></li>
                                                        <li><a href="#"><i class="icon-pie5"></i> امار</a></li>
                                                        <li><a href="#"><i class="icon-cross3"></i> پاک کردن لیست</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Progress counter -->
                                        <div class="content-group-sm svg-center position-relative" id="goal-progress"></div>
                                        <!-- /progress counter -->

                                        <!-- Bars -->
                                        <div class="chart" id="goal-bars"></div>
                                        <!-- /bars -->

                                    </div>
                                </div>
                                <!-- /productivity goal -->

                            </div>
                        </div>
                        <!-- /progress counters -->

                        <!-- My messages -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">پیام های من</h6>
                                <div class="heading-elements">
                                    <span class="heading-text"><i class="icon-history text-warning position-left"></i>۵ اسفند - ۲۰:۱۸</span>
                                    <span class="label bg-success heading-text">انلاین</span>
                                </div>
                            </div>

                            <!-- Numbers -->
                            <div class="container-fluid">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="content-group">
                                            <h6 class="text-semibold no-margin"><i class="icon-clipboard3 position-left text-slate"></i> ۲,۳۴۵</h6>
                                            <span class="text-muted text-size-small">این هفته</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group">
                                            <h6 class="text-semibold no-margin"><i class="icon-calendar3 position-left text-slate"></i> ۳,۵۶۸</h6>
                                            <span class="text-muted text-size-small">این ماه</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="content-group">
                                            <h6 class="text-semibold no-margin"><i class="icon-comments position-left text-slate"></i> ۳۲,۶۹۳</h6>
                                            <span class="text-muted text-size-small">تمام پیام ها</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /numbers -->


                            <!-- Area chart -->
                            <div class="chart" id="messages-stats"></div>
                            <!-- /area chart -->


                            <!-- Tabs -->
                            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
                                <li class="active">
                                    <a href="#messages-tue" class="text-size-small text-uppercase" data-toggle="tab">
                                        سه شنبه
                                    </a>
                                </li>

                                <li>
                                    <a href="#messages-mon" class="text-size-small text-uppercase" data-toggle="tab">
                                        دوشنبه
                                    </a>
                                </li>

                                <li>
                                    <a href="#messages-fri" class="text-size-small text-uppercase" data-toggle="tab">
                                        جمعه
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->


                            <!-- Tabs content -->
                            <div class="tab-content">
                                <div class="tab-pane active fade in has-padding" id="messages-tue">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">
                                                <span class="badge bg-danger-400 media-badge">۸</span>
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    علی
                                                    <span class="media-annotation pull-right">۱۴:۵۸</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">
                                                <span class="badge bg-danger-400 media-badge">۶</span>
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    رضا
                                                    <span class="media-annotation pull-right">۱۲:۱۶</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    محمد
                                                    <span class="media-annotation pull-right">۰۹:۴۸</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    محمدرضا
                                                    <span class="media-annotation pull-right">۰۵:۵۴</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    وحید
                                                    <span class="media-annotation pull-right">۰۱:۴۳</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade has-padding" id="messages-mon">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    امیر
                                                    <span class="media-annotation pull-right"> ۱۹:۵۸</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    امیرعلی
                                                    <span class="media-annotation pull-right">۱۶:۳۵</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    محسن
                                                    <span class="media-annotation pull-right">۱۲:۱۶</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    ناشناس
                                                    <span class="media-annotation pull-right">۰۹:۲۰</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    علیرضا
                                                    <span class="media-annotation pull-right">۰۳:۲۹</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade has-padding" id="messages-fri">
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    مجتبی
                                                    <span class="media-annotation pull-right">۱۸:۱۲</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    علی
                                                    <span class="media-annotation pull-right">۱۴:۰۳</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    امیر
                                                    <span class="media-annotation pull-right">۱۳:۵۹</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    محمد
                                                    <span class="media-annotation pull-right"> ۰۹:۲۶</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                            </div>

                                            <div class="media-body">
                                                <a href="#">
                                                    وحید
                                                    <span class="media-annotation pull-right">۰۶:۳۸</span>
                                                </a>

                                                <span class="display-block text-muted">لورم ایپسوم متن ساختگی با تولید سادگی...</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /tabs content -->

                        </div>
                        <!-- /my messages -->

                    </div>
                </div>
                <!-- /dashboard content -->


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; ۲۰۱۶. <a href="#">فارسی و راستچین شده</a> توسط <a href="http://codecanyons.ir" target="_blank">کدکانیونز</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->
@yield('content')
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
