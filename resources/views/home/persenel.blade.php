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
            <div class="row tm-portfolio-wrapper mt-30-reverse">
                <!-- Portfolio Single -->
@foreach($imags as $imag)

                    <div class="col-lg-3 col-md-6 col-12 tm-portfolio-item  portfolio-filter-careative portfolio-filter-technology">
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
                                <h6 style="text-align: center">{{$imag->little_body}}</h6>

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