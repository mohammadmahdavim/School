@extends('layouts.admin')
@section('css')
    <style>
        @media print {
            .noprint {
                visibility: hidden;
                display: none;
            }
        }

        @page {
            margin: 0;
        }
        .page-break {
            page-break-before: always;
        }
        #printContent {
            display: block;
        }
    </style>
@endsection('css')
@section('script')
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
            <h3>کارنامه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت کارنامه ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        کارنامه {{$mykarnamehs[0]->user->l_name}}
                        - {{$mykarnamehs[0]->user->f_name}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="page-break"></div>

    <div class="card" id="printContent">
        <div class="card-body">
            <div class="card">
                <div class="card-body border">
                    {{--                        <p style="text-align: center;font-size: medium;color: black"> کارنامه ماهانه {{$KarnamehName}}</p>--}}
                    <div class="d-flex justify-content-between">
                        <div class="p-2">
                            <img src="{{'/uploads/'.\App\Setting::first()->logo}}" height="100px" width="100px">

                        </div>
                        <div class="p-2">
                            <p style="text-align: center;font-size: medium;color: black">
                                @include('includ.name')
                                <br>
                                سال تحصیلی:1402-1403
                                <br>
                                کارنامه {{$mykarnamehs[0]->name}}
                            </p>
                        </div>
                        <?php
                        $user = $mykarnamehs[0]->user;
                        ?>
                        <div class="p-2">
                            <figure class="avatar avatar-xl">
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

                    </div>

                    <div class="row">
                        <div class="col-3">
                            نام:
                            {{$user->f_name}}
                            <br>
                            نام خانوادگی:
                            {{$user->l_name}}


                        </div>
                        <div class="col-6" style="text-align: center">

                            شماره دانش آموزی:
                            {{$user->shomarande}}

                            <br>
                            پایه:
                            {{$user->paye}}


                        </div>
                        <div class="col-3">
                            <?php
                            $class = \App\clas::where('classnamber', $user->class)->first();
                            ?>
                            رشته تحصیلی:
                            {{$class->reshte}}
                            <br>
                            کلاس:
                            {{$class->description}}

                        </div>
                    </div>

                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                    <tr style="text-align: center;background-color: #e7e4e4" >
                        <th>#</th>
                        <th>نام درس</th>
                        <th>دبیر</th>
                        <th>واحد</th>
                        <th>نمره</th>
                        <th>رتبه در کلاس</th>
                        <th>رتبه در پایه</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1;
                    $clRank = 0;
                    $paRank = 0;
                    ?>
                    @foreach($mykarnamehs as $mykarnameh)
                        @if(($mykarnameh->mark)<10)
                            <tr style="background-color: red;text-align: center">

                        @else
                            <tr style="text-align: center">

                                @endif

                                <td>{{$idn}}</td>

                                <td>{{$mykarnameh->dars->name}} </td>
                                <td>{{count($mykarnameh->teacher)>0 ?  $mykarnameh->teacher[0]->users->f_name : ''}} {{count($mykarnameh->teacher)>0 ?  $mykarnameh->teacher[0]->users->l_name : ''}} </td>
                                <td>{{$mykarnameh->dars->vahed}}</td>
                                <td style="color: black">{{($mykarnameh->mark)}}</td>
                                <td>{{$clR=getclassrank($mykarnameh->id)}}</td>
                                <td>{{$paR=getpayerank($mykarnameh->id)}}</td>
                            </tr>
                                <?php $idn = $idn + 1;
                                $clRank=$clR+$clRank;
                                $paRank=$paR+$paRank;
                                ?>


                            @endforeach
                            <tr style="text-align: center;background-color: #c9c6c6">


                                <td>#</td>

                                <td>معدل</td>
                                <td></td>
                                <td></td>
                                <td style="color: black">{{$moadel}}</td>
                                <td>{{round($clRank/$idn)}}</td>
                                <td>{{round($paRank/$idn)}}</td>
                            </tr>
                    </tbody>
                </table>


            </div>
            <div class="text-right">
                <p class="font-weight-bolder primary-font">معدل با تاثیر ضریب : <b
                        style="color: #0a6aa1">{{$moadel}}</b></p>

            </div>
            <br>
            <button class="noprint btn btn-primary" onclick="window.print()">پرینت کارنامه</button>
        </div>

    </div>

@endsection('content')


<?php


function getclassrank($id)
{
    $row = \Illuminate\Support\Facades\DB::table('karnameh_admins')->where('id', $id)->first();
    $class = \App\User::where('id', $row->user_id)->pluck('class')->first();
    $classUsers = \App\User::where('class', $class)->where('role', 'دانش آموز')->pluck('id');
    $mykarnamehs = \Illuminate\Support\Facades\DB::table('karnameh_admins')->where('dars_id', $row->dars_id)->whereIn('user_id', $classUsers)
        ->select(\Illuminate\Support\Facades\DB::raw('mark,  user_id'))
        ->groupBy('user_id')
        ->orderby('mark', 'DESC')
        ->get();
    $data = $mykarnamehs->where('mark', $row->mark);
    $value = $data->keys()->first() + 1;
    return $value;

}

function getpayerank($id)
{
    $row = \Illuminate\Support\Facades\DB::table('karnameh_admins')->where('id', $id)->first();
    $paye = \App\User::where('id', $row->user_id)->pluck('paye')->first();
    $class = \App\clas::where('paye', $paye)->pluck('classnamber');
    $classUsers = \App\User::whereIn('class', $class)->where('role', 'دانش آموز')->pluck('id');
    $mykarnamehs = \Illuminate\Support\Facades\DB::table('karnameh_admins')->where('dars_id', $row->dars_id)->whereIn('user_id', $classUsers)
        ->select(\Illuminate\Support\Facades\DB::raw('mark,  user_id'))
        ->groupBy('user_id')
        ->orderby('mark', 'DESC')
        ->get();
    $data = $mykarnamehs->where('mark', $row->mark);
    $value = $data->keys()->first() + 1;
    return $value;

}
?>

