@extends('layouts.student')
@section('css')
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
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
@endsection('css')
@section('script')


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
            <h3>فیلم های دریافت شده</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">فیلم ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">فیلم های دریافت شده</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="padding-right: 20px">

                <div class="col-md-4">
                    <input id="myInput" type="text" placeholder="Search.." class="form-control">
                </div>
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>{{config('global.teacher')}}</th>
                        <th>درس</th>
                        <th>فصل</th>
                        <th>بخش</th>
                        <th>عنوان آموزش</th>
                        <th>توضیحات</th>
                        <th>تاریخ ارسال</th>
                        <th style="text-align: center">فایل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($films as $fil)
                        @foreach($fil as $film)

                            <tr style="text-align: center">

                                <td>
                                    <p class="js-example-basic-single">{{\App\User::where('id',$film->user_id)->first()['f_name']}}
                                        - {{\App\User::where('id',$film->user_id)->first()['l_name']}}</p>
                                </td>
                                <td>
                                    <p>{{\App\dars::where('id',$film->dars)->pluck('name')->first()}}</p>
                                </td>
                                <td>
                                    <p>{{$film->chapter}}</p>
                                </td>
                                <td>
                                    <p>{{$film->bakhsh}}</p>
                                </td>
                                <td>
                                    <p class="js-example-basic-single">{{$film->title}}</p>
                                </td>
                                <td> {!! $film->description !!}</td>
                                <td>
                                    {{ $film->created_at->toDateString() }}
                                    @if($film->updated_at->toDateString() !==$film->created_at->toDateString())
                                        <hr>
                                        <span style="color:#911203">
                                <p>بروز شده در تاریخ:</p>
                                    {{ $film->updated_at->toDateString() }}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($film->filename)
                                        <video width="200" controls>
                                            <source src="images/{{$film->filename}}" type="video/mp4">
                                            Your browser does not support HTML video.
                                        </video>
                                        <a href="/film/count/{{$film->id}}" class="btn btn-outline-warning">

                                            <i
                                                    class="icon-download"></i> Download </a>
                                    @else
                                        <a href="{{$film->link}}">{{$film->link}}</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection('content')
