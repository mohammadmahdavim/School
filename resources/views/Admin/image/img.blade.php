@extends('layouts.admin')

@section('content')
    <link href="/assets/dropzone.min.css" rel="stylesheet">
    <script src="/assets/dropzone.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
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

                آپلود تصویر برای مطلب
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">آپلود تصویر</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <form method="post" action="/admin/dropzone-image-upload" enctype="multipart/form-data"
                          class="dropzone" id="dropzone">
                        <label><b>انتخاب عکس</b></label>
                        <input name="id" value="{{$id}}" hidden>
                        @csrf
                        <div class="header-topinfo text-right">
                            <ul>
                                {{--<li><i class="fa fa-clock-o"></i>{{$rows->day}}:{{$rows->time}}</li>--}}

                                <a  href="/admin/Image/show" class="btn btn-primary btn-rounded btn-block">ثبت</a>

                            </ul>
                        </div>
                    </form>
                </div>
            </div>


@endsection('content')


