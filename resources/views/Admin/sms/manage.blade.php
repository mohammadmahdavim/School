@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>مدیریت پیام کوتاه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت پیام کوتاه</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div style="text-align: left">
                <button class="btn btn-success">اعتبار پیامکی</button>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-9" style="text-align: right">
            <button class="btn btn-primary">
                میزان اعتبار: 100000 تومان
            </button>
                </div>
                <div class="col-md-3" style="text-align: left">
                    <button class="btn btn-outline-dark" style="text-align: left">دریافت اکسل پیام ها
                    </button></div>
            </div>
            <br>
            <br>
            <button class="btn btn-warning">
                تعداد پیام ارسال شده: 215 پیام
            </button>
            <br>
            <br>
            <button class="btn" style="background-color: forestgreen">
                تعداد پیام ارسال شده موفق: 198 پیام
            </button>
            <br>
            <br>
            <button class="btn" style="background-color: firebrick">
                تعداد پیام ارسال شده ناموفق: 17 پیام
            </button>
            <br>
            <hr>
            <div style="text-align: center">
                <h5>افزایش اعتبار</h5>
            </div>
            <div style="text-align: left"><a href="/admin/sms/history"><button class="btn btn-outline-dark">تاریخچه پرداخت
                </button></a></div>
            <br>

            <div class="row">
                <div class="col-12 default-wallet">
                    <div class="form-account-row mb-cs">
                        <div class="checkout-paymethod-providers">
                            <label class="">
                                                                <span class="ui-radio">
                                                                    <input type="radio" name="bank_id" value="5">
                                                                    <span class="ui-radio-check"></span>
                                                                </span>
                                <span class="checkout-paymethod-source-title">30 هزار
                                                                    تومان</span>
                            </label>
                            <label class="">
                                                                <span class="ui-radio">
                                                                    <input type="radio" name="bank_id" value="4">
                                                                    <span class="ui-radio-check"></span>
                                                                </span>
                                <span class="checkout-paymethod-source-title">50 هزار
                                                                    تومان</span>
                            </label>
                            <label class="">
                                                                <span class="ui-radio">
                                                                    <input type="radio" name="bank_id" value="5">
                                                                    <span class="ui-radio-check"></span>
                                                                </span>
                                <span class="checkout-paymethod-source-title">80 هزار
                                                                    تومان</span>
                            </label>
                        </div>
                    </div>
            </div>

            <br>
            <div class="col-md-12"><input class="form-control" style="text-align: center" id="payment" name="payment"
                                          placeholder="مبلغ دلخواه را به تومان وارد نمایید."></div>
           <br>
            <div class="col-md-12 col-lg-12">
                <button class="btn btn-primary btn-block">ثبت و پرداخت</button>
            </div>
        </div>
    </div>




@endsection('content')