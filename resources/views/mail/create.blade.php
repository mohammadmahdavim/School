@extends('layouts.'.$layout)
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

    <div class="card">
        <div class="card-body">
            <!-- Summernote editor -->
            <form method="POST" action="/mail/store" enctype="multipart/form-data">
                {{csrf_field()}}
                @include('Admin.errors')


                <div class="panel-body">
                    <div class="form-group col-md-6" style="text-align: center">
                        <button class="table-responsive btn btn-danger" style="font-family: Titr;text-align: center"><i
                                    class="icon-cross2"></i>باویرایش پیام، مخاطبین قبلی حذف شده واین پیام
                            فقط به مخاطبینی که الان انتخاب میکنید ارسال می گردد. <i class="icon-cross2"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                        <label>به:</label>

                        <select name="to[]" id="to" class="js-example-basic-single" multiple dir="rtl">

                            <option value="all">
                                همه ی اعضا سایت
                            </option>
                            <option value="dabir"> همه ی {{config('global.teachers')}}</option>
                            <option value="parent">همه ی {{config('global.parents')}}</option>
                            <option value="student">همه ی {{config('global.students')}}</option>
                            @foreach($claass as $claas)
                                <option value="{{$claas}}">کلاس{{$claas}}</option>
                            @endforeach
                            @foreach($allusers as $user)
                                <option value="{{$user->codemeli}}">{{$user->l_name}} - {{$user->f_name}}
                                    - {{$user->role}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group , col-md-7">
                        <br>
                        <label>عنوان پیام:</label>

                        <input class="form-control" type="text" id="subject"
                               name="subject" PLACEHOLDER="عنوان نامه را درج نمایید ... ">


                    </div>
                    <div class="form-group , col-md-7">
                        <br>
                        <label>پیوست پیام</label>

                        <input class="form-control" type="file" id="patchfile" name="patchfile">


                    </div>
                    <div class="col-md-12">
                        <div class="panel-body">
                            <br>
                            <label>متن پیام:</label>

                            <textarea id="editor-demo1" name="body">

                            </textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <button class="btn btn-primary btn-block">ارسال پیام</button>
                        </div>
                    </div>


                </div>
            </form>

        </div>

    </div>




    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- /summernote editor -->

    <!-- /footer -->


    <!-- /content area -->

    <!-- /main content -->
@endsection



<!-- /page container -->

</body>
</html>



