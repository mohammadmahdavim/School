@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">تالار گفتمان</h2>
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

                    <a href="/question/create" class="btn btn-warning" style="text-align: center">

                        <h4 style="text-align: center;color: black">
                                <span class="tm-funfact-icon">
                                <i class="flaticon-success"></i>
                                </span>
                           <span style="color: red"> کلیک کن </span> و
                                یه بحث جدید شروع کن. </h4></a>
                </div>

                <br>
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="tm-blog-list sticky-sidebar">
                            <div class="row mt-30-reverse blog-masonry-active">

                                <!-- Single Blog -->

                                @foreach($data as $row)
                                    <div class="col-lg-3 col-md-3 col-12 mt-30 blog-masonry-item">
                                        <div class="blog-slider-item">
                                            <div class="tm-blog wow fadeInUp">
                                                <div class="tm-blog-content">
                                                    <div style="text-align: center;padding-top: 10px">
                                                        <h4> اتاق گفتگو: {{$row->title}}
                                                        </h4>
                                                    </div>
                                                    <br>
                                                    <div class="tm-blog-meta">
                                                        <span><i class="fa fa-user-o"></i>نویسنده: {{$row->name}}({{$row->role}})</span>
                                                        <span><i class="fa fa-calendar-o"></i>{{$row->created_at->toDateString()}}</span>
                                                    </div>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <h5><a></a>
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <a href="/question/single/{{$row->id}}" class="tm-readmore" style="color: #b91d19">کلیک کن و تو بحث شرکت کن...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            <!--// Single Blog -->


                            </div>
                            <br>
                            <div style="text-align: center">
                                {!! $data->render() !!}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--// Blogs Area -->


    </main>

@endsection('main')