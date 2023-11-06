<!DOCTYPE html>
<html lang="fa">
<head>
    <meta name="_token" content="{{ csrf_token() }}"/>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @include('includ.name')</title>


    <!-- begin_::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->

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
    {{--    @dd($setting)--}}
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
            width: 240px;
            height: 50px;
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
</div>
<!-- end::sidebar -->

<!-- begin::side menu -->
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            @if(auth()->user()->role=='دانش آموز' or auth()->user()->role=='اولیا')
                <li><a class="navbar-brand" href="/student"><i class="icon ti-home"></i> <span>میز کار (داشبورد)</span></a>
                </li>

            @elseif(auth()->user()->role=='معلم')
                <li><a class="navbar-brand" href="/teacher"><i class="icon ti-home"></i> <span>میز کار (داشبورد)</span></a>
                </li>
            @elseif(auth()->user()->role=='مدیر')
                <li><a class="navbar-brand" href="/admin/home"><i class="icon ti-home"></i>
                        <span>میز کار (داشبورد)</span></a>
                </li>
            @elseif(auth()->user()->role=='ناظم')
                <li><a class="navbar-brand" href="/nazem"><i class="icon ti-home"></i>
                        <span>میز کار (داشبورد)</span></a></li>
            @elseif(auth()->user()->role=='معاون')
                <li><a class="navbar-brand" href="/moaven"><i class="icon ti-home"></i>
                        <span>میز کار (داشبورد)</span></a></li>
            @elseif(auth()->user()->role=='مشاور')
                <li><a class="navbar-brand" href="/moshaver"><i class="icon ti-home"></i> <span>میز کار (داشبورد)</span></a>
                </li>
            @endif

            @can('create-homepage')

                <li><a href="widgets.html"><i class="icon-pen2"></i> &nbsp &nbsp<span>مدیریت سایت</span>
                        &nbsp
                        @if($blog+$challenge != 0)
                            <span
                                class="btn btn-danger btn-smll">{{$blog+$challenge}}</span>
                        @endif
                    </a>
                    <ul>

                        <li><a href="#">اسلایدر</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/slider/creat" style="font-size: smaller">ایجاد</a></li>

                                    <li><a href="/admin/slider/show" style="font-size: smaller">مشاهده و ویرایش </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li><a href="#">معرفی افراد </a>
                            <ul>
                                <li><a href="/admin/home/creates">برترها</a>
                                    <ul>
                                        @can('create-homepage')

                                            <li><a href="/admin/Consultants/creat/برترها" style="font-size: smaller">ایجاد</a>
                                            </li>


                                            <li><a href="/admin/Consultants/show/برترها" style="font-size: smaller">مشاهده
                                                    و
                                                    ویرایش </a></li>
                                        @endcan


                                    </ul>
                                </li>
                                <li><a href="/admin/home/creates">پرسنل {{config('global.school')}}</a>
                                    <ul>
                                        @can('create-homepage')

                                            <li><a href="/admin/Consultants/creat/پرسنل" style="font-size: smaller">ایجاد</a>
                                            </li>


                                            <li><a href="/admin/Consultants/show/پرسنل" style="font-size: smaller">مشاهده
                                                    و
                                                    ویرایش </a></li>

                                        @endcan

                                    </ul>
                                </li>
                                <li><a href="/admin/home/creates">نمایندگان کلاس ها</a>
                                    <ul>
                                        @can('create-homepage')
                                            <li><a href="/admin/Consultants/creat/نمایندگان" style="font-size: smaller">ایجاد</a>
                                            </li>

                                            <li><a href="/admin/Consultants/show/نمایندگان" style="font-size: smaller">مشاهده
                                                    و
                                                    ویرایش </a></li>
                                        @endcan

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">رویداد ها </a>
                            <ul>
                                <li><a href="">اخبار</a>
                                    <ul>
                                        @can('create-homepage')
                                            <li><a href="/admin/roydad/creat/اخبار" style="font-size: smaller">ایجاد</a>
                                            </li>


                                            <li><a href="/admin/roydad/show/اخبار" style="font-size: smaller">مشاهده و
                                                    ویرایش </a></li>
                                        @endcan

                                    </ul>
                                </li>
                                <li><a href="/admin/home/creates">مسابقات</a>
                                    <ul>
                                        @can('create-homepage')

                                            <li><a href="/admin/roydad/creat/مسابقات"
                                                   style="font-size: smaller">ایجاد</a></li>


                                            <li><a href="/admin/roydad/show/مسابقات" style="font-size: smaller">مشاهده و
                                                    ویرایش </a></li>
                                        @endcan

                                    </ul>
                                </li>
                                <li><a href="/admin/home/creates">افتخارات</a>
                                    <ul>
                                        @can('create-homepage')

                                            <li><a href="/admin/roydad/creat/افتخارات"
                                                   style="font-size: smaller">ایجاد</a></li>


                                            <li><a href="/admin/roydad/show/افتخارات" style="font-size: smaller">مشاهده
                                                    و
                                                    ویرایش </a></li>
                                        @endcan

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">خدمات {{config('global.school')}}</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/Services/creat" style="font-size: smaller">ایجاد</a></li>


                                    <li><a href="/admin/Services/show" style="font-size: smaller">مشاهده و ویرایش </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li><a href="#">گالری تصاویر</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/Image/creat" style="font-size: smaller">ایجاد</a></li>


                                    <li><a href="/admin/Image/show" style="font-size: smaller">مشاهده و ویرایش </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li><a href="#">ویدیو</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/video/creat" style="font-size: smaller">ایجاد</a></li>


                                    <li><a href="/admin/video/show" style="font-size: smaller">مشاهده </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li><a href="#">پیام های مشاوره ای</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/Guides/creat" style="font-size: smaller">ایجاد</a></li>


                                    <li><a href="/admin/Guides/show" style="font-size: smaller">مشاهده و ویرایش </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li><a href="#">نمونه سوالات</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/uploadquestion" style="font-size: smaller">ایجاد</a></li>


                                    <li><a href="/admin/question/show" style="font-size: smaller">مشاهده و ویرایش </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li><a href="#">آپلود موارد آموزشی</a>
                            <ul>
                                @can('create-homepage')
                                    <li><a href="/admin/uploadeducational" style="font-size: smaller">آپلود</a></li>


                                    <li><a href="/admin/outboxeducational" style="font-size: smaller">مشاهده و
                                            ویرایش </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        <li>
                            <a href="/admin/Blog/view"> وبلاگ ها
                                &nbsp
                                @if($blog != 0)
                                    <span class="btn btn-danger btn-smll">{{$blog}}</span>
                                @endif

                            </a>
                        </li>
                        <li>

                        <li><a href="/challenge/show">تالار گفتمان
                                &nbsp
                                @if($challenge != 0)
                                    <span class="btn btn-danger btn-smll">{{$challenge}}</span>
                                @endif

                            </a>
                        </li>


                        @can('create-homepage')
                            <li><a href="/admin/mainpage">اطلاعات {{config('global.school')}}</a></li>
                        @endcan
                        <li><a href="/admin/converse">سخن {{config('global.admin')}}</a></li>
                        @can('create-homepage')

                            <li><a href="" style="color: red">تولید تگ ها</a>
                                <ul>
                                    <li><a href="/admin/Tag/creat" style="font-size: smaller">ایجاد</a></li>

                                    <li><a href="/admin/Tag/show" style="font-size: smaller">مشاهده و ویرایش </a>

                                    </li>
                                </ul>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('manage-classes')
                <li><a href="widgets.html"><i class="icon-book"></i> &nbsp
                        &nbsp<span>مدیریت آموزشی</span>
                    </a>
                    <ul>

                        <li><a href="/admin/paye"><i class="icon-collaboration"></i> &nbsp &nbsp
                                <span>{{config('global.paye')}} ها</span> </a></li>


                        <li><a href="basic-cards.html"><i class="icon-users4"></i> &nbsp &nbsp
                                <span>{{config('global.students')}} </a>
                            <ul>
                                <li><a href="/admin/students.create"><i class="icon-user-plus"></i> &nbsp &nbsp
                                        ایجاد {{config('global.student')}}  </a></li>

                                <li><a href="/admin/class/"><i class="icon-users2"></i> &nbsp &nbsp
                                        نمایش {{config('global.students')}} </a>
                                    <ul>
                                        <li><a href="/admin/students">کل {{config('global.students')}}</a></li>
                                        @foreach($claas as $cls)
                                            <a href="/admin/students/singlepage/{{$cls->classnamber}}">
                                                <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                                    -{{$cls->classnamber}}</li>
                                            </a>
                                    @endforeach
                                </li>
                            </ul>
                        @can('excle')
                            <li><a href="/admin/importExport"><i class="fa fa-upload"></i> &nbsp &nbsp
                                    <span>
                                          اکسل {{config('global.students')}}
                                </span> </a></li>
                        @endcan
                        @can('rollcall')
                            <li><a href="#"><i class="icon-user-tie"></i> حضور غیاب
                                </a>
                                <ul>
                                    <li><a href="/admin/present_list">خوداظهاری حضورغیاب</a>
                                    </li>
                                    <li><a href="/admin/dars.create">مشاهده موارد</a>
                                        <ul>
                                            <a href="/admin/roolcall_report">همه موارد</a>
                                            @foreach($claas as $cls)
                                                <a href="/admin/rollcall/class/{{$cls->classnamber}}">
                                                    <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                                        -{{$cls->classnamber}}</li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="/admin/dars">ثبت مورد جدید </a>
                                        <ul>
                                            @foreach($claas as $cls)
                                                <a href="/admin/students/rollcall/{{$cls->classnamber}}">
                                                    <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                                        -{{$cls->classnamber}}</li>
                                                </a>
                                            @endforeach

                                        </ul>
                                    </li>

                                </ul>
                            </li>
                        @endcan
                        @can('pre-registration')
                            <li><a href="/admin/pre-registration"><i class="fa fa-user-plus"></i> &nbsp &nbsp
                                    <span>
                                   پیش ثبت نام ها
                                </span> </a></li>
                        @endcan
                    </ul>
                </li>


                <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>مدیریت کلاس ها</span>
                    </a>
                    <ul>

                        <li><a href="/admin/class.create">ایجاد کلاس جدید</a></li>

                        <li><a href="/admin/class/">نمایش کلاس ها </a></li>

                    </ul>
                </li>
                @can('manage-doros')

                    <li><a href="#"><i class="icon-books"></i> &nbsp &nbsp <span>مدیریت دروس</span> </a>
                        <ul>
                            <li><a href="/admin/dars.create">ایجاد درس جدید</a></li>
                            <li><a href="/admin/dars">نمایش و ویرایش دروس </a>
                                <ul>
                                    @foreach($paye as $pay)
                                        <li><a href="/admin/dars/{{$pay->id}}">{{$pay->name}}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view-member')

                    <li><a href="#"><i class="icon-users2"></i> &nbsp &nbsp
                            <span>{{config('global.teachers')}}</span> </a>
                        <ul>
                            <li><a href="/admin/teacher.create/1">ایجاد {{config('global.teacher')}} جدید</a>
                            </li>
                            <li><a href="/admin/teacher">نمایش {{config('global.teachers')}} </a>
                            </li>
                            <li style="font-size: smaller"><a href="/admin/program/teacher">برنامه
                                    حضور </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('library')

                    <li><a href="#"><i class="icon-books"></i> &nbsp &nbsp <span>مدیریت کتابخانه</span> </a>
                        <ul>
                            <li><a href="/admin/library/importExport"><i class="fa fa-upload"></i> &nbsp &nbsp
                                    <span>
                بارگذاری کتاب ها
                                </span> </a></li>
                            <li><a href="/admin/library/create">اضافه کردن کتاب جدید</a></li>
                            <li><a href="/admin/library/index">نمایش و ویرایش کتاب ها </a></li>
                            <li><a href="/admin/library/intrust">در دست امانت</a></li>
                            <li><a href="/admin/library/inreserve">رزور ها</a></li>
                            <li><a href="/admin/library/history">تاریخچه امانت ها</a></li>
                        </ul>
                    </li>
                @endcan
                @can('manage-examprograme')

                    <li><a href="#"><i class="icon-newspaper2"></i> &nbsp &nbsp <span> برنامه امتحان ها</span>
                        </a>
                        <ul>
                            <li><a href="/admin/emtehan.create">آپلود برنامه جدید</a></li>
                            <li><a href="/admin/emtehan/view">نمایش برنامه ها </a></li>


                        </ul>
                    </li>
                @endcan
                @can('manage-classprograme')

                    <li><a href="#"><i class="icon-newspaper2"></i> &nbsp &nbsp<span> برنامه ها ی درسی</span>
                        </a>
                        <ul>
                            <li><a href="/admin/barnane.create">آپلود برنامه جدید</a></li>
                            <li><a href="/admin/barnane/view">نمایش برنامه ها </a></li>


                        </ul>
                    </li>

                @endcan
                @can('manage-classprograme')

                    <li><a href="#"><i class="icon-database-time2"></i> &nbsp &nbspزمانبندی ها</a>
                        <ul>
                            <li>
                                <a href="/admin/tagvim/time">ساعت ها</a>
                            </li>
                            <li>
                                <a href="/admin/tagvim/student">دروس</a>
                            </li>
                            <li>
                                <a href="/admin/tagvim/teacher">{{config('global.teachers')}}</a>
                            </li>
                        </ul>
                    </li>

                @endcan
                <li><a href="/admin/filmsection"> <span>دسته بندی فیلم ها</span></a>
                </li>
        </ul>
        </li>

        @endcan

        @can('view-member')
            <li><a href="widgets.html"><i class="icon-users4"></i> &nbsp &nbsp<span> اعضای سایت</span>
                </a>
                <ul>

                    @can('RTamas')
                        <li><a href="/admin/RTamas/view"><i class="fa fa-user"></i> &nbsp &nbspدرخواست های
                                همکاری</a>
                        </li>

                    @endcan
                    @can('view-member')
                        <li><a href="widgets.html"><i class="icon-users4"></i> &nbsp &nbsp <span>اعضای سایت</span>
                            </a>
                            <ul>


                                <li><a href="/admin/parent">{{config('global.parents')}}</a></li>
                                <li><a href="/admin/personals">پرسنل</a></li>
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        @can('manage-secret')
            <li><a href="#"><i class="fa fa-user-secret"></i> &nbsp &nbsp
                    <span>سطح دسترسی</span> </a>
                <ul>
                    <li><a href="/admin/users/roles/show">نمایش سمت ها</a></li>
                    <li><a href="/admin/users/roles">اختصاص سمت</a></li>
                </ul>
            </li>
        @endcan
        @can('manage-webdesignner')

            {{--                        <li><a href="/admin/permissions"><i class="fa fa-user-secret"></i> &nbsp &nbsp--}}
            {{--                                <span style="color: red">Permission</span> </a></li>--}}
            {{--                        <li><a href="/admin/roles"><i class="fa fa-user-secret"></i> &nbsp &nbsp--}}
            {{--                                <span style="color: red">Role</span> </a></li>--}}
        @endcan




        @can('discipline-manage')
            <li><a href="widgets.html"><i class="icon-warning22"></i> &nbsp &nbsp<span>مسایل انضباطی</span>
                </a>
                <ul>
                    <li><a href="#"> <span>نمودار های انضباطی</span></a>
                        <ul>
                            <li><a href="/admin/cdiscipline/chart/all"> کل آموزشگاه</a></li>
                            <li><a href="/admin/cdiscipline/chart/comparison/class">مقایسه کلاس ها</a></li>
                            <li><a href="/admin/cdiscipline/chart/comparison/paye">
                                    مقایسه {{config('global.paye')}}
                                    ها</a></li>

                            <li><a href="/#"> {{config('global.paye')}} محور</a>
                                <ul>
                                    @foreach($paye as $pay)
                                        {{--@dd($pay);--}}
                                        <li class="font-weight-normal"><a
                                                href="/admin/cdiscipline/chart/paye/{{$pay->name}}">{{$pay->name}}</a>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#"> کلاس محور</a>
                                <ul>
                                    @foreach($claas as $cls)
                                        <a href="/admin/cdiscipline/chart/class/{{$cls->classnamber}}">
                                            <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                                -{{$cls->classnamber}}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"> <span>تعریف موارد انضباطی</span></a>
                        <ul>
                            <li><a href="/admin/cdiscipline/manage">مشاهده موارد </a></li>
                            <li><a href="/admin/cdiscipline/create">تولید مورد جدید </a></li>
                        </ul>
                    </li>


                    <li><a href="#"> <span>اختصاص مواردانضباطی</span></a>
                        <ul>
                            <li><a href="/admin/discipline/create">ثبت مورد انضباطی</a></li>
                            <li><a href="/admin/discipline/index">مشاهده موارد انضباطی</a></li>
                        </ul>
                    </li>

                    <li><a href="#">لیست انضباط {{config('global.students')}}</a>
                        <ul>
                            <a href="/admin/discipline/all">
                                <li>همه ی موارد</li>
                            </a>
                            @foreach($claas as $cls)
                                <a href="/admin/discipline/class/{{$cls->classnamber}}">
                                    <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                        -{{$cls->classnamber}}</li>
                                </a>
                            @endforeach
                        </ul>

                    </li>

                </ul>
            </li>
        @endcan

        @can('finance')
            <li><a href="widgets.html"><i class="icon-coin-dollar"></i> &nbsp &nbsp<span>مدیریت مالی</span>
                </a>
                <ul>
                    <li><a href="#">لیست کلاس ها</a>
                        <ul>
                            @foreach($claas as $cls)
                                <a href="/admin/finance/{{$cls->classnamber}}">
                                    <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                        -{{$cls->classnamber}}</li>
                                </a>
                            @endforeach
                        </ul>

                    </li>
                    <li><a href="#">لیست پرداخت ها</a>
                        <ul>
                            <li>
                                <a href="/admin/fish"> لیست فیش ها
                                </a>
                            </li>
                            <li>
                                <a href="/admin/cheque"> لیست چک ها/ نقدی ها
                                </a>
                            </li>
                            <li>
                                <a href="/admin/paid"> لیست همه پرداختی ها
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endcan
        @can('karnameh')
            <li><a href="widgets.html"><i class="icon-stack-text"></i> &nbsp &nbsp<span>کارنامه ها</span>
                </a>
                <ul>
                    <li><a href="/admin/karnameh">درخواست از {{config('global.teacher')}}</a>
                        <ul>
                            <li><a href="/admin/karnameh/request">درخواست جدید</a>
                            </li>
                            <li><a href="/admin/karnameh/show">مشاهده درخواست ها</a></li>
                        </ul>
                    </li>
                    <li><a href="#">مشاهده کارنامه</a>
                        <ul>
                            @foreach($karnamehs as $karnameh)
                                <li><a href="#">{{$karnameh->name}}</a>
                                    <ul>
                                        @foreach($paye as $pay)
                                            <li style="font-size: small"><a
                                                    href="#">{{$pay->name}}</a>
                                                <ul>
                                                    @foreach($claas->where('paye',$pay->name) as $cls)
                                                        <a href="/admin/karnameh/student/{{$karnameh->id}}/{{$cls->classnamber}}">
                                                            <li style="font-size: smaller">
                                                                کلاس {{$cls->classnamber}}</li>
                                                        </a>
                                                    @endforeach
                                                </ul>
                                            </li>

                                            </a>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>

                    </li>
                </ul>
            </li>
        @endcan

        @can('manage-developmentchart')
            <li><a href="#"><i class="icon-chart"></i> &nbsp &nbsp <span>آمار و تحلیل</span></a>
                <ul>
                    <li><a href="#"><i class="icon-stats-growth"></i> &nbsp &nbsp <span>نمودار پیشرفت</span></a>
                        <ul>
                            <li><a href="/admin/charts/kol"> کل آموزشگاه</a></li>
                            <li><a href="/admin/charts/paye"> {{config('global.paye')}} محور</a>
                                <ul>
                                    @foreach($paye as $pay)
                                        <li class="font-weight-normal"><a
                                                href="/admin/charts/paye/{{$pay->id}}">{{$pay->name}}</a>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#"> کلاس محور</a>
                                <ul>
                                    @foreach($claas as $cls)
                                        <a href="/admin/charts/class/{{$cls->classnamber}}">
                                            <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                                -{{$cls->classnamber}}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <li><a href="#"><i class="icon-graph"></i> &nbsp &nbsp <span>نمودار مقایسه ای</span></a>
                        <ul>
                            <li><a href="/admin/charts/teacheractivity">مقایسه
                                    فعالیت {{config('global.teachers')}}</a></li>
                            <li><a href="/admin/charts/moadel">مقایسه معدل کلاس ها</a></li>
                            <li><a href="/admin/dars.create">مقایسه {{config('global.paye')}} محور</a>
                                <ul>
                                    @foreach($paye as $pay)
                                        <li class="font-weight-normal"><a
                                                href="/admin/charts/paye/{{$pay->id}}"><span
                                                    style="font-size: medium;font-family:KOODAK">{{$pay->name}}</span></a>
                                            <ul>
                                                <li>
                                                    <a href="/admin/charts/paye/koldars/{{$pay->id}}"><b>کلی</b></a>
                                                </li>
                                                @foreach($dars->where('paye' ,$pay->name ) as $dar)
                                                    <li class="font-weight-normal"><a
                                                            href="/admin/charts/paye/class/dars{{$dar->id}}">{{$dar->name}}</a>

                                                        @endforeach
                                                    </li>
                                            </ul>
                                            @endforeach
                                        </li>
                                </ul>
                            </li>
                            <li><a href="#">

                                    مقایسه دروس کلاس ها
                                </a>

                                <ul>

                                    @foreach($claas as $cls)
                                        <a href="/admin/charts/class/dars/{{$cls->classnamber}}">
                                            <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                                -{{$cls->classnamber}}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">{{config('global.students')}} در یک درس</a>
                                <ul>
                                    @foreach($claas as $cls)
                                        <li class="font-weight-normal"><a
                                                href="/admin/charts/paye/{{$cls->classnamber}}">{{$cls->paye}}
                                                -{{$cls->classnamber}}</a>
                                            <ul>
                                                @foreach($dars->where('paye' ,$cls->paye ) as $dar)
                                                    <li class="font-weight-normal"><a
                                                            href="/admin/charts/paye/dars/{{$dar->id}}/{{$cls->classnamber}}">{{$dar->name}}</a>

                                                        @endforeach
                                                    </li>
                                            </ul>
                                            @endforeach
                                        </li>
                                </ul>
                            </li>
                            <li><a href="#">تعداد {{config('global.students')}}</a>
                                <ul>
                                    <li><a href="/admin/charts/pnumber">{{config('global.paye')}}
                                            محور</a></li>
                                    <li><a href="/admin/charts/cnumber">کلاس محور </a></li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endcan

        @can('message')

            <li><a href="#"><i class="icon-file-text"></i> &nbsp &nbsp<span>مدیریت پیام ها</span> </a>
                <ul>
                    <li><a href="/admin/message/create">ایحاد پیام جدید</a></li>
                    <li><a href="/admin/message">نمایش پیام ها </a></li>


                </ul>
            </li>
        @endcan


        @can('exam')
            <li><a href="#"><i class="icon-newspaper"></i> &nbsp &nbsp<span>آزمون ها</span> </a>
                <ul>
                    <li><a href="#">ایجاد آزمون
                        </a>
                        <ul>
                            <a href="/teacher/exam/create">
                                <li>تک درس</li>
                            </a>
                            <a href="/admin/exam/general/create">
                                <li>جامع</li>
                            </a>
                        </ul>
                    </li>
                    <li><a href="#">مشاهده آزمون ها
                        </a>
                        <ul>
                            <li><a href="/teacher/exam">آزمون های تستی</a>
                            <li><a href="/teacher/exams/descriptive">آزمون های تشریحی</a>
                            <li><a href="">جامع</a>
                                <ul>
                                    @foreach($claas as $cls)
                                        <a href="/admin/exam/generals/index/{{$cls->classnamber}}">
                                            <li value="{{$cls->classnamber}}">{{$cls->paye}}
                                                -{{$cls->classnamber}}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>
        @endcan
        <li>
            <a href="#">
                <i class="fa fa-pencil">

                </i>
                &nbsp;
                نمره دهی
            </a>
            <ul>
                @foreach($claas as $cls)
                    <li class="font-weight-normal"><a
                            href="/admin/charts/paye/{{$cls->classnamber}}">{{$cls->paye}}
                            -{{$cls->classnamber}}</a>
                        <ul>
                            @foreach($dars->where('paye' ,$cls->paye ) as $dar)
                                <li class="font-weight-normal"><a
                                        href="/admin/mark/{{$cls->classnamber}}/{{$dar->id}}">
                                        {{$cls->classnamber}}
                                        {{$cls->description}}
                                        - {{$dar->name}}
                                    </a>

                                    @endforeach
                                </li>
                        </ul>
                        @endforeach
                    </li>
            </ul>
        </li>
        @can('online')

            <li>
                <a href="#"><i class="fa fa-window-maximize"></i>
                    &nbsp &nbsp<span
                    >کلاس آنلاین</span></a>
                <ul>
                    <li><a href="/admin/online_class/create">
                            ایجاد کلاس
                        </a></li>

                    <li><a href="">کلاس های ایجاد شده</a>
                        <ul>

                            @foreach($claas as $cls)
                                <a href="/admin/online/{{$cls->classnamber}}">
                                    <li value="{{$cls->classnamber	}}">{{$cls->paye}}
                                        -{{$cls->classnamber}}</li>
                                </a>
                            @endforeach
                        </ul>

                    </li>

                </ul>
            </li>
        @endcan

        @can('moshaver')
            <li><a href="#"><i class="icon-man"></i> &nbsp &nbsp<span>مشاوره</span> </a>
                <ul>
                    <li><a href="#">آپلود برنامه</a>
                        <ul>
                            <a href="/admin/moshaver/file/create">
                                <li>آپلود</li>
                            </a>
                            <a href="/admin/moshaver/file/view">
                                <li>مشاهده برنامه ها</li>
                            </a>
                        </ul>
                    </li>
                    <li><a href="#">جلسات</a>
                        <ul>
                            <a href="/admin/moshaver/create">
                                <li>ایجاد</li>
                            </a>
                            <a href="/admin/moshaver">
                                <li>مشاهده جلسات</li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </li>
        @endcan
        @can('selection')

            <li><a href="#"><i class="icon-select2"></i> &nbsp &nbsp<span> نظر سنجی ها</span> </a>
                <ul>

                    <li><a href="#"> <span>تشکل ها</span></a>
                    </li>
                    <li><a href="#"> <span>انتخابات و نظر سنجی</span></a>
                        <ul>
                            <li><a href="/admin/dars.create">انتخابات</a>
                                <ul>
                                    <li class="font-weight-normal"><a
                                        ><span
                                                style="font-size: medium;font-family:KOODAK">انجمن </span></a>
                                        <ul>
                                            <li><a href="/admin/selection/create/1"><b>ایجاد</b></a>
                                            </li>
                                            <li class="font-weight-normal"><a
                                                    href="/admin/selection/1">مشاهده</a>

                                            </li>
                                        </ul>
                                    </li>
                                    <li class="font-weight-normal"><a><span
                                                style="font-size: medium;font-family:KOODAK">شورای {{config('global.student')}}</span></a>
                                        <ul>
                                            <li><a href="/admin/selection/create/2"><b>ایجاد</b></a>
                                            </li>
                                            <li class="font-weight-normal"><a
                                                    href="/admin/selection/2">مشاهده</a>

                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li class="font-weight-normal"><a><span
                                        style="font-size: medium;font-family:KOODAK">نظر سنجی</span></a>
                                <ul>
                                    <li><a href="/admin/selection/create/3"><b>ایجاد</b></a>
                                    </li>
                                    <li class="font-weight-normal"><a
                                            href="/admin/selection/3">مشاهده</a>

                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
            </li>
        @endcan
        @can('message')

            <li><a href="#"><i class="icon-file-text"></i> &nbsp &nbsp<span>الگو ها</span> </a>
                <ul>
                    <li><a href="/admin/pattern/create">ایحاد الگو جدید</a></li>
                    <li><a href="/admin/pattern">نمایش الگو ها </a></li>
                    <li><a href="/admin/pattern/report/dailyReport">گزارش روزانه </a></li>
                    <li><a href="/admin/pattern/report/monthReport">گزارش ماهیانه </a></li>
                </ul>
            </li>
        @endcan
        @can('selection')

            <li><a href="/admin/setting"><i class="icon-safari"></i> &nbsp &nbsp<span> تنظیمات</span>
                </a>
            </li>
            @endcan

            </ul>
    </div>
