@extends('layouts.teacher')
@section('css')

@endsection('css')
@section('script')
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="/class/update/{{$row->id}}">
                <div class="form-group col-md-10 responsive">
                    <br>
                    <label>توضیحات </label>
                    <br>
                    <textarea id="editor-demo1" name="description"
                    >{!! $row->description !!}</textarea>
                </div>

                <div class="form-group , col-md-10">
                    <br>
                    <label>آپلود فایل </label>
                    <input type="file" id="file" name="file" class="form-control" value="{{old('file')}}">
                </div>


                <div class="form-group , col-md-12">

                    <br>
                    <button class="btn btn-info" type="submit">ثبت
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection('content')

