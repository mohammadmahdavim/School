@extends('layouts.student')
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
            <form action="/student/pattern/sabt" method="post">
                {{csrf_field()}}
                <input name="pattern" value="{{$pattern->id}}" hidden>
                <label> انتخاب تاریخ</label>

                <div class="row text-center justify-content-md-center">
                    <div class="col-md-3 m-t-b-20">
                        <input style="text-align: center" type="text" name="date" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{$date}}" required autocomplete="off"></div>
                    <div class="col-md-2 m-t-b-20">
                        <button class="btn btn-success">اعمال روز</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <form action="/student/pattern/sabt/dars" method="post">
                {{csrf_field()}}
                <input name="pattern" value="{{$pattern->id}}" hidden>
                <input name="date" value="{{$date}}" hidden>
                <table class="table  table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>درس</th>
                        <th>زمان</th>
                        <th>نوع مطالعه</th>
                        <th>توضیحات</th>

                    </tr>
                    </thead>

                    <tbody>

                    @foreach($doros as $dars)
                        <tr style="text-align: center">
                            <td>{{$dars->name}}</td>
                            <td>
                                <input type="number" class="form-control" name="time[{{$dars->id}}]"
                                       value="{{$answers->where('dars_id',$dars->id)->pluck('time')->first()}}"
                                       placeholder="زمان(دقیقه)    ">
                            </td>

                            <td>
                                <select class="form-control" name="status[{{$dars->id}}]">
                                    @foreach($statuses as $status)
                                        <option
                                            @if($answers->where('dars_id',$dars->id)->pluck('status')->first()==$status->id) selected
                                            @endif value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </td>


                            <td><input class="form-control" name="description[{{$dars->id}}]"
                                       value="{{$answers->where('dars_id',$dars->id)->pluck('description')->first()}}"
                                       placeholder="توضیحات"></td>

                        </tr>
                    @endforeach

                    </tbody>


                </table>
                <br>
                <button class="btn btn-block btn-primary" type="submit">ثبت و ویرایش</button>
            </form>
        </div>
    </div>

@endsection('content')


