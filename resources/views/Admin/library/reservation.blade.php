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

@section('header')
    <div class="page-header">
        <div>
            <h3>
                رزرو کردن </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">رزرو کردن</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <input type='button' class="btn btn-primary" id='hideshow' value='جستجوی پیشرفته'>
            <div id='search' style="display: none">
                <form method="get" action="/admin/library/intrust">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <input class="form-control" id="issue" name="issue" value="{{request()->issue}}"
                                   placeholder="شماره کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="name" name="name" value="{{request()->name}}"
                                   placeholder="نام کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="user" name="user" value="{{request()->user}}"
                                   placeholder="امانت گیرنده کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <select name="tamdid" class="form-control">
                                <option>تمدید</option>
                                <option @if(request()->tamdid==1) selected @endif value="1">بله</option>
                                <option @if(request()->tamdid==2) selected @endif value="2">خیر</option>
                            </select>
                        </div>
                        <div class="p-2">
                            <input type="text" name="start_date" id="date-picker-shamsi-list"
                                   class="form-control text-right"
                                   value="{{request()->start_date}}" placeholder="تاریخ دریافت از ..."
                                   autocomplete="off">
                            <br>
                            <input class="form-control date-picker-shamsi" name="end_date"
                                   value="{{request()->end_date}}"
                                   placeholder="تاریخ دریافت تا ..." autocomplete="off">
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="media-body table-responsive">
                <form method="post" action="/admin/library/reservation/store">
                    @csrf
                    @include('errors')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">نام
                                کتاب:</label>
                            <input type="text" class="form-control"
                                   id="recipient-name" value="{{$row->name}}">
                        </div>
                        <div class="col-md-6">

                            <label for="recipient-name" class="col-form-label">شماره
                                کتاب:</label>
                            <input type="text" class="form-control"
                                   id="recipient-name" value="{{$row->issue}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                نویسنده:</label>
                            <input type="text" class="form-control"
                                   id="recipient-name" value="{{$row->author}}">
                            <input type="text" class="form-control"
                                   id="library_id" name="library_id" value="{{$row->id}}" hidden>
                        </div>
                        <div class="col-md-6">

                            <label for="recipient-name" class="col-form-label">
                                امانت گیرنده:</label>
                            <select class="js-example-basic-single form-control"
                                    name="user_id" dir="rtl">
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">{{$student->f_name}} {{$student->l_name}}
                                        -
                                        کلاس{{$student->class}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">ثبت رزور</button>
                        </div>
                    </div>
                </form>
                <div class="form-group row">
                    <div class="col-md-3">
                        <a href="/admin/library/index">
                            <button type="submit" class="btn btn-danger btn-block">انصراف</button>
                        </a>                    </div>
                </div>

            </div>
        </div>
    </div>


    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')
