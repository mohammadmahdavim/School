@extends('layouts.teacher')
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
                        نمره دهی درس {{$darss}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
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
                <div style="text-align: left">
                    <a href="/teacher/mark/export/{{$idc}}/{{$iddars}}">
                        <button class="btn btn-danger">خروجی اکسل</button>
                    </a>
                </div>
                <br>
                <a href="/teacher/viewmark/{{$idc}}/{{$iddars}}">
                    <button style="font-family: 'B Koodak';font-size: medium"
                            class="btn btn-warning input-group-text">
                        مشاهده و
                        <br>
                        ویرایش آیتم ها
                    </button>
                </a>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <div>
                            <thead>
                            <tr style="text-align: center">
                                <th>شمارنده</th>
                                <th> تصویر {{config('global.student')}}</th>

                                <th class="form-group input-group-text" scope="col">نام</th>
                                @foreach($items as $item)
                                    <th style="text-align: center">{{$item->name}}</th>
                                @endforeach


                                <th class="input-group-text" scope="col">نام</th>
                                <th style="text-align: center">میانگین</th>

                            </tr>

                            </thead>
                        </div>
                        <tbody>
                        <div>


                        </div>
                        <?php $idn = 1; ?>
                        @foreach($users as $user)
                            <form action="{{url('teacher/mark/edit') . '/' . $user->id }}" method="post">

                                <input class="form-control" type="hidden"
                                       name="idclass" id="idclass" value="{{$idc}}">

                                {{csrf_field()}}
                                @include('Admin.errors')

                                <input class="form-control" type="hidden" style="text-align: center"
                                       name="iddars" id="iddars" value="{{$iddars}}" readonly>

                                <tr style="text-align: center">
                                    <td style="text-align: center">{{$idn}}</td>
                                    <?php $idn = $idn + 1 ?>

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

                                    <td>
                                        <li id="user_id" style="list-style-type:none;color:blue"
                                            class="form-group w-40"
                                            value="{{$user->id}}">{{$user->f_name}}<br>{{$user->l_name}}</li>
                                    </td>

                                    @foreach($items as $item)
                                        @if(config('global.type_mark')==1)
                                            <td style="text-align: center">

                                                <input class=" input-group-text"

                                                       style=";text-align: center" type="number"
                                                       id="mark-{{$item->id}}-{{$user->id}}"
                                                       name="mark-{{$item->id}}-{{$user->id}}"
                                                       step=".01"
                                                       value="{{\App\MarkItem::where('user_id',$user->id)->where('item_id',$item->id)->pluck('mark')->first()}}">

                                            </td>
                                        @else
                                            <td style="text-align: center">
                                                <select id="mark-{{$item->id}}-{{$user->id}}"
                                                        name="mark-{{$item->id}}-{{$user->id}}">
                                                    <option value="{{getrealmark($item->id,$user->id)}}"
                                                            selected> {{getmark($item->id,$user->id)}}</option>
                                                    <option value="4">خیلی خوب</option>
                                                    <option value="3">خوب</option>
                                                    <option value="2">قابل قبول</option>
                                                    <option value="1">نیاز به تلاش مجدد</option>
                                                    <option value=""></option>
                                                </select>

                                            </td>
                                        @endif
                                    @endforeach

                                    <td>
                                        <li id="user_id" style="list-style-type:none;color:blue"
                                            class="form-group w-40"
                                            value="{{$user->id}}">{{$user->f_name}}<br>{{$user->l_name}}</li>
                                    </td>
                                    <td style="text-align: center">

                                        <?php

                                        $tmark = \App\TotalMark::where('user_id', $user->id)->where('coddars', $iddars)->pluck('totalmark')->first();
                                        ?>
                                        @if(config('global.type_mark')==1)

                                            <p class="text-center form-control input-group "

                                               style="text-align: center;background-color:#4dd0e1">
                                                {{$tmark}}
                                            </p>
                                        @else
                                            <p class="form-control input-group-text "

                                               style="text-align: center;background-color:#4dd0e1">
                                                @if ($tmark >3)
                                                    خیلی خوب
                                                @elseif (($tmark <= 3) && ($tmark > 2))
                                                    خوب
                                                @elseif (($tmark <= 2) && ($tmark > 1))
                                                    قابل قبول
                                                @elseif ($tmark <= 1)
                                                    نیاز به تلاش مجدد

                                                @endif
                                            </p>
                                        @endif
                                    </td>


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
function getmark($itemid, $userid)
{
    $mark = \App\MarkItem::where('user_id', $userid)->where('item_id', $itemid)->pluck('mark')->first();
    if ($mark == 4) {
        return 'خیلی خوب';
    } elseif ($mark == 3) {
        return 'خوب';
    } elseif ($mark == 2) {
        return 'قابل قبول';
    } elseif ($mark == 1) {
        return 'نیاز به تلاش مجدد';
    }
}

?>
