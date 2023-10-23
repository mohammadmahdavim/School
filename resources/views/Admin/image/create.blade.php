@extends('layouts.admin')

@section('content')
    <link href="/assets/dropzone.min.css" rel="stylesheet">
    <script src="/assets/dropzone.min.js"></script>
    <script type="text/javascript">

        Dropzone.options.dropzone =
            {

                maxFilesize: 5,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                timeout: 5000,
                addRemoveLinks: false,

                removedfile: function (file) {

                    var name = file.upload.filename;
                    console.log(file);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/admin/dropzone-image-delete") }}',
                        data: {filename: name},
                        success: function (data) {
                            console.log("File deleted successfully!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                success: function (file, response) {

                },
                error: function (file, response) {
                    return false;
                }
            };
    </script>
    <div class="page-header">
        <div>
            <h3>

                ایجاد گالری جدید روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">گالری</li>
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
                    <form method="POST" action="/admin/Image/store" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="گالری تصویر" hidden="hidden">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" placeholder="عنوان را وارد کنید" required>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><b>انتخاب تگ</b><br></label>
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
                        <div class="header-topinfo text-right">
                            <ul>
                                <button type="submit" class="btn btn-primary btn-rounded btn-block">ثبت</button>

                            </ul>
                        </div>
                    </form>

                </div>
            </div>

    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')


