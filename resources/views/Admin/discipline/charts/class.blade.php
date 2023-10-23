@extends('layouts.admin')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">

    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <script type="text/javascript" src="/assets/jss/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/jss/js/pages/form_multiselect.js"></script>

    <!-- end::dataTable -->

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>کلاس {{$id}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودار مقایسه آیتم های انضباطی</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کلاس {{$id}} </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">

                <div class="panel-body">

                    <div>
                        <div class="row">
                            <div class="panel-body">
                                {!!$chartt->html() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Charts::scripts() !!}
    {!! $chartt->script() !!}
@endsection('content')