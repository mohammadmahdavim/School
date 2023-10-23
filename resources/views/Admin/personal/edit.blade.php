@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ویرایش
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">پرسنل</li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ایجاد</h5>
                    <form  action="/admin/personals/update/{{$row->id}}" >

                        {{csrf_field()}}
                        @include('Admin.errors')
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6><label>کد ملی</label></h6>

                                    <input id="codemeli" name="codemeli" class="form-control  text-right"
                                           type="text"
                                           placeholder="اجباری" dir="ltr" value="{{$row->codemeli}}" readonly >
                                </div>
                                <div class="form-group">
                                    <h6><label>نام</label></h6>

                                    <input type="text" id="f_name" class="form-control  text-right" name="f_name"
                                           value="{{$row->f_name}}" placeholder="اجباری">
                                </div>
                                <div class="form-group">
                                    <h6><label>نام خانوادگی</label></h6>

                                    <input type="text" id="l_name" class="form-control  text-right" name="l_name"
                                           value="{{$row->l_name}}" placeholder="اجباری">
                                </div>

                                <div class="form-group">
                                    <h6><label>جنسیت</label></h6>
                                    <select type="text" id="sex" class="form-control  text-right" name="sex">
                                        <option @if($row->sex=='دختر') selected @endif>دختر</option>
                                        <option @if($row->sex=='پسر') selected @endif>پسر</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h6><label>نقش</label></h6>
                                    <select class="form-control" id="role" name="role">
                                        <option>{{$row->role}}</option>
                                        <option>معاون آموزشی</option>
                                        <option>معاون پرورشی</option>
                                        <option>مسول IT</option>
                                        <option>ناظم</option>
                                        <option>دفتر دار</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h6><label>ایمیل</label></h6>

                                    <input type="text" id="email" class="form-control  text-right" name="email"
                                           value="{{$row->email}}">
                                </div>

                                <div class="form-group">
                                    <h6><label>شماره همراه</label></h6>

                                    <input type="text" id="mobile" name="mobile" class="form-control"
                                           value="{{$row->mobile}}" autocomplete="off">
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
        </div>
    </div>
@endsection('content')

