@extends('layouts.admin')
@section('css')

@endsection('css')
@section('script')
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
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
            <h3>مدیریت مالی</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت مالی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست پرداخت ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <br>
            <input id="myInput" type="text" placeholder="search" class="form-control col-md-4">
            <br>
            <a href="{{ url('admin/finance/downloadExcel/xlsx') }}">
                <button class="btn btn-dark">دانلود اکسل xlsx</button>
            </a> <br>
            <div class="media-body table-responsive">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">

                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>پایه تحصیلی و کلاس</th>
                        <th>مبلغ (ریال)</th>
                        <th>نوع پرداخت</th>
                        <th>وضعیت تایید</th>

                    </tr>
                    </thead>
                    <tbody>

                    @include('Admin.errors')
                    @foreach($paides as $index=>$paide )

                        <tr style="text-align: center">
                            <th scope="row">{{ $index + $paides->firstItem() }}</th>
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
                            <td>{{$paide->user->f_name}}</td>
                            <td>{{$paide->user->l_name}}</td>
                            <td>
                                {{$paide->user->paye}} - {{$paide->user->class}}
                            </td>
                            <td>
                                {{number_format($paide->price)}}
                            </td>
                            <td>
                                {{$paide->type}}

                            </td>
                            <td>
                                {{$paide->verify}}

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $paides->links() }}

        </div>
    </div>
    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('content')


