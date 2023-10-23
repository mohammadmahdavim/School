@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <script type="text/javascript" src="/assets/js/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/js/form_multiselect.js"></script>


    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('content')

    <div class="page-header">
        <div>
            <h3>

                ایجاد {{$item->name}} جدید
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">{{$item->group}}</li>
                    <li class="breadcrumb-item active" aria-current="page"> ایجاد {{$item->name}} جدید
                    </li>
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
                    <form method="POST" action="/admin/selection/store" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <div class="row">
                            <div class="form-group">
                                <input class="form-control" hidden="hidden"
                                       name="selection_items_id" value="{{$item->id}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>عنوان</label>
                                <input type="text" class="form-control" id="title" value="{{old('title')}}"
                                       name="title" placeholder="عنوان را وارد کنید" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>مسول برگزاری</label>
                                <input type="text" class="form-control" id="manager" value="{{old('manager')}}"
                                       name="manager" placeholder="مسول برگزاری را وارد کنید" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاریخ برگزاری تا ..</label>
                                <input type="text" class="form-control" id="date-picker-shamsi" value="{{old('date')}}"
                                       autocomplete="off"
                                       name="date" placeholder="تاریخ برگزاری تا .. " required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>تعداد پاسخ دهی تا ..</label>
                                <input type="number" class="form-control" autocomplete="off"
                                       name="number" placeholder="تعداد پاسخ دهی تا .. " required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>تعداد برنده</label>
                                <input type="number" class="form-control" autocomplete="off"
                                       name="winner" placeholder="تعداد برنده " required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>کلاس ها</label>
                                <br>
                                <select name="class[]" class="multiselect-info"
                                        style="text-align: right"
                                        multiple="multiple">

                                    @foreach($class as $clas)
                                        <option value="{{$clas->classnamber}}"
                                        > کلاس {{$clas->classnamber}}  </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>اعضا</label>
                                <br>
                                <select name="users[]" class="multiselect-info"
                                        style="text-align: right"
                                        multiple="multiple">

                                    <option value="student">{{config('global.students')}}</option>
                                    <option value="parent">{{config('global.parents')}}</option>
                                    <option value="teacher">{{config('global.teachers')}}</option>
                                    <option value="other">سایر اعضا</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><b>انتخاب عکس</b></label>
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile[]" multiple>
                        </div>

                        <div class="form-group">
                            <label><h5>توضیحات</h5></label>
                            <textarea name="description" id="editor-demo3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')

