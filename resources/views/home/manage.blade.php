@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">سخن مدیریت</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">سخن مدیریت</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection('slider')


@section('main')

    <main class="main-content">

        <div class="tm-section about-us-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    @if(!empty(\App\HomeImage::where('matlab_id',$data->id)->first()['resize_image']) )
                        <?php
                        $img = \App\HomeImage::where('matlab_id', $data->id)->orderby('created_at', 'desc')->first();
                        ?>
                        <div class="col-xl-6 col-lg-5">
                            <div class="tm-about-image">
                                <img class="wow fadeInLeft" src="{{url('images/'.$img->resize_image)}}"
                                     alt="Cinque Terre">
                            </div>
                        </div>

                    @endif

                    <div class="col-xl-6 col-lg-7">
                        <div class="tm-about-content">
                            <h2>سخن مدیریت</h2>
                            <span class="divider"><i class="fa fa-superpowers"></i></span>
                            <p>{!! $data->body !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection('main')


