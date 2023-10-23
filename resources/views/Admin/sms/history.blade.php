@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>تاریخچه پرداخت ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تاریخچه پرداخت ها</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="media-body">
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr>
                        <th>شمارنده</th>
                        <th>تاریخ پرداخت</th>
                        <th>مبلغ پرداخت</th>
                        <th>وضعیت</th>

                    </tr>
                    </thead>
                    <tbody>
                 <tr>
                     <td>1</td>
                     <td>1398-08-15</td>
                     <td>20000تومان</td>
                     <td>موفق</td>
                 </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>



@endsection('content')