

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
            <h3>بازیابی رمز عبور</h3>
            <p>شماره موبایل خود را وارد نمایید</p>

                <div class="form-group mb-4">
                    <input  type="number" id="mobile" name="mobile" class="form-control fodrm-control-lg" autofocus placeholder="شماره موبایل">
                </div>
                <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4"  onclick="resetPassword();">ثبت</button>

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

    <meta name="_token" content="{{csrf_token()}}">
    <script>
        resetPassword = function () {
            var mobile = document.getElementById('mobile').value;
            if (mobile.length < 11) {
                toastr.warning("موبایل را به درستی وارد نمایید.");
                return false;
            }
            document.getElementById('mobile').disabled = true;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
               url:'{{url('/password/forgot')}}',
               type:'POST',
               data:{mobile:mobile},
                success : function (response, textStatus, xhr) {
                    setTimeout(function () {
                        window.location.replace('/password/forgot/phone') ;
                    }, 100);
                },
                error : function (xhr, textStatus) {
                    document.getElementById('mobile').value = '';
                    document.getElementById('mobile').disabled = false;
                    $("#mobile").focus();
                    toastr.error(xhr.responseJSON.errors);
                }
            });
        }
    </script>

