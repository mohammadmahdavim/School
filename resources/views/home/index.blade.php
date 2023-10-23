@extends('layouts.home')

@section('slider')
    <div class="heroslider">
        <div class="heroslider-slider heroslider-animted tm-slider-arrow">
            <!-- Heroslider Item -->
            @if(count($sliders)>0)

                @foreach($sliders as $slider)
                    <div class="heroslider-wrapper">
                        <div class="heroslider-content" style="height: 550px"

                             data-bgimage="{{url('images/'.\App\HomeImage::where('matlab_id',$slider->id)->first()['resize_image'])}}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-10">
                                        <div class="heroslider-content">
                                            <div class="heroslider-animatebox">

                                                <h1>
                                                    <span style="color: black">{{$slider->title}}</span>
                                                    <b>
                                                        {!!  substr(strip_tags($slider->little_body), 0, 40) !!}
                                                    </b>
                                                </h1>
                                            </div>
                                            <div class="heroslider-animatebox">
                                                <p>

                                                </p>
                                            </div>
                                            <h4><a href="/single/{{$slider->id}}"><span
                                                        style="color: white">ادامه...</span></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif
        <!--// Heroslider Item -->
        </div>
        <div class="heroslider-slidecounter"></div>
    </div>
    <!--// Heroslider -->
