@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">{{$sidebar}}</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">مطالب</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection('slider')


@section('main')

    <!-- Main Content -->
    <main class="main-content">

        <!-- Blogs Area -->
        <div class="tm-section blogs-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 order-1 order-lg-2">
                        <div class="tm-blog-list sticky-sidebar">
                            <div class="row mt-30-reverse blog-masonry-active">
                                <!-- Single Blog -->
                                @foreach($rowws as $row)
                                    <div class="col-lg-6 col-md-6 col-12 mt-30 blog-masonry-item">
                                        <div class="blog-slider-item">
                                            <div class="tm-blog wow fadeInUp">
                                                <div class="tm-blog-image">
                                                    @if(empty(App\HomeImage::where('matlab_id',$row->id)->first()['resize_image']))
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                    @else
                                                        <a href="/single/{{$row->id}}">
                                                            <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$row->id)->first()['resize_image'])}}"
                                                                 alt="blog image"> </a>

                                                    @endif
                                                </div>
                                                <div class="tm-blog-content">
                                                    <div class="tm-blog-meta" style="padding-right: 10px;padding-top: 10px">
                                                        <span><i class="fa fa-user-o"></i>توسط: {{\App\User::where('id',$row->user_id)->first()['l_name']}}({{\App\User::where('id',$row->user_id)->first()['role']}})</span>
                                                        <span><i class="fa fa-calendar-o"></i>{{$row->created_at->toDateString()}}</span>

                                                    </div>


                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <h5 style="padding-right: 100px"><a>{{$row->title}}</a>
                                                                </h5>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="60px" style="padding-right: -10px">
                                                                <p>
                                                                    {!!  substr(strip_tags($row->little_body), 0, 150) !!}

                                                                </p>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                    @if($sidebar!='برترها' && $sidebar!='پرسنل' && $sidebar!='نمایندگان')

                                                        <a href="/single/{{$row->id}}" class="tm-readmore">ادامه
                                                            مطلب...</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            <!--// Single Blog -->
                            </div>
                            <br>
                            <div class="tm-pagination mt-50">
                                {!! $rowws->render() !!}

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-12 order-2 order-lg-1">
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
                            <div class="single-widget widget-tags">

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
    <!--// Main Content -->

@endsection('main')
