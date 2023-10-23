@extends('layouts.teacher')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
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
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

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
            <h3>
                نمره دهی درس {{$darss}}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمره</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        نمره دهی درس {{$iddars}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/teacher/mark/date" method="post">
                {{csrf_field()}}
                <input name="class" value="{{$idc}}" hidden>
                <input name="dars" value="{{$iddars}}" hidden>
                <label> انتخاب روز برای نمره دهی</label>

                <div class="row text-center justify-content-md-center">
                    <div class="col-md-3 m-t-b-20">
                        <input style="text-align: center" type="text" name="date" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{$date}}" required autocomplete="off"></div>
                    <div class="col-md-2 m-t-b-20">
                        <button class="btn btn-success">اعمال روز</button>
                    </div>
                </div>
            </form>
            <div id="karnamehrender">

            </div>

        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-md-4 m-t-b-20">
                    <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-12">
                </div>
                <?php
                $countt = \App\student::where('classid', $idc)->count();
                ?>
                <div style="text-align: center">
                <span style="color: darkred;text-align: center">
                    <b>
                                   تعداد {{config('global.students')}} این کلاس:  {{$countt}}
                    </b>
                   <br>
                    درس {{$darss}}
                </span>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <div>
                            <thead>
                            <tr style="text-align: center">
                                <th>شمارنده</th>
                                <th> تصویر {{config('global.student')}}</th>

                                <th class="form-group input-group-text" scope="col">نام</th>
                                <th>{{$date}}</th>


                            </tr>

                            </thead>
                        </div>
                        <tbody>
                        <div>


                        </div>
                        <?php $idn = 1; ?>
                        @foreach($users as $user)
                            <form action="{{url('teacher/mark/storedate') }}" method="post">

                                <input class="form-control" type="hidden"
                                       name="date" id="date" value="{{$date}}">
                                <input class="form-control" type="hidden"
                                       name="idclass" id="idclass" value="{{$idc}}">

                                {{csrf_field()}}
                                @include('Admin.errors')

                                <input class="form-control" type="hidden" style="text-align: center"
                                       name="iddars" id="iddars" value="{{$iddars}}" readonly>

                                <tr style="text-align: center">
                                    <td style="text-align: center">{{$idn}}</td>

                                    <td>

                                        <div class="gallery">
                                            <figure class="avatar avatar-sm avatar-state-success">
                                                @if(!empty($user->filename))
                                                    <img class="rounded-circle"
                                                         src="{{url('uploads/'.auth()->user()->filename)}}"
                                                         alt="...">
                                                @else
                                                    <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                         alt="...">
                                                @endisset
                                            </figure>

                                        </div>
                                    </td>

                                    <td>
                                        <li id="user_id" style="list-style-type:none;color:blue"
                                            class="form-group w-40"
                                            value="{{$user->id}}">{{$user->f_name}}<br>{{$user->l_name}}</li>
                                    </td>
                                    <td style="text-align: center">
                                        @if(config('global.type_mark')==1)

                                        <input class="form-control"
                                               style=";text-align: center" type="number"
                                               name="mark[{{$user->id}}]"
                                               step=".01"
                                               @if(!empty($user->markitems[0]))
                                               value="{{$user->markitems[0]->mark}}"
                                                @endif
                                        >
                                    @else
                                            <select name="mark[{{$user->id}}]">

                                                <option @if($user->markitems[0]->mark==4) selected @endif value="4">خیلی خوب</option>
                                                <option @if($user->markitems[0]->mark==3) selected @endif value="3">خوب</option>
                                                <option @if($user->markitems[0]->mark==2) selected @endif value="2">قابل قبول</option>
                                                <option @if($user->markitems[0]->mark==1) selected @endif value="1">نیاز به تلاش مجدد</option>
                                                <option value=""></option>
                                            </select>


                                        @endif
                                    </td>
                                    <?php $idn = $idn + 1; ?>

                                    @endforeach

                                </tr>
                                <div style="text-align: left">


                                    <button class="btn btn-info" type="submit">ذخیره و ارسال نمرات
                                    </button>

                                </div>
                                <br>


                                <script src="/js/sweetalert.min.js"></script>

                            @include('sweet::alert')
                        </tbody>

                    </table>

                </div>
                <br>
                <div class="left" style="text-align: left">
                    <button class="btn btn-info" type="submit">ذخیره و ارسال نمرات
                    </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection('content')
<?php


function getrealmark($itemid, $userid)
{
    $mark = \App\MarkItem::where('user_id', $userid)->where('item_id', $itemid)->pluck('mark')->first();
    return $mark;
}

?>
