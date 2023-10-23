@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ایجاد راهنمای جدید روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">پیام مشاوره ای</li>
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
                    <form method="POST" action="/admin/Guides/store" enctype="multipart/form-data">
                        @csrf
                        @include('errors')

                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="پیام مشاوره ای" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" placeholder="عنوان را وارد کنید" required>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')

