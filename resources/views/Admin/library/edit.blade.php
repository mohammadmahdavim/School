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
                ویرایش کتاب جدید
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش کتاب جدید</li>
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
            <div class="media-body table-responsive">
                <form method="post" action="/admin/library/update/{{$library->id}}">
                    @csrf
                    @include('errors')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-form-label">نام
                                کتاب:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{$library->name}}">
                        </div>
                        <div class="col-md-6">

                            <label for="recipient-name" class="col-form-label">شماره
                                کتاب:</label>
                            <input type="text" class="form-control" id="issue" name="issue"
                                   value="{{$library->issue}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                نویسنده:</label>
                            <input type="text" class="form-control" id="author" name="author"
                                   value="{{$library->author}}">

                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                تعداد:</label>
                            <input type="text" class="form-control" id="count" name="count"
                                   value="{{$library->count}}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                ناشر:</label>
                            <input type="text" class="form-control" id="publisher" name="publisher"
                                   value="{{$library->publisher }}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">   ذخیره و ویرایش</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')
