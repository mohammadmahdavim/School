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
            <h3>ایجاد پیام جدید</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">پیام ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ایجاد پیام جدید</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')


    <div class="card">
        <div class="card-body">
            <form method="POST" action="/admin/message">

                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <h6><label>مخاطب</label></h6>
                            <select class="js-example-basic-single" name="receiver[]" multiple>
                                <option>دانش آموز</option>
                                <option>دبیر</option>
                                <option>اولیا</option>
                                <option>بقیه اعضا</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6 style="color: #0b0b0b">توجه: <span style="color: red">فقط یک مودال می توانید ایجاد کنید. با ایجاد یک مودال پیام های قبلی از حالت مودال خارج می شوند.</span>
                            </h6>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="modal" id="customSwitch">
                                    <label class="custom-control-label" for="customSwitch">آیا این پیام مودال می
                                        باشد؟</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <br>
                            <h5 class="card-title">متن پیام</h5>
                            <textarea name="message" id="editor-demo1"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">

                    <br>
                    <button class="btn btn-primary" type="submit">ذخیره و ارسال
                    </button>


                </div>
            </form>
        </div>
    </div>


@endsection('content')


