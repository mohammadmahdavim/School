@extends('layouts.teacher')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

@endsection('css')
@section('script')
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

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
            <form action="/teacher/mark/date" method="post">
                {{csrf_field()}}
                <input name="class" value="{{$class}}" hidden>
                <input name="dars" value="{{$dars}}" hidden>
                <label> انتخاب روز برای نمره دهی</label>

                <div class="row text-center justify-content-md-center">
                    <div class="col-md-3 m-t-b-20">
                        <input style="text-align: center" type="text" name="date" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date')}}" required autocomplete="off"></div>
                    <div class="col-md-2 m-t-b-20">
                        <button class="btn btn-success">اعمال روز</button>
                    </div>
                </div>
            </form>
            <div id="karnamehrender">

            </div>

        </div>

    </div>
@endsection('content')


