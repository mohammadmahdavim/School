@extends('layouts.admin')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <div class="page-header">
        <div>
            <h3>

                ایجاد اسلایدر جدیر روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">اسلایدر</li>
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
                    <form method="POST" action="/admin/slider/store" enctype="multipart/form-data"
                          >

                        @csrf
                        @include('errors')
                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="اسلایدر" hidden>
                        </div>
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" placeholder="عنوان را وارد کنید" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label>توضیحات کوتاه</label>
                            <input type="text" class="form-control" id="littlebody"
                                   name="littlebody" placeholder="توضیحات کوتاه را وارد کنید" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label><b>انتخاب عکس</b><br>برای انتخاب چند عکس کافیست کلید ctrl کیبورد را نگه دارید</label>
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile[]" multiple>
                        </div>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><b>انتخاب و ایجاد تگ</b><br></label>
                            <br>
                            <select name="tag[]" id="tag" contenteditable="true" class="js-example-basic-single"
                                    multiple dir="rtl"
                            >
                                <option></option>
                                @foreach(\App\CTags::all() as $tags)
                                <option value="{{$tags->name}}">{{$tags->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')

