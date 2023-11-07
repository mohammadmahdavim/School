@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>لیست حضورغیاب </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        لیست حضورغیاب</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body" style="padding-right: -10px">
            <form action="/admin/present_list">
                <div class="row">
                    <div class="col-md-3">
                        <label>از تاریخ</label>
                        <input class="form-control" name="date_from" id="date-picker-shamsi" autocomplete="off"
                               value="{{request()->date_from}}">
                    </div>
                    <div class="col-md-3">
                        <label>تا تاریخ</label>
                        <input class="form-control" name="date_to" id="date-picker-shamsi-new" autocomplete="off"
                               value="{{request()->date_to}}">
                    </div>
                    <div class="col-md-3">
                        <label>کلاس</label>
                        <select class="form-control" name="class">
                            <option></option>
                            @foreach($allclass as $clasR)
                                <option
                                    @if(request()->class==$clasR->id) selected @endif value="{{$clasR->id}}">{{$clasR->classnamber}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <button class="btn btn-info" type="submit">جستجو</button>
                    </div>
                </div>
            </form>

            <br>
            <div style="text-align: right">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr style="text-align: center">

                            <th>دبیر</th>
                            <th>کلاس</th>
                            <th>تاریخ</th>


                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @include('Admin.errors')
                        @foreach($rows as $row )
                            <tr style="text-align: center">
                                <td>{{$row->user->f_name}} {{$row->user->l_name}}</td>
                                <td>{{$row->class->classnamber}}</td>
                                <td>{{(\Morilog\Jalali\Jalalian::fromCarbon($row->created_at))->format('%A, %d %B')}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>




@endsection('content')
