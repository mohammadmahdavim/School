@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')

    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <button class="btn btn-primary"> نمونه های پیام کوتاه
                </button>
            </div>
            <br>
            <form action="/admin/sms/store" method="post">
                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-4"><textarea cols='30' rows='5' readonly>اولیای گرامی علی رحمانی&#13;&#10; برای اطلاع از تاریخ جلسه اولیا &#13;&#10; به لینک زیر مراجع نمایید&#13;&#10;&#13;&#10;مدرسه جهان تربیت</textarea>
                        <input id="example" name="example" class="badgebox" type="radio"
                        ></div>
                    <div class="col-md-4"><textarea cols='30' rows='5' readonly>دانش آموز گرامی علی رحمانی&#13;&#10; برای شرکت در مسابقات فوتبال &#13;&#10; به لینک زیر مراجع نمایید&#13;&#10;&#13;&#10مدرسه جهان تربیت</textarea>
                        <input id="example" name="example" class="badgebox" type="radio"
                        ></div>
                    <div class="col-md-4"><textarea cols='30' rows='5' readonly>دبیر گرامی علی رحمانی&#13;&#10; برای اطلاع از روند دریافت حقوق ماهانه &#13;&#10; به لینک زیر مراجع نمایید&#13;&#10;&#13;&#10;مدرسه جهان تربیت</textarea>
                        <input id="example" name="example" class="badgebox" type="radio"></div>

                </div>
                <div class="col-lg-7">
                    <br>
                    <label> ارسال به:</label>

                    <select name="to[]" id="to" class="js-example-basic-single" multiple dir="rtl" required>

                        <option value="dabir"> همه ی دبیران</option>
                        <option value="parent">همه ی اولیا</option>
                        <option value="student">همه ی دانش آموزان</option>
                        @foreach($clacs as $claa)
                            <option value="{{$claa}}">کلاس{{$claa}}</option>
                        @endforeach
                        @foreach($allusers as $user)
                            <option value="{{$user->codemeli}}">{{$user->l_name}} - {{$user->f_name}}
                                - {{$user->role}}</option>
                        @endforeach

                    </select>

                </div>
                <br>
                <div class="col-lg-7">

                    <label>متن پیام:</label>
                    <label style="color: red">لطفا حداکثر 10 کلمه وارد نمایید.</label>
                    <br>
                    <textarea cols='85' rows='3' id="body" name="body">
                            </textarea>
                    <br>
                    <span style="color: red">                حداکثر 10 کلمه
</span>
                </div>
                <br>
                <div class="col-lg-7">

                    <label>لینک پیام:</label>
                    <br>
                    <input class="form-control" id="link" name="link" value="{{old('link')}}" autocomplete="off">
                </div>
                <br>
                <div class="col-md-12 col-lg-12">
                    <button class="btn btn-primary btn-block">ارسال پیام</button>
                </div>
            </form>
        </div>

    </div>



@endsection('content')