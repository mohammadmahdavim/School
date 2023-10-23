@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ویرایش  مطلب روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">مشاوران</li>
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
                            <a href="/admin/Consultants/singlepage/{{$row->id}}">
                                <button class="btn btn-dark">برگشت</button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <form method="POST" action="/admin/Consultants/update/{{$row->id}}" enctype="multipart/form-data">
                        @csrf
                        @include('errors')

                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="{{$row->place}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>نام و نام خانوادگی</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" value="{{$row->title}}" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label>  سمت و یا عکس</label>
                            <input type="text" class="form-control" id="littlebody"
                                   name="littlebody" value="{{$row->little_body}}">
                        </div>


                        {{--<div class="card">--}}
                            {{--<div class="card-body">--}}
                                {{--<h5 class="card-title">متن</h5>--}}
                                {{--<textarea name="body" id="editor-demo3">{!! $row->body !!}</textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}
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
                            {{--<label><b> انتخاب عکس جدید</b><br>برای انتخاب چند عکس کافیست کلید ctrl کیبورد را نگه--}}
                            {{--دارید</label>--}}
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile[]">
                        </div>

                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

            <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')

