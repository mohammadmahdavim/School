@extends('layouts.admin')
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

    <script src="/js/sweetalert.min.js"></script>

    <script src="/assets/excel/ry.stickyheader.js/jquejs"></script>
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
            <h3>کلاس{{$nav}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اطلاعات {{config('global.students')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کلاس{{$nav}}</li>
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
                <b> لطفا نام خانوادگی را سرچ کنید...</b></div>
            <br>
            <input  id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-responsive">
                <table>
                    <thead >
                    <tr style="text-align: left">
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نام پدر</th>
                        <th>کد ملی</th>
                    </tr>
                    </thead>
                    <tbody >
                    @include('Admin.errors')
                    @foreach($users as $user )
                        <form action="{{url('admin/student/edit').'/'.$user->id}}" method="post">
                            {{csrf_field()}}
                            @method('put')
                            <tr style="text-align: center">
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
                                <td>{{$user->f_name}}</td>
                                <td>{{$user->l_name}}</td>

                                <td>{{$user->fname}} </td>

                                <td>{{$user->codemeli}}
                                </td>

                        </tr>
                        </form>

                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection('content')
