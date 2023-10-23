
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
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
    <meta name="theme-color" content="#3f51b5" />
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
            <img class="img-fluid" src="/assets/media/svg/recover-password.svg" alt="...">
        </div>
        <div class="col-lg-4 offset-lg-1 p-t-25 p-b-10">
            <h6>                            برای شماره همراه {{session('mobile')}} کد تایید ارسال گردید
            </h6>
            <form class="form-account" onsubmit="return false;">

            <p>کد تایید را وارد کنید</p>

                <div class="form-group mb-4">
                    <input type="number" name="code_1" class="form-control line-number" maxlength="5" id="input_1"
                           autofocus autocomplete="off" >
                </div>
                <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4" onclick="call_check();">ثبت</button>
                <div class="form-account-row">
                    <p id="trysmsmessage" style="display: none"><a href="JavaScript:void(0);"
                                                                   class="btn-link-border"
                                                                   onclick="trysms();">دریافت مجدد
                            کد</a></p>
                    <div id="timershow"> دریافت مجدد کد: <span id="timer"></span></div>
                </div>

            </form>
        </div>

    </div>
</div>


</body>
</html>

<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->

<script type="text/javascript" src="{{url('/assets/js/verifypass.js')}}"></script>






