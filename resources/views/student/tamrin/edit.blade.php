@extends('layouts.student')
@section('css')

@endsection('css')
@section('script')
    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->
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
            <h3> ارسال تکلیف {{\App\Tamrin::where('id',$tamrin_id)->first()['title']}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تکالیف</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ارسال تکلیف</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="/student/jtamrin.store{{$tamrin_id}}" enctype="multipart/form-data">
                {{csrf_field()}}
                @include('Admin.errors')

                <div class="col-md-6">
                    <div class="center-text">
                        <h6><label>شماره کلاس </label></h6>
                        <input class="form-control" type="number" id="class" name="class" readonly
                               value="{{$class_id}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="center-text">
                        <br>
                        <h6><label> درجه سختی سوال از نظر من</label></h6>

                        <select class="browser-default custom-select form-control" id="daraje" name="daraje">
                            <option value="{{$jtamrin->daraje}}" selected>{{$jtamrin->daraje}}</option>
                            <option value="سخت">سخت</option>
                            <option value="متوسط">متوسط</option>
                            <option value="آسان">آسان</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <br>
                        <h6><label> توضیحات من</label></h6>
                        <textarea id="editor-demo1" name="description"
                                  class="summernote">{!! $jtamrin->description !!}</textarea>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="center-text">
                        <br>
                        <h6><label>آپلود جواب </label></h6>
                        <input class="form-control" type="file" id="file" name="file" value="{{old('file')}}">
                    </div>
                </div>

                <div class="form-group , col-md-12">

                    <br>
                    <button class="btn btn-info" type="submit">ارسال و ویرایش جواب
                    </button>

                </div>
                <br>


            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')