</div>
<!-- end::side menu -->

<!-- begin::navbar -->
<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            <a href="/admin/home">
                <span class="logo-text d-none d-lg-block">@include('includ.name')</span></a>


        </div>
        <div style="text-align: left">
            <div class="header-body">


                <ul class="navbar-nav">
                    <spane style="color: #a8e4ff;text-align: center">
                        <li class="nav-item">
                            @if(auth()->user()->role=='معلم')

                                {{config('global.teacher')}}

                            @else
                                {{config('global.admin')}}

                            @endif
                            عزیز

                            @if(auth()->user()->sex=='مرد')
                                آقای
                            @elseif(auth()->user()->sex=='خانم')
                                خانم
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
                            @if($count != 0)
                                <span class="btn btn-danger btn-smll">{{$count}}</span>
                            @endif

                        </a>


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
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/profile" class="dropdown-item">پروفایل</a>
                            <a href="/mails/inbox" class="dropdown-item">پیام ها</a>
                            <a href="/teacher" class="dropdown-item">دسترسی به صفحه
                                {{config('global.teacher')}}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/" class="text-warning dropdown-item">صفحه اول سایت</a>
                            <a href="/logout" class="text-danger dropdown-item">خروج از حساب کاربری</a>
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
            <div class="col-lg-3 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-danger-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p style="color: black">تعداد کلاس ها</p>

                    </div>
                    <div class="p-2">
                        <h4 class="m-b-0 text-black font-weight-800 primary-font"
                            style="color: black">{{getclass($count=0)}}</h4>
                    </div>

                    <div class="p-2 icon-block  icon-block-floating m-l-20">
                        <i class="icon-home8"></i>
                    </div>


                </div>


            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-warning-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p style="color: black">تعداد
                            {{config('global.teacher')}}
                        </p>
                    </div>
                    <div class="p-2">
                        <h4 class="m-b-0 text-black font-weight-800 primary-font"
                            style="color: black">{{getdabir($count=0)}}</h4>
                    </div>
                    <div class="icon-block  icon-block-floating m-l-20">
                        <i class="icon-user-tie"></i>
                    </div>


                </div>


            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-success-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <h6 style="color: black">تعداد {{config('global.students')}}</h6>

                    </div>
                    <div class="p-2">
                        <b><h4 class="m-b-0 text-black font-weight-800 primary-font" style="color: black">


                                {{getstudent($cuont=0)}}

                            </h4></b>
                    </div>
                    <div class="icon-block  icon-block-floating m-l-20">

                        <i class="icon-man"></i>
                    </div>


                </div>


            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="d-flex flex-row align-items-center justify-content-center m-b-10 bg-info-gradient"
                     id="rcorners1">
                    <div class="p-2">
                        <p style="color: black">تعداد پرسنل </p>

                    </div>
                    <div class="p-2">
                        <h4 class="m-b-0 text-black font-weight-800 primary-font" style="color: black">
                            <b>
                                {{getkadr($cuont=0)}}
                            </b>
                        </h4>
                    </div>
                    <div class="icon-block  icon-block-floating m-l-20">
                        <i class="icon-user"></i>
                    </div>


                </div>


            </div>

        </div>
        <div class="d-flex flex-row table-responsive noprint" id="printbtn">
            <div class="p-2">
                <div class="card  overflow-hidden ">
                    <a href="/admin/online_class/create">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/class.jpg" width="50" height="50">
                            <p>کلاس های آنلاین</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/teacher/exam/create">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/exam1.jpg" width="50" height="50">
                            <p>آزمون تک درس</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/exam/general/create">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/exam2.jpg" width="50" height="50">
                            <p>آزمون جامع</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/selection/create/3">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/selection.jpg" width="50" height="50">
                            <p>نظر سنجی</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/moshaver/create">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/meeting.jpg" width="50" height="50">
                            <p>قرار ملاقات مجازی</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/charts/kol">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/report.jpg" width="50" height="50">
                            <p>گزارش و تحلیل</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/karnameh/show">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/tamrin.jpg" width="50" height="50">
                            <p>کارنامه ها</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/message/create">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/message.jpg" width="50" height="50">
                            <p>پیام ها</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-2">
                <div class="card  overflow-hidden">
                    <a href="/admin/paid">
                        <div class="card-body  rounded   text-center">
                            <img src="/assets/images/icon/workbook.jpg" width="50" height="50">
                            <p>مالی</p>
                        </div>
                    </a>
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

