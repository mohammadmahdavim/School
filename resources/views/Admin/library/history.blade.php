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
    <div class="page-header">
        <div>
            <h3>
                تاریخجه امانت ها
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تاریخچه امانت ها</li>
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
            <input type='button' class="btn btn-primary" id='hideshow' value='جستجوی پیشرفته'>
            <div id='search' style="display: none">
                <form method="get" action="/admin/library/intrust">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <input class="form-control" id="issue" name="issue" value="{{request()->issue}}"
                                   placeholder="شماره کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="name" name="name" value="{{request()->name}}"
                                   placeholder="نام کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="user" name="user" value="{{request()->user}}"
                                   placeholder="امانت گیرنده کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <select name="tamdid" class="form-control">
                                <option>تمدید</option>
                                <option @if(request()->tamdid==1) selected @endif value="1">بله</option>
                                <option @if(request()->tamdid==2) selected @endif value="2">خیر</option>
                            </select>
                        </div>
                        <div class="p-2">
                            <input type="text" name="start_date" id="date-picker-shamsi-list"
                                   class="form-control text-right"
                                   value="{{request()->start_date}}" placeholder="تاریخ دریافت از ..."
                                   autocomplete="off">
                            <br>
                            <input class="form-control date-picker-shamsi" name="end_date"
                                   value="{{request()->end_date}}"
                                   placeholder="تاریخ دریافت تا ..." autocomplete="off">
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>
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
                        <th>تاریخ برگشت</th>
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
                                @if($row->back){{$row->back}}
                                @else
                                    <span style="color: red">برگشت نداده</span>
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


