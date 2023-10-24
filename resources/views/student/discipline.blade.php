@extends('layouts.student')
@section('css')
@endsection('css')
@section('script')
    <script src="/assets/js/jquery.min.js"></script>
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
@endsection('css')
@section('script')
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مشاهده مواردانضباطی</a></li>

                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">

            <input id="myInput" type="text" placeholder="مورد انظباطی را جستجو کنید" class="form-control col-md-4">
            <br>
            <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                <thead>
                <tr style="text-align: center">
                    <th>مورد ثبت شده</th>
                    <th>نمره کسر شده</th>
                    <th>تاریخ ثبت</th>

                </tr>
                </thead>
                <tbody>
                @foreach($disiplins as $disiplin )

                    <tr style="text-align: center">
                        <td>{{$disiplin->CDisciplines->name}}</td>
                        <td>{{($disiplin->mark)/5}}</td>
                        <td>{{$disiplin->created_at->toDateString()}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <br>
            <span style="font-size: 16px">
                نمره انضباط کل:
                <b>
                    {{20 - $total}}
                </b>
            </span>
        </div>

    </div>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')
