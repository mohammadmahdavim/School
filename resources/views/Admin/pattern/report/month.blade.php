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
            <form action="/admin/pattern/report/month" method="post">
                {{csrf_field()}}
                <label> انتخاب ماه</label>

                <div class="row ">
                    <div class="col-md-3 ">
                        <select class="form-control" name="month">
                            <option @if($month=='07') selected @endif value="07">مهر</option>
                            <option @if($month=='08') selected @endif value="08">آبان</option>
                            <option @if($month=='09') selected @endif value="09">آذر</option>
                            <option @if($month=='10') selected @endif value="10">دی</option>
                            <option @if($month=='11') selected @endif value="11">بهمن</option>
                            <option @if($month=='12') selected @endif value="12">اسفند</option>
                            <option @if($month=='01') selected @endif value="01">فروردین</option>
                            <option @if($month=='02') selected @endif value="02">اردیبهشت</option>
                            <option @if($month=='03') selected @endif value="03">خرداد</option>
                            <option @if($month=='04') selected @endif value="04">تیر</option>
                            <option @if($month=='05') selected @endif value="05">مرداد</option>
                            <option @if($month=='06') selected @endif value="06">شهریور</option>
                        </select>

                    </div>
                    <div class="col-md-2 ">
                        <button class="btn btn-success">اعمال تاریخ</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>ردیف</th>
                        <th>تصویر</th>
                        <th>نام</th>
                        @foreach($dates as $date)
                            <th style="writing-mode: vertical-rl;padding: 0.15rem">{{$date}}</th>
                        @endforeach

                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $number = 0;
                    ?>
                    @foreach($answers as $key=>$answer)
                        <?php
                        $user = \App\User::where('id', $key)->first();
                        $number += 1;
                        ?>
                        <tr style="text-align: center">
                            <td>{{$number}}</td>
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->filename)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>

                                </div>
                            </td>
                            <td>{{$user->f_name}}-{{$user->l_name}}</td>
                            @foreach($dates as $date)
                                <td style="padding: 0.15rem">
                                    {{$answer->where('date',$date)->sum('time')}}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    </tbody>


                </table>

            </div>
        </div>

@endsection('content')


