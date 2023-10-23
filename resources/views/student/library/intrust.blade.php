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
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>
                نمایش کتابخانه
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کتاب های در دست امانت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>شماره کتاب</th>
                        <th>نام</th>
                        <th>امانت گیرنده</th>
                        <th>تمدید کرده؟</th>
                        <th>تاریخ دریافت</th>
                        <th>مهلت برگشت</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($data as $row)
                        <tr class="form-group" STYLE="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->issue}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->f_name}}-{{$row->l_name}}</td>
                            <td>
                                @if($row->count==1 )
                                    بله
                                @else
                                    خیر
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                            <td>
                                @if(($row->expire) >= $date)

                                    <button type="text"
                                            class="btn btn-success"
                                    >{{getexpire($row->expire)}}
                                    </button>
                                @else
                                    <button type="text"
                                            class="btn btn-danger"
                                    >{{getexpire($row->expire)}}
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>
@endsection('content')

<?php
function getexpire($expire)
{

    $date = explode('-', $expire);
    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
    $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
    $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
    $nowTimestamp = \Morilog\Jalali\Jalalian::forge("now")->getTimestamp();

    if ($dateEx >= $nowTimestamp) {

        $time = $dateEx - time(); // to get the time since that moment

        return floor($time / 86400) . 'روز مانده';
    } else {

        $time = time() - $dateEx; // to get the time since that moment


        return floor($time / 86400) . ' روز گذشته';
    }

}

?>