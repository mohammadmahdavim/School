@extends('layouts.admin')
@section('css')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->

    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::sweet alert demo -->
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
            <h3>ایجاد</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">دورس</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="/admin/dars.store" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">

                    <div class="col-md-6">

                        <div class="center-text">
                            <br>
                            <h6><label>نام درس </label></h6>


                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">


                        </div>

                        <div class="center-text">
                            <br>
                            <h6><label>تعداد واحد</label></h6>


                            <input type="number" id="vahed" class="form-control" name="vahed"
                                   value="1">


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="center-text">
                            <br>
                            <h6><label>رشته </label></h6>


                            <select type="text" id="reshte" class="form-control" name="reshte">
                                <option>بدون رشته</option>
                                <option>ریاضی</option>
                                <option>تجربی</option>
                                <option>انسانی</option>
                                <option>هنرستان</option>
                                <option>مشترک ریاضی و تجربی</option>
                            </select>

                        </div>
                        <div class="center-text">
                            <br>
                            <h6><label>پایه</label></h6>

                            <select type="text" id="paye" class="form-control" name="paye">
                                <option></option>
                                @foreach($paye as $p)
                                    <option>{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="center-text">
                            <br>
                            <h6><label>تصویر</label></h6>

                            <input type="file" name="file">
                        </div>
                    </div>




                    <div class="form-group">

                        <br>
                        <button class="btn btn-primary" type="submit">ذخیره و ارسال
                        </button>


                    </div>
                </div>

                </form>

            </div>
        </div>








@endsection('content')
