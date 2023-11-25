@extends('layouts.student')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
@endsection('css')
@section('script')
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    @include('sweet::alert')
    <script>
        jQuery(document).ready(function () {
            jQuery('#hideshow').on('click', function (event) {
                jQuery('#search').toggle('show');
            });
        });
    </script>
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>پرداخت شده</th>
                        <th>دریافت شده</th>
                        <th>رزرو برای تاریخ</th>
                        <th>کد رزرو</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>

                            <td style="text-align: center">{{$row->product->title}}</td>
                            <td style="text-align: center">{{$row->product->price}}</td>
                            <td>
                                @if($row->payed==1)
                                    بله
                                @else
                                    خیر
                                @endif
                            </td>
                            <td>
                                @if($row->used==1)
                                    بله
                                @else
                                    خیر
                                @endif
                            </td>
                            <td>
                                {{$row->for_date}}
                            </td>
                            <td>
                                {{$row->code}}
                            </td>
                    </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')


