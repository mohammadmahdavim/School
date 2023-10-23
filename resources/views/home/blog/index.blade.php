@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">وبلاگ {{config('global.students')}}</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">مطالب</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection('slider')


@section('main')

    <main class="main-content">

        <!-- Blogs Area -->
        <div class="tm-section blogs-area bg-white tm-padding-section">
            <div class="container">
                <div style="text-align: center">

                    <a href="/blogs/create" class="btn btn-warning" style="text-align: center">

                        <h4 style="text-align: center;color: black">
                                <span class="tm-funfact-icon">
                                <i class="flaticon-success"></i>
                                </span>
                            <span style="color: red"> کلیک کن </span> و
                            مقاله خودت رو بنویس. </h4></a>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="tm-blog-list sticky-sidebar">
                            <div class="row mt-30-reverse blog-masonry-active">

                                <!-- Single Blog -->

                                @foreach($data as $row)
                                    <div class="tm-section about-us-area bg-white">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-3">
                                                    <div class="tm-about-image">
                                                        <a href="/blogs/single/{{$row->id}}">
                                                            <img src="{{url('images/'.$row->filename)}}"
                                                                 alt="blog image">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-9">
                                                    <div class="tm-about-content">
                                                        <h3><a>{{$row->title}}</a>
                                                        </h3>
                                                        <p>
                                                            {!!  substr(strip_tags($row->body), 0, 250) !!}
                                                            <br>
                                                            <br>
                                                            <a href="/blogs/single/{{$row->id}}" class="tm-readmore"
                                                               style="color: darkred">ادامه
                                                                مطلب...</a>
                                                        </p>
                                                        <ul class="stylish-list">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    &nbsp;
                                    <hr>
                            @endforeach
                            <!--// Single Blog -->


                            </div>
                            <br>
                            <div style="text-align: center">
                                {!! $data->render() !!}

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="widgets sidebar-widgets sticky-sidebar">

                            <!-- Single Widget -->
                            <div class="single-widget widget-search">
                                <h5 class="widget-title">جستجو</h5>
                                <form action="/search" class="widget-search-form" method="post">
                                    @csrf

                                    <input name="search" id="serrch" type="text" placeholder="جستجوی...">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!--// Single Widget -->

                            <!-- Single Widget -->
                            <div class="single-widget widget-categories">
                                <h5 class="widget-title">دسته بندی ها</h5>
                                <ul>
                                    @foreach($tags as $tag)
                                        <li><a href="/view/tag/{{$tag->id}}">{{$tag->tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--// Single Widget -->

                            <!-- Single Widget -->
                            <div class="single-widget widget-recentpost">
                                <h5 class="widget-title">پست های اخیر</h5>
                                <ul>
                                    @foreach($recents as $recent)
                                        <li>
                                            @if(!empty(\App\HomeImage::where('matlab_id',$recent->id)->first()['resize_image']) )

                                                <a href="/single/{{$recent->id}}" class="widget-recentpost-image">
                                                    <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$recent->id)->orderby('created_at', 'desc')->first()['resize_image'])}}"
                                                         alt="blog thumbnail">
                                                </a>
                                            @endif
                                            <div class="widget-recentpost-content">
                                                <h6><a href="/single/{{$recent->id}}">{{$recent->title}}</a></h6>
                                                <span>{{$recent->created_at->toDateString()}}</span>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <!--// Single Widget -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Blogs Area -->


    </main>

@endsection('main')
