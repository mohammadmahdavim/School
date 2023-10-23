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
                امانت دادن
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">امانت دادن</li>
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
                <form method="post" action="/admin/library/trust/store">
                    @csrf
                    @include('errors')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-form-label">نام
                                کتاب:</label>
                            <input type="text" class="form-control"
                                   value="{{$row->name}}">
                        </div>
                        <div class="col-md-6">

                            <label for="recipient-name" class="col-form-label">شماره
                                کتاب:</label>
                            <input type="text" class="form-control"
                                   value="{{$row->issue}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                نویسنده:</label>
                            <input type="text" class="form-control"
                                   value="{{$row->author}}">
                            <input name="library_id" type="text" class="form-control"
                                   value="{{$row->id}}" hidden>
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
                            <button type="submit" class="btn btn-primary btn-block"> ثبت امانت</button>
                        </div>
                    </div>
                </form>
                <div class="form-group row">
                    <div class="col-md-3">

                        <a href="/admin/library/index">
                            <button type="submit" class="btn btn-danger btn-block">انصراف</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')
