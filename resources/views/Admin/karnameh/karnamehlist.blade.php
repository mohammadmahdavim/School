@extends('layouts.admin')
@section('css')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->

    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

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
            <h3>لیست</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت کارنامه ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                <thead>
                <tr style="text-align: center">
                    <th> نام</th>
                    <th>حذف</th>

                </tr>
                </thead>
                <tbody>
                <?php $idn = 1; ?>
                @foreach($mykarnamehs as $mykarnameh )

                    <tr style="text-align: center">
                        <td style="text-align: center">{{$mykarnameh->name}}</td>
                        <td>
                            <a href="/admin/karnamehlist/delete/{{$mykarnameh->name}}">
                                <button class="btn btn-warning">
                                    حذف
                                    &nbsp;
                                    <i class="fa fa-trash"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>
    </div>

@endsection('content')