@endsection('slider')
@section('main')
    <main class="page-content">
        <!-- برترها -->
        @if(count($bartars)>0)

            <div class="tm-section team-members-area bg-white tm-padding-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                            <div class="tm-section-title text-center">
                                <h2>برترها</h2>
                                <span class="divider"><i class="fa fa-superpowers"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-30-reverse">
                        <!-- Team Member -->
                        @foreach($bartars as $bartar)
                            <div class="col-lg-3 col-md-6 col-12 mt-30">
                                <div class="tm-member wow fadeInUp">
                                    <div class="tm-member-top">
                                        @if(\App\HomeImage::where('matlab_id',$bartar->id)->first())
                                            <img
                                                src="{{url('images/'.\App\HomeImage::where('matlab_id',$bartar->id)->first()['resize_image'])}}"
                                                alt="team member">
                                        @endif
                                    </div>
                                    <div class="tm-member-bottom">
                                        <a href="#"><h5>{{$bartar->title}}</h5></a>
                                        <a href="#"><p>{{$bartar->little_body}}</p></a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    <!--// Team Member -->
                    </div>
                </div>
            </div>
        @endif
    <!--// برترها -->

        <!-- موارد آموزشی -->
        @if(count($educations)>0)

            <div class="tm-section blogs-area bg-white tm-padding-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                            <div class="tm-section-title text-center">
                                <h2>موارد آموزشی</h2>
                                <span class="divider"><i class="fa fa-superpowers"></i></span>

                            </div>
                        </div>
                    </div>
                    <div class="blog-slider-active tm-slider-arrow tm-slider-arrow-hovervisible">
                    @foreach($educations as $education)

                        <!-- Single Blog -->
                            <div class="blog-slider-item">
                                <div class="tm-blog wow fadeInUp">
                                    <div class="tm-blog-content">
                                        <div class="tm-blog-meta" style="padding-top: 10px">

                    <span style="color: red "><i class="fa fa-user-o"></i>توسط<a
                            href=""
                            style="color: red "> {{\App\User::where('id',$education->user_id)->first()['f_name']}} </a></span>
                                            <span><i class="fa fa-calendar-o"></i>{{$education->created_at->toDateString()}}</span>
                                            <span>

                    <img class="rounded-circle" width="100px"
                         src="/homee/images/education.jpg"
                         alt="...">

                    </span>
                                        </div>
                                        <table>

                                            <tr>
                                                <td>

                                                    <h4>عنوان: <span
                                                            style="font-size: medium;font-family: 'B Titr'"> {{$education->title}} </span>
                                                    </h4>

                                                    <br>

                                                    <h7>
                                                        {!!  substr(strip_tags($education->description), 0, 400) !!}
                                                    </h7>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10px" style="padding-right: -10px; padding-top: 20px">
                                                    <p>
                                                        <a href="/film/count/{{$education->id}}"
                                                           class="btn btn-primary ">
                                                            <i class="icon-download"></i> دانلود </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--// Single Blog -->
                        @endforeach


                    </div>
                </div>
            </div>
            <!--  موارد آموزشی -->
        @endif
        @if($blog)
            <div class="tm-section about-us-area bg-white tm-padding-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-3">
                            <div class="tm-about-image">
                                <a href="/blogs/single/{{$blog->id}}">
                                    <img src="{{url('images/'.$blog->filename)}}"
                                         alt="blog image">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-9">
                            <div class="tm-about-content">
                                <h2>نمونه از وبلاگ شما</h2>
                                <span class="divider"><i class="fa fa-superpowers"></i></span>
                                <h5><a>{{$blog->title}}</a>
                                </h5>
                                <p>
                                    {!!  substr(strip_tags($blog->body), 0, 250) !!}
                                    <br>
                                    <a href="/blogs/single/{{$blog->id}}" class="tm-readmore" style="color: darkred">ادامه
                                        مطلب...</a>
                                </p>
                                <ul class="stylish-list">
                                </ul>
                                <a href="/blogs" class="tm-button">همه ی وبلاگ ها<b></b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <!-- Services Area -->
        @if(count($services)>0)

            <div class="tm-section services-area bg-grey tm-padding-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                            <div class="tm-section-title text-center">
                                <h2>خدمات ما</h2>
                                <span class="divider"><i class="fa fa-superpowers"></i></span>
                                {{--<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک--}}
                                {{--است. چاپگرها و متون بلکه روزنامه و مجله </p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-30-reverse">


                    @foreach($services as $service)
                        <!-- Single Service -->
                            <div class="col-lg-4 col-md-6 col-12 mt-30">
                                <div class="tm-service text-center wow fadeInUp">

                                    @if(count(\App\HomeImage::where('matlab_id',$service->id)->pluck('resize_image'))==0 )
                                        <br>
                                        <br>

                                        <span class="tm-service-icon">
                    <i class="flaticon-consulting"></i>
                    </span>

                                        <br>
                                        <br>
                                        <br>
                                        <br>

                                    @else

                                        <img
                                            src="{{url('images/'.\App\HomeImage::where('matlab_id',$service->id)->first()['resize_image'])}}">
                                    @endif

                                    <div class="tm-service-content">
                                        <br>
                                        <table>
                                            <tr>
                                                <td>
                                                    <h5><a href="">{{$service->title}}</a></h5>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="80px" style="padding-right: -10px">
                                                    <p>
                                                        {!!  substr(strip_tags($service->body), 0, 145) !!}

                                                    </p>
                                                </td>
                                            </tr>

                                        </table>

                                        <a href="/single/{{$service->id}}" class="tm-readmore">بیشتر بخوانید</a>
                                    </div>
                                </div>
                            </div>
                            <!--// Single Service -->
                        @endforeach


                    </div>
                </div>

            </div>
        @endif
    <!--// Services Area -->
        <!-- Request Callback Area -->
        <div class="tm-section callback-area bg-white tm-padding-section">
            <div class="container">
                <div class="row align-items-center h-100-vh">
                    <div class="col-lg-4 d-none d-lg-block p-t-b-25">
                        <img class="img-fluid" src="/assets/media/svg/login.svg" alt="...">
                    </div>

                    <div class="col-lg-6 offset-lg-1 p-t-25 p-b-10">
                        <div class="tm-callback">
                            <h2>درخواست همکاری</h2>
                            <p>
                                اگر مایل به همکاری هستید ایمیل و شماره همراه خود را برای ما بگذارید.
                            </p>
                            <form action="/rtamas" class="tm-form" method="post">
                                @csrf
                                @include('errors')

                                <div class="tm-form-inner">
                                    <div class="tm-form-field">
                                        <input id="email" name="email" type="text" placeholder="ایمیل را وارد کنید*"
                                               required="">
                                    </div>
                                    <div class="tm-form-field">
                                        <select id="place" name="place">
                                            <option value="a">دسته بندی را انتخاب کنید</option>
                                            <option value="دبیر">دبیر</option>
                                            <option value="مشاور">مشاور</option>
                                            <option value="مسول بوفه">مسول بوفه</option>
                                            <option value="غیره">غیره</option>
                                        </select>

                                    </div>
                                    <div class="tm-form-field tm-form-fieldhalf">
                                        <input id="phone" name="phone" type="text" placeholder="شماره تلفن*"
                                               required="">
                                    </div>
                                    <div class="tm-form-field tm-form-fieldhalf">
                                        <input type="text" name="date1" id="date-picker-shamsi"
                                               class="form-control text-right"
                                               dir="ltr" value="{{old('date1')}}"
                                               placeholder="تاریخ پیشنهادی برای برقرای تماس " autocomplete="off">
                                    </div>
                                    <div class="tm-form-field">
                                        <button type="submit" class="tm-button">ثبت</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Request Callback Area -->
        <!-- Funfact Area -->
        <div class="tm-section funfact-area tm-padding-section tm-parallax"
             data-bgimage="assets/images/bg/bg-breadcrumb.jpg" data-overlay="9">
            <div class="container">
                <div class="row tm-funfact-wrapper">

                    <!-- Single Funfact -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="tm-funfact wow fadeInUp">
<span class="tm-funfact-icon">
<i class="flaticon-group"></i>
</span>
                            <div class="tm-funfact-content">
                                <h4 style="color: white">{!! $studentcount !!}</h4>
                                <h5>تعداد دانش آموزان</h5>

                            </div>
                        </div>
                    </div>
                    <!--// Single Funfact -->

                    <!-- Single Funfact -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="tm-funfact wow fadeInUp">
    <span class="tm-funfact-icon">
    <i class="flaticon-success"></i>
    </span>
                            <div class="tm-funfact-content">
                                <h4 style="color: white">{!! $classcount !!}</h4>
                                <h5>تعداد کلاس ها</h5>

                            </div>
                        </div>
                    </div>
                    <!--// Single Funfact -->

                    <!-- Single Funfact -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="tm-funfact wow fadeInUp">
    <span class="tm-funfact-icon">
    <i class="flaticon-group"></i>
    </span>
                            <div class="tm-funfact-content">
                                <h4 style="color: white">{!! $kadrcount !!}</h4>
                                <h5>تعداد پرسنل {{config('global.school')}}</h5>
                            </div>
                        </div>
                    </div>
                    <!--// Single Funfact -->

                    <!-- Single Funfact -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="tm-funfact wow fadeInUp">
    <span class="tm-funfact-icon">
    <i class="flaticon-like"></i>
    </span>
                            <div class="tm-funfact-content">
                                <h4 style="color: white">{!! $anjomancount !!}</h4>

                                <h5>تعداد انجمن اولیاء</h5>
                            </div>
                        </div>
                    </div>
                    <!--// Single Funfact -->

                </div>
            </div>
        </div>

        @if(count($questions)>0)
        <!-- Our Portfolios -->
            <div class="tm-section blogs-area bg-white tm-padding-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                            <div class="tm-section-title text-center">
                                <h2>نمونه سوال ها</h2>
                                <span class="divider"><i class="fa fa-superpowers"></i></span>

                            </div>
                        </div>
                    </div>
                    <div class="blog-slider-active tm-slider-arrow tm-slider-arrow-hovervisible">
                    @foreach($questions as $question)

                        <!-- Single Blog -->
                            <div class="blog-slider-item">
                                <div class="tm-blog wow fadeInUp">
                                    <div class="tm-blog-content">
                                        <div class="tm-blog-meta" style="padding-top: 10px">
                                        <span style="color: red "><i class="fa fa-user-o"></i>توسط<a
                                                href=""
                                                style="color: red "> {{\App\User::where('id',$question->user_id)->first()['f_name']}} </a></span>
                                            <span><i class="fa fa-calendar-o"></i>{{$question->created_at->toDateString()}}</span>
                                            <span>

                                                <img class="rounded-circle" width="100px"
                                                     src="/homee/images/question2.jpg"
                                                     alt="...">

                                              </span>
                                        </div>
                                        <table>

                                            <tr>
                                                <td>
                                                    <h3> پایه {{$question->paye}} </h3>
                                                    <br>

                                                    <h3> درس {{$question->dars}}</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="20px" style="padding-right: -10px">
                                                    <p>
                                                        <a href="{{ route('question.download', $question->id) }}"
                                                           class="btn btn-success">
                                                            <i class="icon-download"></i> دانلود نمومه سوال </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--// Single Blog -->
                        @endforeach


                    </div>
                </div>
            </div>
            <!--// Our Portfolios -->
        @endif

    <!-- Blogs Area -->
        @if($recents)
            <div class="tm-section blogs-area bg-white tm-padding-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-10 col-12">
                            <div class="tm-section-title text-center">
                                <h2>آخرین مطالب</h2>
                                <span class="divider"><i class="fa fa-superpowers"></i></span>

                            </div>
                        </div>
                    </div>
                    <div class="blog-slider-active tm-slider-arrow tm-slider-arrow-hovervisible">
                    @foreach($recents as $recent)

                        <!-- Single Blog -->
                            <div class="blog-slider-item">
                                <div class="tm-blog wow fadeInUp">
                                    @if(empty(\App\HomeImage::where('matlab_id',$recent->id)->first()['resize_image']) )
                                        <br>
                                        <br>
                                        <div class="tm-blog-image" style="text-align: center">
                                    <span class="tm-service-icon">
                                       <i class="flaticon-consulting"></i>
                                       </span>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>

                                    @else
                                        <div class="tm-blog-image">
                                            <img
                                                src="{{url('images/'.\App\HomeImage::where('matlab_id',$recent->id)->first()['resize_image'])}}"
                                                alt="blog image">
                                        </div>
                                    @endif

                                    <div class="tm-blog-content">
                                        <div class="tm-blog-meta" style="padding-top: 10px">
                                        <span><i class="fa fa-user-o"></i>توسط<a
                                                href="blog.html">
                                            @if(\App\User::where('id',$recent->user_id)->first())
                                                    {{\App\User::where('id',$recent->user_id)->first()['l_name']}} </a></span>
                                            @endif
                                            <span><i class="fa fa-calendar-o"></i>{{$recent->created_at->toDateString()}}</span>
                                        </div>
                                        <table>

                                            <tr>
                                                <td>
                                                    <a href="/single/{{$recent->id}}">
                                                        <h4>{{$recent->title}}</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-right: -10px">
                                                    <p>{!!  str_limit($recent->body, 80); !!}

                                                        <br>
                                                        <a href="/single/{{$recent->id}}" class="tm-readmore">
                                                            ادامه مطلب ...
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--// Single Blog -->
                        @endforeach


                    </div>
                </div>
            </div>
    @endif
    <!--// Blogs Area -->
        <!-- Call To Action Area -->
        <div class="tm-section call-to-action-area bg-theme">
            <div class="container">
                <div class="row align-items-center tm-cta">
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="tm-cta-content">
                            <h3>آیا تمایل به فعالیت در {{config('global.school')}} را دارید؟</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="tm-cta-button">
                            <a href="/phoneme" class="tm-button tm-button-white">ارسال درخواست<b></b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--// Call To Action Area -->
    </main>
    <!--// Main -->

@endsection('main')
