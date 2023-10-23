@extends('layouts.profile')
@section('css')
    <style>
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

    </style>

    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

    <!-- end::dataTable -->
@endsection('css')
@section('script')

    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')
@endsection('navbar')
@section('header')
    <div class="page-header">
        <div>
            <br>
            <h3>پروفایل</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if(auth()->user()->role=='دانش آموز' or auth()->user()->role=='اولیا')
                        <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    @elseif(auth()->user()->role=='معلم')
                        <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">پروفایل</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{url('/profile/update').'/'.auth()->user()->id}}" method="post"
                  enctype="multipart/form-data">
                {{csrf_field()}}
                @method('put')
                @include('Admin.errors')
                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px ">اطلاعات کاربری</h4>
                </div>
                <div class="gallery">
                    @if(auth()->user()->resizeimage)
                    <img src="{{url('uploads/'.$user->resizeimage)}}" alt="Cinque Terre" width="600" height="400">
                    @else
                        <img class="rounded-circle" src="/assets/profile/avatar.png"
                             alt="...">
                    @endif
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>

                <div class="row">


                    <div class=" col-md-6">
                        <br>
                        <div style="text-align: right">

                            <label style="text-align: right">آپلود عکس</label>
                        </div>
                        <input class="form-control" type="file" id="file" name="file">
                        <br>
                        <div style="text-align: right">
                            <label style="text-align: right">نقش </label>
                        </div>
                        <input style="text-align: center" class="form-control" type="text" id="role" name="role"
                               value="{{$user->role}}"
                               readonly>
                    </div>
                    <div class=" col-md-6">

                        <div style="text-align: right">
                            <br>
                            <label style="text-align: right">نام </label>
                        </div>
                        <input style="text-align: center" class="form-control" type="text" value="{{$user->f_name}}"
                               id="f_name"

                               name="f_name">
                        <br>
                        <div style="text-align: right">

                            <label style="text-align: right">نام خانوادگی </label>
                        </div>
                        <input style="text-align: center" class="form-control" type="text" value="{{$user->l_name}}"
                               id="l_name"
                               name="l_name">
                    </div>


                    <div class=" col-md-6">
                        <div style="text-align: right">
                            <br>
                            <label style="text-align: right">کد ملی</label>
                        </div>
                        <input style="text-align: center" class="form-control" type="text" value="{{$user->codemeli}}"
                               id="codemeli"
                               name="codemeli">
                        <br>
                        <div style="text-align: right">

                            <label style="text-align: right">موبایل</label>
                        </div>
                        <input style="text-align: center" class="form-control" type="text" value="{{$user->mobile}}"
                               id="mobile"
                               name="mobile">
                        <br>
                    </div>
                    <div class=" col-md-6">

                        <div style="text-align: right">
                            <br>

                            <label style="text-align: right">ایمیل</label>
                        </div>
                        <input style="text-align: center" class="form-control" type="text" value="{{$user->email}}"
                               id="email"
                               name="email">
                        <br>

                    </div>


                    <div class="form-group">

                        <br>
                        <div class="col-md-12 col-lg-12 text-body">
                            <br>
                            <button class="btn btn-primary ">ذخیره و ارسال</button>
                        </div>


                    </div>
                </div>

            </form>
        </div>
    </div>
    @if(auth()->user()->role=='معلم')
        <div class="card">
            <div class="card-body">
                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px ">ثبت برنامه</h4>
                </div>

                <form action="{{url('/profile/times').'/'.auth()->user()->id}}">
                    @method('put')
                    {{csrf_field()}}
                    @include('Admin.errors')
                    <div class="card">
                        <div class="card-header col-md-3" style="text-align: right">روزهای کاری من</div>
                        <div class="card-body col-md-4">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                @foreach($programs as $program)
                                    <div class="p-3 bd-highlight" style="font-size:medium;color:#FB2239">
                                        {!! $program->day !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-4">
                            <br>
                            <label>ثبت روزهای کاری جدید</label>
                            <select name="day[]" id="day" class="js-example-basic-single" multiple dir="rtl"
                            >

                                <option>شنبه</option>
                                <option>یکشنبه</option>
                                <option>دوشنبه</option>
                                <option>سه شنبه</option>
                                <option>چهار شنبه</option>
                                <option>پنج شنبه</option>
                            </select>

                        </div>

                        <div class=" col-md-4">
                            <br>

                            <label>ثبت ساعت موظفی</label>
                            <input style="text-align: center" type="number" name="time1"
                                   placeholder="لطفا ساعات حضور موظفی در مدرسه راوارد نمایید"
                                   class="form-control"
                                   value="{{\App\teacher::where('user_id',auth()->user()->id)->first()['time1']}}">
                        </div>
                        <div class=" col-md-4">
                            <br>

                            <label>ثبت ساعت غیر موظفی</label>
                            <input style="text-align: center" type="number" name="time2"
                                   placeholder="لطفا ساعات حضور غیر موظفی در مدرسه راوارد نمایید" class="form-control"
                                   value="{{\App\teacher::where('user_id',auth()->user()->id)->first()['time2']}}">
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <br>
                            <button class="btn btn-primary btn-block">ذخیره و ارسال</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <h4 class="panel-title" style="padding-top: 40px ">تغییر رمز عبور</h4>
            </div>
            <div class="panel-body">

                <form action="{{url('/profile/updatepassword').'/'.auth()->user()->id}}">

                    @method('put')

                    {{csrf_field()}}
                    @include('Admin.errors')
                    <div class="row">


                        <div class=" col-md-6">

                            <br>
                            <label>نام کاربری</label>
                            <input class="form-control" type="text" id="codemeli" name="codemeli"
                                   value="{{$user->codemeli}}" readonly>
                            <br>
                            <label>رمز عبور قبلی</label>
                            <input type="password" name="old_password" placeholder="" class="form-control" autocomplete="off">

                        </div>

                        <div class="col-md-6">
                            <br>
                            <label>رمز جدید</label>
                            <input type="password" name="new_password" placeholder="" class="form-control" autocomplete="off">
                            <br>
                            <label>تکرار رمز جدید</label>
                            <input type="password" name="confirm_password" placeholder="" class="form-control" autocomplete="off">

                        </div>

                        <div class="form-group">
                            <br>
                            <div class="col-md-12 col-lg-12">
                                <br>
                                <button class="btn btn-primary btn-block">ذخیره و ارسال</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')


