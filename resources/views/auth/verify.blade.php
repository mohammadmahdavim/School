<html lang="fa">
<head>
    <meta charset="UTF-8" >
    <meta name="_token" content="{{csrf_token()}}">
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
    <div class="wrapper default">
        <div class="container">
            <div class="row">
                <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                    <div class="account-box verify-phone-number">
                        <div class="logo-in-box text-center pt-3 pb-2">
                            <a href="#" class="d-block">
                                <img src="{{url('assets/img/logo.png')}}" alt="">
                            </a>
                        </div>
                        <div class="message-light">
                            برای شماره همراه {{session('mobile')}} کد تایید ارسال گردید
                            <a href="{{url('register')}}" class="btn-link-border form-account-link">
                                ویرایش شماره
                            </a>
                        </div>
                        <div class="account-box-content">
                            <form class="form-account" onsubmit="return false;">
                                <div class="form-account-title">کد تایید را وارد کنید</div>
                                <div class="form-account-row numbers-verify">
                                    <div class="lines-number-input">
                                        <input type="number" name="code_1" class="line-number" maxlength="1" id="input_1" autofocus autocomplete="off" onkeyup="moveOnMax(this,'input_2')">
                                        <input type="number" name="code_2" class="line-number" maxlength="1" id="input_2" autocomplete="off" onkeyup="moveOnMax(this,'input_3')">
                                        <input type="number" name="code_3" class="line-number" maxlength="1" id="input_3" autocomplete="off" onkeyup="moveOnMax(this,'input_4')">
                                        <input type="number" name="code_4" class="line-number" maxlength="1" id="input_4" autocomplete="off" onkeyup="moveOnMax(this,'input_5')">
                                        <input type="number" name="code_5" class="line-number" maxlength="1" id="input_5" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-account-row">
                                    <p id="trysmsmessage" style="display: none"><a href="JavaScript:void(0);" class="btn-link-border" onclick="trysms();">دریافت مجدد کد</a></p>
                                    <div id="timershow"> دریافت مجدد کد: <span id="timer"></span></div>
                                </div>
                            </form>
                        </div>
                        <div class="account-box-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::global scripts -->
        <script src="/assets/vendors/bundle.js"></script>
        <!-- end::global scripts -->

        <!-- begin::custom scripts -->
        <script src="/assets/js/app.js"></script>
        <!-- end::custom scripts -->
<script type="text/javascript" src="{{url('/assets/js/verify.js')}}"></script>

