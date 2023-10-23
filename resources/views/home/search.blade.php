@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">نتایج جستجو</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">نتایج جستجو</a></li>
                    <li>سسسس</li>
                </ul>
            </div>
        </div>
    </div>

@endsection('slider')


@section('main')

    <main class="main-content">
        <div class="panel-body">
            <div class="panel">

                <div class="col-md-5 table-responsive" style="padding-right: 210px">
                    <br>
                    <form action="/search" class="widget-search-form" method="post">
                        @csrf
                        <input name="search" id="serrch" type="text" placeholder="جستجوی...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>


                </div>
                <br>
                @if(count($searches)>0)
                    <h4 style="color: #bd2130;text-align: center">نتایج یافت شده</h4>
                @else
                    <h4 style="color: #bd2130;text-align: center">نتیجه ای یافت نشد</h4>
                @endif
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-11">
                        @foreach($searches as $searche)
                            <div class="row">
                                <div class="col-md-3" style="text-align: center">
                                    <a href="/single/{{$searche->id}}">
                                        <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$searche->id)->first()['resize_image'])}}"
                                             alt="blog image" style="height: 80%;width: 60%;margin: 0 auto;"> </a>
                                    </a>
                                </div>
                                <div class="col-md-9" style="text-align: right">
                                    <a href="/single/{{$searche->id}}">

                                        <h4>{{$searche->title}}</h4>
                                    </a>

                                    <br>
                                    <h6><p>{!!  str_limit($searche->body, 120
            );  !!}</h6>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                            <div style="text-align: center">
                                {{ $searches->appends(Request::get('page'))->links()}}

                            </div>
                    </div>

                </div>

            </div>


        </div>

    </main>
@endsection('main')


