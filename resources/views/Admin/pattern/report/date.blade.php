@extends('layouts.admin')
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
            <form action="/admin/pattern/report/daily" method="post">
                {{csrf_field()}}
                <label> انتخاب تاریخ</label>

                <div class="row ">
                    <div class="col-md-3 ">
                        <input style="text-align: center" type="text" name="date_from" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date_from')}}" required autocomplete="off">
                    </div>

                    <div class="col-md-3 ">

                        <input style="text-align: center" type="text" name="date_to" id="date-picker-shamsi-new"
                               class="form-control text-right"
                               dir="ltr" value="{{old('date_to')}}" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2 m-t-b-20">
                    <button class="btn btn-success">اعمال تاریخ</button>
                </div>
        </form>

        </div>
    </div>
@endsection('content')


