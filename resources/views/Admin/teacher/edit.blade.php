@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')

@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ویرایش {{config('global.teacher')}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش {{config('global.teacher')}}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection('header')

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="panel panel-flat">
                <div class="panel-body">
                    <div style="text-align: center">
                        <h3> ویرایش {{config('global.teacher')}}</h3>
                    </div>
                    <div style="text-align: left;padding-left: 10px">
                        <a href="/admin/teacher">
                            <button class="btn btn-rounded btn-outline-dark">صفحه
                                اطلاعات {{config('global.teachers')}}</button>
                        </a>
                    </div>
                    <form action="/admin/teacher/update/{{$user->id}}"  method="post"  enctype="multipart/form-data">
                                     {{csrf_field()}}

                        @include('Admin.errors')
                        <div class="gallery">
                            <figure class="avatar  avatar-state-success">
                                @if(!empty($user->filename))
                                    <img class="rounded-circle"
                                         src="{{url('uploads/'.$user->filename)}}"
                                         alt="...">
                                @else
                                    <img class="rounded-circle" src="/assets/profile/avatar.png"
                                         alt="...">
                                @endisset
                            </figure>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="center-text">
                                    <br>
                                    <h6><label>نام</label></h6>
                                    <input type="text" id="f_name" class="form-control" name="f_name"
                                           value="{{$user->f_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="center-text">
                                    <br>
                                    <h6><label>نام خانوادگی</label></h6>

                                    <input type="text" id="l_name" class="form-control" name="l_name"
                                           value="{{$user->l_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="center-text">
                                    <br>
                                    <h6><label>کد ملی</label></h6>
                                    <input type="text" id="codemeli" class="form-control" name="codemeli"
                                           value="{{$user->codemeli}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="center-text">
                                    <br>
                                    <h6><label>شماره تماس</label></h6>
                                    <input type="text" id="phone" class="form-control" name="phone"
                                           value="{{$user->mobile}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="center-text">
                                    <br>
                                    <h6><label>ایمیل</label></h6>
                                    <input type="text" id="email" class="form-control" name="email"
                                           value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="center-text">
                                    <br>
                                    <h6><label>تصویر</label></h6>
                                    <input type="file"  class="form-control" name="file">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-left">
                                <div class="form-group , col-md-12">

                                    <br>
                                    <button class="btn btn-info btn-block" type="submit">ذخیره و ارسال
                                    </button>

                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')


@endsection('content')
