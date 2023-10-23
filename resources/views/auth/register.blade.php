{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--<div class="row justify-content-center">--}}
{{--<div class="col-md-8">--}}
{{--<div class="card">--}}
{{--<div class="card-header" style="text-align: right">{{ __('ثبت نام') }}</div>--}}

{{--<div class="card-body">--}}
{{--<form method="POST" action="{{ route('register') }}">--}}
{{--@csrf--}}

{{--<div class="form-group row">--}}

{{--<label for="f_name" class="col-md-4 col-form-label text-md-left">{{ __('نام') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input oninvalid="this.setCustomValidity('لطفا نام خود را وارد کنید')"--}}
{{--oninput="setCustomValidity('')" id="f_name" type="text" style="bo" class="form-control{{ $errors->has('f_name') ? ' is-invalid' : '' }}" name="f_name" value="{{ old('f_name') }}" required autofocus>--}}

{{--@if ($errors->has('f_name'))--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('f_name') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row">--}}
{{--<label for="l_name" class="col-md-4 col-form-label text-md-left">{{ __('  نام خانوادگی') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input oninvalid="this.setCustomValidity('لطفا نام  خانوادگی خود را وارد کنید')"--}}
{{--oninput="setCustomValidity('')" id="l_name" type="text" style="bo" class="form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}" name="l_name" value="{{ old('l_name') }}" required autofocus>--}}

{{--@if ($errors->has('l_name'))--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('l_name') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row">--}}
{{--<label for="codemeli" class="col-md-4 col-form-label text-md-left">{{ __(' کد ملی') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input oninvalid="this.setCustomValidity('لطفا کد ملی خود را وارد کنید')"--}}
{{--oninput="setCustomValidity('')"id="codemeli" type="text" style="bo" class="form-control{{ $errors->has('codemeli') ? ' is-invalid' : '' }}" name="codemeli" value="{{ old('codemeli') }}" required autofocus>--}}

{{--@if ($errors->has('codemeli'))--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('codemeli') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row">--}}
{{--<label for="phone" class="col-md-4 col-form-label text-md-left">{{ __(' شماره موبایل') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input oninvalid="this.setCustomValidity('لطفا شماره همراه خود را وارد کنید')"--}}
{{--oninput="setCustomValidity('')"id="phone" type="text" style="bo" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>--}}

{{--@if ($errors->has('phone'))--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('phone') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row">--}}
{{--<label for="email" class="col-md-4 col-form-label text-md-left">{{ __('آدرس ایمیل') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input placeholder="اختیاری" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

{{--@if ($errors->has('email'))--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('email') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row">--}}
{{--<label for="role" class="col-md-4 col-form-label text-md-left">{{ __('نقش') }}</label>--}}
{{--<div class="col-md-6 text-md-right col-form-label ">--}}
{{--<select name="role" id="role" class="form-control">--}}
{{--@foreach($role as $r)--}}
{{--<option value="{{$r->name}}">{{$r->name}} </option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="password" class="col-md-4 col-form-label text-md-left">{{ __('رمز') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input oninvalid="this.setCustomValidity('لطفا رمز خود را وارد کنید')"--}}
{{--oninput="setCustomValidity('')" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

{{--@if ($errors->has('password'))--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('password') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('تکرار رمز') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input oninvalid="this.setCustomValidity('لطفارمز خود را تکرار کنید')"--}}
{{--oninput="setCustomValidity('')" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row mb-0">--}}
{{--<div class="col-md-6 offset-md-4">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--{{ __('ثبت نام') }}--}}
{{--</button>--}}

{{--</div>--}}


{{--</div>--}}
{{--</form>--}}
{{--<a href="login"><button type="button">قبلا ثبت نام کردم</button></a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
    <!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @include('includ.name')</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="{{'/uploads/'.\App\Setting::all()->first()->logo}}">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->

</head>
<body class="bg-white h-100-vh p-t-0">

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<div class="container h-100-vh">
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-6 d-none d-lg-block p-t-b-25">
            <img class="img-fluid" src="/assets/media/svg/register.svg" alt="...">
        </div>

        <div class="col-lg-5 offset-lg-1 p-t-25 p-b-10">

            <h3>ثبت نام</h3>
            <p>ایجاد حساب کاربری جدید</p>
            <div class="card">
                <div class="card-body " style="background-color: #F3F9F9">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @include('Admin.errors')

                        <div class="form-group row">

                            <label for="f_name" class="col-md-3 col-form-label text-md-left">{{ __('نام') }}</label>

                            <div class="col-md-9">
                                <input oninvalid="this.setCustomValidity('لطفا نام خود را وارد کنید')"
                                       oninput="setCustomValidity('')" id="f_name" type="text" style="text-align: right"
                                       class="form-control {{ $errors->has('f_name') ? ' is-invalid' : '' }}"
                                       name="f_name" value="{{ old('f_name') }}" required autofocus>

                                @if ($errors->has('f_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="l_name"
                                   class="col-md-3 col-form-label text-md-left">{{ __('  نام خانوادگی') }}</label>

                            <div class="col-md-9">
                                <input oninvalid="this.setCustomValidity('لطفا نام  خانوادگی خود را وارد کنید')"
                                       oninput="setCustomValidity('')" id="l_name" type="text" style="bo"
                                       class="form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}"
                                       name="l_name" value="{{ old('l_name') }}" required autofocus>

                                @if ($errors->has('l_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="codemeli"
                                   class="col-md-3 col-form-label text-md-left">{{ __(' کد ملی') }}</label>

                            <div class="col-md-9">
                                <input oninvalid="this.setCustomValidity('لطفا کد ملی خود را وارد کنید')"
                                       oninput="setCustomValidity('')" id="codemeli" type="text" style="bo"
                                       class="form-control{{ $errors->has('codemeli') ? ' is-invalid' : '' }}"
                                       name="codemeli" value="{{ old('codemeli') }}" required autofocus
                                       placeholder="صفحه کلید انگلیسی  و کپسلاک خاموش باشد ">

                                @if ($errors->has('codemeli'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codemeli') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-3 col-form-label text-md-left">{{ __('  موبایل') }}</label>

                            <div class="col-md-9">
                                <input oninvalid="this.setCustomValidity('لطفا شماره همراه خود را وارد کنید')"
                                       oninput="setCustomValidity('')" id="mobile" type="text" style="bo"
                                       class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                       name="mobile" value="{{ old('mobile') }}" required autofocus
                                       placeholder="صفحه کلید انگلیسی  و کپسلاک خاموش باشد">

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-3 col-form-label text-md-left">{{ __('پایه') }}</label>
                            <div class="col-md-9 text-md-right col-form-label ">
                                <select name="paye" id="paye" class="form-control">
                                    <?php
                                    $paye = \App\paye::all();
                                    ?>
                                    @foreach($paye as $p)
                                        <option>{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-left">{{ __('رمز') }}</label>

                            <div class="col-md-9">
                                <input oninvalid="this.setCustomValidity('لطفا رمز خود را وارد کنید')"
                                       oninput="setCustomValidity('')" id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="col-md-3 col-form-label text-md-left">{{ __('تکرار رمز') }}</label>

                            <div class="col-md-9">
                                <input oninvalid="this.setCustomValidity('لطفارمز خود را تکرار کنید')"
                                       oninput="setCustomValidity('')" id="password-confirm" type="password"
                                       class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="captcha"
                                   class="col-md-3 col-form-label text-md-left">{{ __('حروف تصویر') }}</label>

                            <div class="col-md-9">
                                <div style="text-align: center" class=""> @captcha</div>

                                <input class="form-control" placeholder="حروف تصویر را وارد نمایید." type="text"
                                       id="captcha" name="captcha">
                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ثبت نام</button>
                                <p class="text-left">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('login') }}" style="color: #0000C0">
                                            {{ __('حساب کاربری دارید؟') }}
                                        </a>
                                    @endif
                                </p>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->


</html>
