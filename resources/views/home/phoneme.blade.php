@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">تقاضای همکاری</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">تقاضای همکاری</a></li>
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
                                <img class="img-fluid" src="/assets/media/svg/login.svg" alt="...">
                            </div>

                            <div class="col-lg-6 offset-lg-1 p-t-25 p-b-10">
                                <div class="tm-callback">
                                    <h2>درخواست همکاری</h2>
                                    <p>
                                        اگر مایل به همکاری هستید ایمیل و شماره همراه خود را برای ما بگذارید.
                                    </p>
                                    <form action="/rtamas" class="tm-form" method="post">
                                        @csrf
                                        @include('errors')

                                        <div class="tm-form-inner">
                                            <div class="tm-form-field">
                                                <input id="email" name="email" type="text" placeholder="ایمیل را وارد کنید*"
                                                       required="">
                                            </div>
                                            <div class="tm-form-field">
                                                <select id="place" name="place">
                                                    <option value="a">دسته بندی را انتخاب کنید</option>
                                                    <option value="دبیر">دبیر</option>
                                                    <option value="مشاور">مشاور</option>
                                                    <option value="مسول بوفه">مسول بوفه</option>
                                                    <option value="غیره">غیره</option>
                                                </select>

                                            </div>
                                            <div class="tm-form-field tm-form-fieldhalf">
                                                <input id="phone" name="phone" type="text" placeholder="شماره تلفن*"
                                                       required="">
                                            </div>
                                            <div class="tm-form-field tm-form-fieldhalf">
                                                <input type="text" name="date1" id="date-picker-shamsi-list"
                                                       class="form-control text-right"
                                                       dir="ltr" value="{{old('date1')}}"
                                                       placeholder="تاریخ پیشنهادی برای برقرای تماس " autocomplete="off">
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


