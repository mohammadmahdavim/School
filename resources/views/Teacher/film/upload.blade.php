@extends('layouts.teacher')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ارسال مطلب</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مطلب ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ارسال مطلب</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/teacher/uploadfilm.store" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                @method('put')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">آپلود
                        مطلب</h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="form-group , col-md-6" style="padding-right: 20px">
                    <div class="custom-control custom-switch">
                        <input onclick="check()" name="archive" type="checkbox" class="custom-control-input"
                               id="customSwitch">
                        <label class="custom-control-label" for="customSwitch">قرار گرفتن در آرشیو</label>
                    </div>
                </div>
                <div class="row">


                    <div class=" col-md-6">
                        <br>
                        <label>نام دبیر</label>
                        <input
                            class="form-control"
                            type="text" id="techername" name="techername"
                            value="{!!  auth()->user()->f_name!!}-{!!  auth()->user()->l_name!!}" readonly>
                        <br>
                        <label>فصل </label>
                        <input name="chapter" id="chapter" class="form-control text-right"
                               dir="ltr" value="{{$section->section}}"
                               required>
                    </div>


                    <div class=" col-md-6" id="selectclass">
                        <br>
                        <label>درس </label>
                        <select id="rowteacher" name="dars_id"
                                class="form-control">

                            @foreach($allclas as $allclass)
                                <option style="text-align: right" value="{{$allclass->darss[0]->id}}">
                                    درس {{$allclass->darss[0]->name}}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <label> کلاس ها </label>
                        <select id="rowteacher" name="class[]" multiple
                                class="js-example-basic-single form-control">
                            @foreach($allclas->UNIQUE('class_id') as $allclass)
                                <option style="text-align: right" value="{{$allclass->class[0]->classnamber}}">
                                    کلاس {{$allclass->class[0]->classnamber}}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group , col-md-6">
                        <br>
                        <label>بخش </label>
                        <select name="bakhsh" id="bakhsh" class="form-control text-right">
                            @foreach($bakhshs as $bakhsh)
                                <option>{{$bakhsh->bakhsh}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group , col-md-6">
                        <br>
                        <label>عنوان فیلم </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}">
                    </div>
                    <br>

                    <div class="form-group , col-md-10">
                        <br>
                        <br>
                        <h4 style="color: darkred">آیا مطلب توسط خود دبیر تهیه گردیده است؟ </h4>
                        <input type="radio" id="auther" name="auther"
                               class="checkbox" value="1">
                        <span class="ui-radio-check">بله مطلب را خودم تهیه کردم.</span>
                        <br>
                        <input type="radio" id="auther" name="auther"
                               class="checkbox" value="0" checked>
                        <span class="ui-radio-check">خیر، ولی از سایت معتبر یا دبیر  تایید شده بنده تهیه شده است.</span>

                    </div>
                    <div class="form-group col-md-10 responsive">
                        <br>
                        <label>لینک(درصورت نیاز) </label>
                        <br>
                        <input id="link" name="link" value="{{old('link')}}" class="form-control"
                        >
                    </div>
                    <div class="form-group col-md-10 responsive">
                        <br>
                        <label>توضیحات(درصورت نیاز) </label>
                        <br>
                        <textarea id="editor-demo1" name="description"
                        >{{old('description')}}</textarea>
                    </div>

                    <div class="form-group , col-md-10">
                        <br>
                        <label>آپلود فایل </label>
                        <input type="file" id="file" name="file" class="form-control" value="{{old('file')}}"
                        >
                    </div>
                    <div class="form-group , col-md-12">

                        <br>
                        <button class="btn btn-info" type="submit">ارسال مطلب
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script type="text/javascript">
        $(".chosen").chosen();
    </script>
@endsection('content')


<script>
    function check() {
        var checkBox = document.getElementById("customSwitch");
        var selectclass = document.getElementById("selectclass");
        if (checkBox.checked == true) {

            selectclass.style.display = "none";
        } else {
            selectclass.style.display = "block";
        }
    }
</script>
