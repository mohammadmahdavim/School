@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ویرایش اسلایدر روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">اسلایدر</li>
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
                            <a href="/admin/slider/singlepage/{{$row->id}}">
                                <button class="btn btn-dark">برگشت</button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <form method="POST" action="/admin/slider/update/{{$row->id}}" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="اسلایدر" hidden="hidden">
                        </div>
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" value="{{$row->title}}" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label>توضیحات کوتاه</label>
                            <input type="text" class="form-control" id="littlebody"
                                   name="littlebody" value="{{$row->little_body}}">
                        </div>
                        <div class="form-group">
                            <label><b>انتخاب و ایجاد تگ</b><br></label>
                            <br>
                            <select name="tag[]" id="tag" contenteditable="true" class="js-example-basic-single"
                                    multiple dir="rtl"
                            >
                                @foreach($tags as $tag)
                                    <option selected>{{$tag}}</option>
                                @endforeach
                                    @foreach(\App\CTags::all() as $tags)
                                        <option value="{{$tags->name}}">{{$tags->name}}</option>
                                    @endforeach
                                <option></option>
                            </select>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3">{!! $row->body !!}</textarea>
                            </div>
                        </div>
                        <br>
                        <h3>انتخاب عکس</h3>
                        <div class="row">

                            @foreach(\App\HomeImage::where('matlab_id',$row->id)->get() as $image)
                                <div class="custom-control custom-checkbox col-md-3">
                                    <img src="{{url('images/'.$image->resize_image)}}"
                                         class="img-fluid" alt="..." width="150"
                                         height="150">
                                    <input id="info" class="badgebox" type="checkbox" value="{{$image->id}}"
                                           name="image-{{$image->id}}" checked>

                                </div>
                                <br>

                            @endforeach
                        </div>
                        <br>
                        <div class="form-group">
                            <label><b> انتخاب عکس جدید</b><br>برای انتخاب چند عکس کافیست کلید ctrl کیبورد را نگه
                                دارید</label>
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile[]" multiple>
                        </div>


                        <br>

                        <br>
                        <br>

                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

            <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')

