@extends('layouts.profile')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

    <!-- end::dataTable -->
@endsection('css')
@section('script')


    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
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
            <br>
            <h3>ایجاد پیام</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="/mails/inbox">پیام ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد پیام</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
<!-- Page container -->
<div class="card">
    <div class="card-body">
                <!-- Summernote editor -->
                    <form method="post" action="{{url('/mail/forwardto').'/'.$mail->id}}" enctype="multipart/form-data">
                        @method('put')

                        {{csrf_field()}}
                        @include('Admin.errors')







                                    <div class="panel-body">
                                        <div class="row">
                                        <div class="form-group , col-md-6">
                                            <label>به:</label>

                                            <select name="to[]" id="to" class="js-example-basic-single" multiple dir="rtl">


                                                @foreach($allusers as $user)
                                                    <option value="{{$user->id}}">{{$user->l_name}} - {{$user->f_name}}
                                                        - {{$user->role}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group , col-md-6">
                                            <label>عنوان پیام:</label>

                                            <input class="form-control" type="text" id="subject"
                                                   name="subject" PLACEHOLDER="عنوان نامه را درج نمایید ..."
                                                   value="{{$mail->subject}}" style="text-align: center" readonly>


                                        </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <button class="btn btn-primary btn-block">ارسال پیام</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                    <script src="/js/sweetalert.min.js"></script>
                @include('sweet::alert')
                <!-- /summernote editor -->


    @endsection




