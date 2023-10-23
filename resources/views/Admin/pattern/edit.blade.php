@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

@endsection('css')
@section('script')
    <script type="text/javascript" src="/assets/js/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/js/form_multiselect.js"></script>


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
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ویرایش الگو</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">الگو</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/pattern/update/{{$row->id}}" method="post" >
                {{csrf_field()}}
                @include('Admin.errors')
                <div style="text-align: center">
                    <h3 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                        ویرایش الگو
                    </h3>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <br>

                        <label>عنوان </label>
                        <br>
                        <input style="text-align: center" type="text" id="name" name="name"
                               class="form-control" value="{{$row->name}}">
                    </div>
                    <div class=" col-md-2" id="selectclass">
                        <br>
                        <label> کلاس </label>
                        <select id="rowteacher" name="class_id"
                                class="form-control">
                            @foreach($allclas as $allclass)
                                <option @if($row->class_id==$allclass->classnamber) selected
                                        @endif style="text-align: right" value="{{$allclass->classnamber}}">
                                    کلاس {{$allclass->classnamber}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col-md-3">
                        <br>

                        <label>تاریخ شروع</label>
                        <input style="text-align: center" type="text" name="date_from" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{$row->date_from}}" required autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <br>

                        <label>تاریخ پایان</label>
                        <input style="text-align: center" type="text" name="date-picker-shamsi-list" id=""
                               class="form-control text-right"
                               dir="ltr" value="{{$row->date_to}}" required autocomplete="off">
                    </div>
                    <div class="col-md-12 ">
                        <br>
                        <button class="btn btn-block btn-info">ویرایش الگو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection('content')
<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<script>
    function check() {
        var checkBox = document.getElementById("customSwitch");
        var selectclass = document.getElementById("selectclass");
        var selectstudent = document.getElementById("selectstudent");
        if (checkBox.checked == true) {

            selectstudent.style.display = "block";
            selectclass.style.display = "none";
        } else {
            selectstudent.style.display = "none";
            selectclass.style.display = "block";
        }
    }
</script>
