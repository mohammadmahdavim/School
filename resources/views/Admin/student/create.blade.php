@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
@endsection('css')
@section('script')
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ایجاد {{config('global.student')}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="/admin/students.store">

                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <h6><label>کد ملی</label></h6>

                            <input id="codemeli" name="codemeli" class="form-control form-control-lg text-right"
                                   type="text"
                                   placeholder="اجباری" dir="ltr" value="{{old('codemeli')}}">
                        </div>
                        <div class="form-group">
                            <h6><label>نام</label></h6>

                            <input type="text" id="f_name" class="form-control form-control-lg text-right" name="f_name"
                                   value="{{old('f_name')}}" placeholder="اجباری">
                        </div>
                        <div class="form-group">
                            <h6><label>نام خانوادگی</label></h6>

                            <input type="text" id="l_name" class="form-control form-control-lg text-right" name="l_name"
                                   value="{{old('l_name')}}" placeholder="اجباری">
                        </div>

                        <div class="form-group">
                            <h6><label>پایه</label></h6>
                            <select type="text" id="paye" class="form-control form-control-lg text-right" name="paye">
                                <option></option>
                                @foreach($paye as $p)
                                    <option>{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <h6><label>جنسیت</label></h6>
                            <select type="text" id="sex" class="form-control form-control-lg text-right" name="sex">
                                <option></option>
                                <option>دختر</option>
                                <option>پسر</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <h6><label>شماره {{config('global.student')}}ی</label></h6>

                            <input type="text" id="shomarande" class="form-control form-control-lg text-right"
                                   name="shomarande"
                                   value="{{old('shomarande')}}">
                        </div>
                        <div class="form-group">
                            <h6><label>نام پدر</label></h6>

                            <input type="text" id="Fname" class="form-control form-control-lg text-right" name="Fname"
                                   value="{{old('Fname')}}">
                        </div>
                    </div>
                    <div class="col-md-6">



                        <input type="hidden" class="form-control form-control-lg text-right" id="role" name="role"
                               value="دانش آموز">

                        <div class="form-group">
                            <h6><label>ایمیل</label></h6>

                            <input type="text" id="email" class="form-control form-control-lg text-right" name="email"
                                   value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <h6><label>موبایل</label></h6>

                            <input type="text" id="mobile" class="form-control form-control-lg text-right" name="mobile"
                                   value="{{old('mobile')}}">
                        </div>
                        <div class="form-group">
                            <h6><label>موبایل پدر</label></h6>

                            <input type="text" id="mobile_father" class="form-control form-control-lg text-right" name="mobile_father"
                                   value="{{old('mobile_father')}}">
                        </div>
                        <div class="form-group">
                            <h6><label>موبایل مادر</label></h6>

                            <input type="text" id="mobile_mother" class="form-control form-control-lg text-right" name="mobile_mother"
                                   value="{{old('mobile_mother')}}">
                        </div>
                        <div class="form-group">
                            <h6><label>کلاس</label></h6>

                            <select type="text" id="classnamber" class="form-control form-control-lg text-right"
                                    name="classnamber">
                                <option></option>
                                @foreach($claass as $claasss)
                                    <option>{{$claasss}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <h6><label>تاریخ تولد</label></h6>

                            <input type="text" id="date-picker-shamsi" name="date1" class="form-control "
                                   dir="ltr"
                                   value="{{old('birthday')}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <h6><label>آدرس</label></h6>

                        <input type="text" id="address" class="form-control form-control-lg text-right" name="address"
                               value="{{old('address')}}">
                    </div>
                    <div class="form-group col-md-12">
                        <h6><label>توضیحات</label></h6>

                        <input type="text" id="description" class="form-control form-control-lg text-right" name="description"
                               value="{{old('description')}}">
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