<!-- begin::select2 -->
<script src="/assets/vendors/select2/js/select2.min.js"></script>
<script src="/assets/js/examples/select2.js"></script>
<!-- end::select2 -->

<!-- begin::CKEditor -->
<script src="/assets/vendors/ckeditor/ckeditor.js"></script>
<script src="/assets/js/examples/ckeditor.js"></script>
<!-- end::CKEditor -->

<!-- begin::custom scripts -->
<script src="/assets/js/custom.js"></script>
<script src="/assets/js/app.js"></script>
<!-- begin::favicon -->
<link rel="shortcut icon" href="/assets/media/image/favicon.png">
<!-- end::favicon -->
<!-- end::custom scripts -->


@yield('script')

</body>
</html>
    <?php
    function getclass()
    {
        $countclass = \App\clas::all()->count();
        return $countclass;
    }

    function getdabir()
    {
        $countdabir = \App\User::where('role', 'معلم')->count();
        return $countdabir;
    }

    function getstudent()
    {
        $countstudent = \App\User::where('role', 'دانش آموز')->count();
        return $countstudent;
    }
    function getkadr()
    {
        $countkadr = \App\User::where('role', '!=', 'دانش آموز')->where('role', '!=', 'مدیر')->where('role', '!=', 'معلم')->where('role', '!=', 'اولیا')->count();
        return $countkadr;
    }
    ?>
