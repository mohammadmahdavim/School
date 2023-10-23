@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

@endsection('css')
@section('script')
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')
    <div class="card">
        @if($connect==1)
            <div class="card-body" style="background-color: green;color: #0a1520">
                <h5>اتصال به سرور وصل می باشد.</h5>
            </div>
        @else
            <div class="card-body" style="background-color: red;color: #0a1520">
                <h5>اتصال به سرور قطع می باشد.</h5>
            </div>
        @endif
        @if($connect2==1)
            <div class="card-body" style="background-color: green;color: #0a1520">
                <h5>اتصال به سرور2 وصل می باشد.</h5>
            </div>
        @else
            <div class="card-body" style="background-color: red;color: #0a1520">
                <h5>اتصال به سرور2 قطع می باشد.</h5>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <h5>تنظیمات وب سایت</h5>

            </div>
            <form action="/admin/setting/name/store" method="post" enctype="multipart/form-data">
                @csrf
                <h4> اطلاعات عمومی و نامگذاری افراد</h4>

                <div class="row">

                    <div class="col-md-6">
                        <br>
                        <br>

                        <label>نام موسسه</label>
                        <input name="name" value="{{$setting->name}}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <img src="{{'/uploads/'.$setting->logo}}" width="50" height="50">
                        <br>

                        <label>لوگو مدرسه</label>
                        <input type="file" name="logo" class="form-control">

                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>دانش آموز</label>
                        <input name="student" value="{{$setting->student}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>دانش آموزان</label>
                        <input name="students" value="{{$setting->students}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>دبیر</label>
                        <input name="teacher" value="{{$setting->teacher}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>دبیران</label>
                        <input name="teachers" value="{{$setting->teachers}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>ولی</label>
                        <input name="parent" value="{{$setting->parent}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>اولیا</label>
                        <input name="parents" value="{{$setting->parents}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>مدیر</label>
                        <input name="admin" value="{{$setting->admin}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>مدرسه</label>
                        <input name="school" value="{{$setting->school}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>پایه</label>
                        <input name="paye" value="{{$setting->paye}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>خیلی خوب</label>
                        <input type="number" name="mark1" value="{{$setting->mark1}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>خوب</label>
                        <input type="number" name="mark2" value="{{$setting->mark2}}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>قابل قبول</label>
                        <input type="number" name="mark3" value="{{$setting->mark3}}" class="form-control">
                    </div>
                    <div class="form-group card-body">
                        <label>نوع نمره دهی را مشخص کنید.</label>
                        {{--                   --}}
                        <div class="form-group">

                            <div class="custom-control custom-radio">
                                <input type="radio" @if($setting->type_mark==1) checked @endif id="customRadio"
                                       name="type_mark" class="custom-control-input"
                                       value="1">
                                <label class="custom-control-label" for="customRadio">عددی</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" @if($setting->type_mark==0) checked @endif id="customRadio2"
                                       name="type_mark"
                                       class="custom-control-input" value="0">
                                <label class="custom-control-label" for="customRadio2">توصیفی</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <button class="btn btn-info" type="submit">ثبت</button>

                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <h5>تنظیمات وب سایت</h5>

            </div>
            <form action="/admin/setting/store" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row" style="display: none">

                    <div class="col-md-6">
                        <label>نام مدرسه</label>
                        <input name="name" value="{{$setting->name}}" class="form-control">
                    </div>
                    <div class="col-md-6">

                        <label>لوگو مدرسه</label>
                        <input type="file" name="logo" class="form-control">
                        <br>
                        <img src="{{'/uploads/'.$setting->logo}}" width="50" height="50">

                    </div>
                </div>
                <h4>اطلاعات سرور بیگ بلو باتن</h4>

                <div class="row">

                    <div class="col-md-6">
                        <label>Url</label>
                        <input name="BBB_SERVER_BASE_URL" value="{{$setting->BBB_SERVER_BASE_URL}}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>secret_key</label>
                        <input name="BBB_SECURITY_SALT" value="{{$setting->BBB_SECURITY_SALT}}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Url2</label>
                        <input name="BBB_SERVER_BASE_URL_2" value="{{$setting->BBB_SERVER_BASE_URL_2}}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>secret_key2</label>
                        <input name="BBB_SECURITY_SALT_2" value="{{$setting->BBB_SECURITY_SALT_2}}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>اسکای روم</label>
                        <input name="sky" value="{{$setting->sky}}" class="form-control">
                    </div>

                </div>
                <br>
                <h4>اطلاعات مالی</h4>
                <div class="row">

                    <div class="col-md-6">
                        <label>Api زرین پال</label>
                        <input name="config" value="{{$gatway}}"
                               class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>تاریخ فرصت پرداخت</label>
                        <input id="date-picker-shamsi" name="finance_deadline" value="{{$setting->finance_deadline}}"
                               class="form-control">
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <label data-toggle="tooltip"
                               title="درصورت زدن تیک، دانش آموزان برای دسترسی به پنل خود باید شهریه خود را پرداخت نمایند.">تیک
                            اجبار در پرداخت شهریه</label>
                        <input name="finance_status" type="checkbox" @if($setting->finance_status==1) checked @endif
                        class="form-control">
                    </div>

                </div>
                <div class="col-md-12">
                    <br>
                    <button class="btn btn-info" type="submit">ثبت</button>

                </div>
            </form>
        </div>
    </div>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')


