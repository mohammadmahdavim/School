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
               پیش ثبت نام ها
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">پیش ثبت نام ها</a></li>
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
            <a href="/admin/registration/downloadExcel"><button class="btn btn-info">دانلود اکسل</button></a>
            <div id='search' style="display: none">
                <form method="get" action="/admin/pre-registration">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <input class="form-control" id="name" name="name" value="{{request()->name}}"
                                   placeholder="نام را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="Fname" name="Fname" value="{{request()->Fname}}"
                                   placeholder="نام پدر را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="paye" name="paye" value="{{request()->paye}}"
                                   placeholder="پایه را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="codemeli" name="codemeli" value="{{request()->codemeli}}"
                                   placeholder="کد ملی را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input type="text" name="start_date" id="date-picker-shamsi-list"
                                   class="form-control text-right"
                                   value="{{request()->start_date}}" placeholder="تاریخ ثبت نام از ..."
                                   autocomplete="off">
                            <br>
                            <input class="form-control date-picker-shamsi" name="end_date"
                                   value="{{request()->end_date}}"
                                   placeholder="تاریخ ثبت نام تا ..." autocomplete="off">
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
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نام پدر</th>
                        <th>شماره همراه</th>
                        <th>پایه</th>
                        <th>تاریخ ثبت نام</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($data as $row)
                        <tr class="form-group" STYLE="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->f_name}}</td>
                            <td>{{$row->l_name}}</td>
                            <td>{{$row->Fname}}</td>
                            <td>{{$row->codemeli}}</td>
                            <td>{{$row->paye}}</td>
                            <td>{{$row->created_at->ToDateString()}}</td>
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


