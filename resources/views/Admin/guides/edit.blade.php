@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ویرایش خدمات روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">پیام مشاوره ای</li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <h5 class="card-title">ویرایش</h5>
                        </div>
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-1" style="text-align: left">
                            <a href="/admin/Guides/singlepage/{{$row->id}}">
                                <button class="btn btn-dark">برگشت</button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <form method="POST" action="/admin/Guides/update/{{$row->id}}" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="پیام مشاوره ای" readonly>
                        </div>
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" value="{{$row->title}}" required>
                        </div>

                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3">{!! $row->body !!}</textarea>
                            </div>
                        </div>
                        <br>


                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

            <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')

