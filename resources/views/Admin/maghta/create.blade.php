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
                    <li class="breadcrumb-item"><a href="#">کلاس</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')



    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title">ایجاد</h5>
                    <form method="POST" action="/admin/class.store">
                        {{csrf_field()}}
                        @include('Admin.errors')
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>مقطع </label></h6>


                                <select type="text" id="magta" class="form-control" name="magta">
                                    <option>ابتدایی</option>
                                    <option>متوسطه1</option>
                                    <option>متوسطه2</option>
                                    <option>هنرستان</option>
                                    <option>آموزشگاه</option>
                                    <option>دانشگاه</option>
                                    <option>باشگاه</option>
                                </select>

                            </div>
                        </div>
                        <br>
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>رشته </label></h6>


                                <select type="text" id="reshte" class="form-control" name="reshte">
                                    <option>بدون رشته</option>
                                    <option>ریاضی</option>
                                    <option>تجربی</option>
                                    <option>انسانی</option>
                                    <option>هنرستان</option>
                                </select>

                            </div>
                        </div>
                        <br>
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>پایه</label></h6>

                                <select type="text" id="paye" class="form-control" name="paye">
                                    <option></option>
                                    @foreach($paye as $p)
                                        <option>{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>شماره کلاس </label></h6>
                                <input type="text" id="classnamber" class="form-control" name="classnamber">


                            </div>
                        </div>

                        <br>
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>توضیحات</label></h6>

                                <input type="text" id="discription" class="form-control" name="discription"
                                       value="{{old('discription')}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input type="hidden">
                        </div>
                        <br>
                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary">ذخیره و ارسال</button>


                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')



@endsection('content')
