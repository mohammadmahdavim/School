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
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
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
                <b>جستجو...</b></div>
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
                            <th>وضعیت</th>
                            <th>توضیحات</th>


                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @include('Admin.errors')
                        @foreach($data as $user )
                            <tr style="text-align: center">
                                <td>{{$user->user->f_name}}</td>
                                <td>{{$user->user->l_name}}</td>
                                <td>{{$user->teacher->f_name}} {{$user->teacher->l_name}}</td>

                                <td>{{(\Morilog\Jalali\Jalalian::fromCarbon($user->created_at))}}</td>
                                <td>
                                    @if($user->ok==1)
                                        <span style="color:red">موجه</span>

                                    @else
                                        <span style="color: #0d8d2d">غیر موجه</span>

                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal{{$user->id}}">
                                        ثبت توضیح غیبت
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLabel">{{\Morilog\Jalali\Jalalian::fromCarbon($user->created_at)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/student/absent/description/{{$user->id}}" method="post">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <label>توضیحات</label>
                                                        <input class="form-control" name="description"
                                                               value="{{$user->description}}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">بستن
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">ذخیره تغییرات
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

@endsection('content')
