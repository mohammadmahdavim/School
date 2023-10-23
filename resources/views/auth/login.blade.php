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

        <div class="col-lg-4 offset-lg-1 p-t-25 p-b-10">





            <h3>ورود</h3>
            <p>ورود به پنل خود</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                @include('Admin.errors')

                <div class="form-group row">

                    <div class="col-md-12">
                        <input id="codemeli" type=""
                               class="form-control form-control-lg{{ $errors->has('codemeli') ? ' is-invalid' : '' }}"
                               name="codemeli" required autofocus placeholder="کد ملی">

                        @if ($errors->has('codemeli'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codemeli') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-12">
                        <input id="password" type="password"
                               class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required placeholder="رمز ورود">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12"><br>
                        <h6>برای تغییر حروف تصویر روی آن کلیلک نمایید.</h6>
                        <div style="text-align: center" class=""> @captcha</div>
                        <br>
                        <input class="form-control" placeholder="حروف تصویر را وارد نمایید." type="text" id="captcha"
                               name="captcha" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ورود به پنل</button>
                        <p class="text-left">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="/password/forgot" style="color: #0000C0">
                                    {{ __('رمز خود را فراموش کردم!') }}
                                </a>
                            @endif
                        </p>

                    </div>
                </div>

            </form>
            <p class="text-right"><a href="/register">
                    <button class="btn btn-info"> ایجاد حساب کاربری</button>
                </a></p>

        </div>
    </div>
</div>
</body>
<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->


</html>
