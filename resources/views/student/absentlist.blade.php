@extends('layouts.student')
@section('css')
    <link rel="stylesheet" type="text/css" href="/assets/excel/css/component.css"/>
    <style>
        .fab {
            width: 40px;
            height: 40px;
            background-color: gold;
            border-radius: 50%;
            box-shadow: 0 6px 10px 0 #666;
            transition: all 0.1s ease-in-out;

            font-size: 20px;
            color: white;
            text-align: center;
            line-height: 40px;

            position: fixed;
            right: 2%;
            bottom: 18%;
        }

        .fab:hover {
            box-shadow: 0 6px 14px 0 #666;
            transform: scale(1.15);
        }

        @media screen and (max-width: 1000px) {
            .fab {
                display: none;
            }
        }
    </style>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 700px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
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
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>حضورغیاب {{$data[0]->user->f_name}} {{$data[0]->user->l_name}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست {{config('global.students')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        حضورغیاب {{$data[0]->user->f_name}} {{$data[0]->user->l_name}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body" style="padding-right: -10px">
            <div style="text-align: right">
                <br>
                <b> لطفا نام و یا نام خانوادگی {{config('global.student')}} را سرچ کنید...</b></div>
            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div style="text-align: right">
                <div class="table-responsive">
                    <table class="overflow-y" id="myTable">
                        <thead>
                        <tr style="text-align: center">

                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>دبیر</th>
                            <th>تاریخ غیبت</th>


                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @include('Admin.errors')
                        @foreach($data as $user )
                            <tr style="text-align: center">
                                <td>{{$user->user->f_name}}</td>
                                <td>{{$user->user->l_name}}</td>
                                <td>{{\App\User::where('id',$user->author)->pluck('f_name')->first()}}
                                    {{\App\User::where('id',$user->author)->pluck('l_name')->first()}}
                                </td>
                                <td>{{(\Morilog\Jalali\Jalalian::fromCarbon($user->created_at))->format('%A, %d %B %y')}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>




@endsection('content')
