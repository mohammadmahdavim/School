@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">پیش ثبت نام</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">پیش ثبت نام</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection('slider')


@section('main')
    <main class="main-content">
        <div class="panel-body">
            <div class="container">
                <br>
                <div class="tm-section callback-area bg-white tm-padding-section">
                    <div class="container">
                        <div class="row align-items-center h-100-vh">
                            <div class="col-lg-4 d-none d-lg-block p-t-b-25">
                                <img class="img-fluid" src="/assets/media/svg/recover-password.svg" alt="...">
                            </div>

                            <div class="col-lg-6 offset-lg-1 p-t-25 p-b-10">
                                <div class="tm-callback">
                                    <h2>پیش ثبت نام  @include('includ.name')</h2>
                                    <p>
                                        لطفا اطلاعات اولیه خود را وارد نمایید.
                                    </p>
                                    <form action="/registration/school" class="tm-form" method="post">
                                        @csrf
                                        @include('errors')

                                        <div class="tm-form-inner">
                                            <div class="tm-form-field tm-form-fieldhalf">
                                                <input id="f_name" name="f_name" type="text" value="{{old('f_name')}}" placeholder="نام*"
                                                       required="">
                                            </div>
                                            <div class="tm-form-field tm-form-fieldhalf">
                                                <input id="l_name" name="l_name" type="text" value="{{old('l_name')}}" placeholder="نام خانوادگی*"
                                                       required="">
                                            </div>
                                            <div class="tm-form-field tm-form-fieldhalf">
                                                <input id="Fname" name="Fname" type="text" value="{{old('Fname')}}" placeholder="نام پدر*"
                                                       required="">
                                            </div>
                                            <div class="tm-form-field tm-form-fieldhalf">
                                                <input id="codemeli" name="mobile" type="text" value="{{old('mobile')}}" placeholder="شماره همراه*"
                                                       required="">
                                            </div>
                                            <div class="tm-form-field">
                                                <select id="paye" name="paye">
                                                    <option value="">پایه تحصیلی را انتخاب کنید</option>
                                                    @foreach($paye as $p)
                                                        <option value="{{$p->name}}">{{$p->name}}</option>
                                                    @endforeach
                                                </select>

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
            </div>
        </div>

    </main>
@endsection('main')


