@extends('layouts.admin')
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
            <h3>ایجاد کامنت</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">جلسات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد کامنت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="/admin/moshaver/comment/store" method="post">

                {{csrf_field()}}
                @include('Admin.errors')
                <input value="{{$user->id}}" name="user_id" hidden>
                <input value="{{$id}}" name="moshavereh_id" hidden>
                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">ایجاد
                        کامنت</h4>
                </div>
                <h4>{{$user->f_name}} {{$user->l_name}}</h4>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="media-body table-responsive">
                        <label> کامنت برای {{config('global.student')}}</label>
                        <textarea rows="10" cols="140" name="comment" id="editor-demo1">
                            @if($comment)
                                {!! $comment->comment !!}
                            @endif
                        </textarea>
                    </div>

                </div>
                <br>
                <div class="col-md-12">
                    <div class="media-body table-responsive">
                        <label> کامنت برای خودم</label>
<br>
                        <textarea rows="10" cols="140" name="commentme" id="editor-demo3">
                            @if($comment)
                                {!! $comment->commentme !!}
                            @endif
                        </textarea>
                    </div>

                </div>
                <br>
                <button class="btn btn-info" type="submit">ثبت کامنت
                </button>


            </form>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script>
        kamaDatepicker('date1', {buttonsColor: "red"});

        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: false
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "blue"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('date2', customOptions);

        kamaDatepicker('date3', {
            nextButtonIcon: "timeir_next.png"
            , previousButtonIcon: "timeir_prev.png"
            , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
        });

        // for testing sync functionallity
        $("#date2").val("1311/10/01");
    </script>
    <script type="text/javascript">
        $(".chosen").chosen();
    </script>
@endsection('content')


