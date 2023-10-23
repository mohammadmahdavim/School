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
            <h3>سخن مدیر</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت صفحه اول سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سخن مدیر</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center">سخن مدیر</h5>
                    <form method="POST" action="/admin/converse/store" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('errors')
                        <input name="place" value="سخن مدیر" hidden>
                        <input name="title" value="سخن مدیر" hidden>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo1">
                                    @if($data)
                                        {!! $data->body !!}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                        @if(!empty(\App\HomeImage::where('matlab_id',$data->id)->first()['resize_image']) )
                            <?php
                            $img = \App\HomeImage::where('matlab_id', $data->id)->orderby('created_at', 'desc')->first();
                            ?>
                            <img src="{{url('images/'.$img->resize_image)}}" alt="Cinque Terre" width="80"
                                 height="80">

                        @endif
                        <div class="form-group">
                            <label><b>انتخاب عکس</b></label>
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile" >
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
