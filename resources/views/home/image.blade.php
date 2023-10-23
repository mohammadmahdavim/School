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
    <div class="tm-section portfolios-area bg-grey tm-padding-section">
        <div class="container">
            <div class="row ">
                <!-- Portfolio Single -->
                @if($slidimage)
                    <div class="col-lg-6 col-md-6 col-12  blog-masonry-item">
                        <div class="blog-slider-item">
                            <br>
                            <div class="tm-blog wow fadeInUp">

                                <div class="tm-blog-imageslider tm-slider-arrow tm-slider-dots">
                                    <?php
                                    $images = \App\HomeImage::where('matlab_id', $slidimage->id)->orderby('created_at', 'desc')->get();
                                    ?>
                                    @foreach($images as $image)
                                        <a href="#" class="">
                                            <img src="{{url('images/'.$image->resize_image)}}" alt="blog image">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="tm-blog-content">
                                    <div class="tm-blog-meta" style="text-align: center;padding-top: 10px">
                                        <span><i class="fa fa-user-o"></i>توسط: {{\App\User::where('id',$slidimage->user_id)->first()['l_name']}}</span>
                                        <span><i class="fa fa-calendar-o"></i>{{$slidimage->created_at->toDateString()}}</span>
                                    </div>
                                    <h5 style="text-align: center"><a
                                                href="/single/{{$slidimage->id}}">{{$slidimage->title}}</a></h5>
                                    <a href="/single/{{$slidimage->id}}" class="tm-readmore">ادامه مطلب...</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($slidimage2)
                    <div class="col-lg-6 col-md-6 col-12  blog-masonry-item">
                        <div class="blog-slider-item">
                            <br>
                            <div class="tm-blog wow fadeInUp">

                                <div class="tm-blog-imageslider tm-slider-arrow tm-slider-dots">
                                    <?php
                                    $images = \App\HomeImage::where('matlab_id', $slidimage2->id)->orderby('created_at', 'desc')->get();
                                    ?>
                                    @foreach($images as $image)
                                        <a href="#" class="">
                                            <img src="{{url('images/'.$image->resize_image)}}" alt="blog image">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="tm-blog-content">
                                    <div class="tm-blog-meta" style="text-align: center;padding-top: 10px">
                                        <span><i class="fa fa-user-o"></i>توسط: {{\App\User::where('id',$slidimage2->user_id)->first()['l_name']}}</span>
                                        <span><i class="fa fa-calendar-o"></i>{{$slidimage2->created_at->toDateString()}}</span>
                                    </div>
                                    <h5 style="text-align: center"><a
                                                href="/single/{{$slidimage2->id}}">{{$slidimage2->title}}</a></h5>
                                    <a href="/single/{{$slidimage2->id}}" class="tm-readmore">ادامه مطلب...</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($imags as $imag)
                    <div class="col-lg-3 col-md-6 col-12 tm-portfolio-item {{\App\PortfolioDetail::where('home_id',$imag->id)->first()['tag']}} portfolio-filter-careative portfolio-filter-technology">
                        <div class="tm-portfolio mt-30 wow fadeInUp">
                            <div class="">
                                <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$imag->id)->orderby('created_at', 'desc')->first()['resize_image'])}}">
                                <ul class="tm-portfolio-actions">
                                    <li class="link-button">
                                        <a href="/single/{{$imag->id}}"><i class="fa fa-link"></i></a>
                                    </li>
                                    <li class="zoom-button">
                                        <?php
                                        $images = \App\HomeImage::where('matlab_id', $imag->id)->orderby('created_at', 'desc')->get();
                                        ?>
                                        @foreach($images as $image)
                                            <a href="{{url('images/'.$image->resize_image)}}"><i
                                                        class="fa fa-clone"></i></a>
                                        @endforeach

                                    </li>
                                </ul>
                            </div>
                            <div class="tm-portfolio-content">
                                <div class="tm-blog-meta" style="padding-right: 10px;padding-top: 10px">
                                    <span><i class="fa fa-user-o"></i>توسط: {{\App\User::where('id',$imag->user_id)->first()['l_name']}}</span>
                                    <span><i class="fa fa-calendar-o"></i>{{$imag->created_at->toDateString()}}</span>
                                </div>
                                <h5 style="text-align: center"><a href="/single/{{$imag->id}}">{{$imag->title}}</a></h5>
                                <a href="/single/{{$imag->id}}" class="tm-readmore">ادامه مطلب...</a>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <br>
            <div style="text-align: center">
                {!! $imags->render() !!}

            </div>
        </div>
    </div>

@endsection('main')