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
            <h3>
                تغییر رمز عبور</h3>
            <p>رمز عبور جدید</p>
            <div class="form-group mb-4">
                <input class="input-field form-control" type="password" id="password" name="password"
                       placeholder="رمز عبور جدید خود را وارد نمایید">
            </div>
            <br>
            <p>تکرار رمز عبور جدید</p>
            <input class="input-field form-control" type="password" id="password_confirmation" name="password_confirmation"
                   placeholder="رمز عبور جدید خود را مجددا وارد نمایید">
            <br>
            <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4"  onclick="resetPass();">ثبت</button>

        </div>
    </div>
</div>

<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->

</body>
</html>
    <script>
        resetPass = function () {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var rc = url.searchParams.get("rc");
            var password = document.getElementById('password').value;
            var password_confirmation = document.getElementById('password_confirmation').value;
            $('#loading').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: '/password/resets?rc=' + rc,
                type: 'POST',
                data: {password: password, password_confirmation: password_confirmation},
                success: function (response, textStatus, xhr) {
                    setTimeout(function () {
                        window.location.replace('/');
                    }, 100);
                },
                error: function (xhr, textStatus) {
                    $('#loading').hide();
                    jQuery.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            });
        }
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::global scripts -->
    <script src="/assets/vendors/bundle.js"></script>
    <!-- end::global scripts -->

    <!-- begin::custom scripts -->
    <script src="/assets/js/app.js"></script>
    <!-- end::custom scripts -->


