@extends('layouts.student')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('css')
    <style>
        @media print {
            .noprint {
                visibility: hidden;
                display: none;

            }
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
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کارنامه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کارنامه ماهانه سایت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="noprint" style="text-align: center;font-size: large;color: black"> انتخاب ماه برای مشاهده
                کارنامه
            </div>

            <form action="/student/karnameh/render/month" method="post">
                {{csrf_field()}}
                <div class="noprint row text-center justify-content-md-center">
                    <div class="col-md-3 m-t-b-20">
                        <select id="month" name="month" class="select2-dropdown form-control">
                            <option selected>{{$KarnamehName}}</option>
                            <option value="7">مهر</option>
                            <option value="8">آبان</option>
                            <option value="9">آذر</option>
                            <option value="10">دی</option>
                            <option value="11">بهمن</option>
                            <option value="12">اسفند</option>
                            <option value="1">فروردین</option>
                            <option value="2">اردیبهشت</option>
                            <option value="3">خرداد</option>
                        </select>
                    </div>
                    <div class="col-md-2 m-t-b-20">
                        <button class="btn btn-success">اعمال ماه</button>
                    </div>
                </div>
            </form>
            <div>
                <br>


                <div class="card">
                    <div class="card-body border">
                        {{--                        <p style="text-align: center;font-size: medium;color: black"> کارنامه ماهانه {{$KarnamehName}}</p>--}}
                        <div class="d-flex justify-content-between">
                            <div class="p-2">
                                <img src="https://s6.uupload.ir/files/untitled-1_o82b.png" height="100px" width="100px">

                            </div>
                            <div class="p-2">
                                <p style="text-align: center;font-size: medium;color: black">
                                    @include('includ.name')
                                    <br>
                                    سال تحصیلی:1402-1403
                                    <br>
                                    کارنامه ماهانه {{$KarnamehName}}
                                </p>
                            </div>
                            <div class="p-2">
                                <figure class="avatar avatar-xl">
                                    @if(!empty(auth()->user()->resizeimage))
                                        <img class="rounded-circle"
                                             src="{{url('uploads/'.auth()->user()->resizeimage)}}"
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
                                {{auth()->user()->f_name}}
                                <br>
                                نام خانوادگی:
                                {{auth()->user()->l_name}}


                            </div>
                            <div class="col-6" style="text-align: center">

                                شماره دانش آموزی:
                                {{auth()->user()->shomarande}}

                                <br>
                                پایه:
                                {{auth()->user()->paye}}


                            </div>
                            <div class="col-3">
                                <?php
                                $class = \App\clas::where('classnamber', auth()->user()->class)->first();
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
                <br>
                {{--                <h6 style="text-align: right;color: black"><span style="color: #0000cc"> رتبه کلی در کلاس {{$studentnumbers}} نفری:&nbsp<span--}}
                {{--                            style="color: #1d68a7;font-family: 'B Koodak';font-size: x-large">{{$rankkol}}</span></span>--}}
                {{--                    &nbsp &nbsp</h6>--}}

                <div class="table-responsive">
                    <br>
                    <br>
                    <table class="table">
                        <thead>
                        <tr class=" " style="text-align: center;color: #bb1111">
                            <th>#</th>
                            <th>نام درس</th>
                            <th>واحد</th>
                            <th>
                                <button class="btn btn-warning">نمره {{config('global.student')}}</button>
                            </th>
                            <th>بالاترین نمره کلاس</th>
                            <th>میانگین نمره کلاس</th>
                            <th>رتبه در کلاس</th>
                            <th>رتبه در پایه</th>
                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        <?php $idn = 1;
                        $sumClass = 0;
                        $sumPaye = 0;
                        ?>
                        @foreach($mykarnamehs as $mykarnameh)
                            @if($mykarnameh->avg <= 1)
                                <tr style="background-color: red">

                            @else
                                <tr>

                                    @endif

                                    <td>{{$idn}}</td>

                                    <td>{{\App\dars::where('id',$mykarnameh->coddars)->first()['name']}}</td>
                                    <td>{{\App\dars::where('id',$mykarnameh->coddars)->first()['vahed']}}</td>
                                    <td>
                                        {{$mykarnameh->avg}}
                                    </td>
                                    <td style="color: black">

                                        {{gettop($idk,$mykarnameh->coddars)}}</td>
                                    <td style="color: black">

                                        {{getavg($idk,$mykarnameh->coddars)}}</td>
                                    <td style="text-align: center;color: black">
                                        <button
                                            class="btn btn-rounded btn-info">{{$clRank=getclassrank($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</button>
                                            <?php $sumClass = $sumClass + $clRank; ?>

                                        &nbsp &nbsp

                                        @if(getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)==0)
                                            بدون تغییر
                                        @elseif( getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)>0 )
                                            <span
                                                style="color: #28B463">{{getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</span>

                                        @elseif(getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)<0)
                                            <span style="color: red">{{getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg
                                    )}}
                                                @endif


                                    <span>

                                    @if( getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg) > 0)
                                            <span style="color: #28B463"> <i class="fa fa-arrow-up"></i></span>

                                        @elseif(getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)==0)
                                        @else
                                            <span style="color: red">   <i class="fa fa-arrow-down"></i></span>
                                        @endif

                                    </span></td>
                                    <td style="text-align: center ;color: black">
                                        <button
                                            class="btn btn-rounded btn-info">{{$paRank=getpayerank($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</button>
                                        &nbsp &nbsp
                                            <?php $sumPaye = $sumPaye + $paRank; ?>

                                        @if(getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)==0)
                                            بدون تغییر
                                        @elseif( getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)>0 )
                                            <span
                                                style="color: #28B463">{{getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</span>

                                        @elseif(getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)<0)
                                            <span style="color: red">{{getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}
                                                @endif


                                    <span>

                                    @if( getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg) > 0)
                                            <span style="color: #28B463"> <i class="fa fa-arrow-up"></i></span>

                                        @elseif(getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)==0)
                                        @else
                                            <span style="color: red">   <i class="fa fa-arrow-down"></i></span>
                                        @endif

                                    </span></td>
                                </tr>
                                    <?php $idn = $idn + 1; ?>
                                @endforeach
                                <tr style="background-color: #d8e0e1">
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        معدل
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{$moadel}}
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{round($sumClass/$idn)}}
                                    </td>
                                    <td>
                                        {{round($sumPaye/$idn)}}
                                    </td>
                                </tr>
                        </tbody>
                    </table>


                </div>
                <div class="text-right">
                    <br>
                    <p class="font-weight-bolder primary-font">معدل با تاثیر ضریب : <b
                            style="color: #0a6aa1">{{$moadel}}</b></p>

                </div>
            </div>
            <button class="noprint" id="printbtn" onclick="window.print()">پرینت کارنامه</button>
        </div>

    </div>

@endsection('content')



<?php


function getclassrank($idk, $mykarnameh, $id, $mymark)
{
    $class = \App\User::where('id', $id)->first()['class'];
    $mykarnamehs = \Illuminate\Support\Facades\DB::table('total_marks')->whereRaw('MONTH(created_at) = ?', $idk)->where('codclass', $class)->where('coddars', $mykarnameh)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(totalmark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderby('avg', 'DESC')
        ->get();
    $data = $mykarnamehs->where('avg', $mymark);
    $value = $data->keys()->first() + 1;
    return $value;

}

function getclassdeveloop($idk, $mykarnameh, $id, $mymark)
{
    $difrent = 0;
    $class = \App\User::where('id', $id)->first()['class'];
    $mykarnamehs = \Illuminate\Support\Facades\DB::table('total_marks')->whereRaw('MONTH(created_at) = ?', $idk)->where('codclass', $class)->where('coddars', $mykarnameh)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(totalmark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderby('avg', 'DESC')
        ->get();
    $data = $mykarnamehs->where('avg', $mymark);
    $value = $data->keys()->first() + 1;

    $idp = $idk - 1;
    if ($idp > 0) {
        $pmykarnamehs = \Illuminate\Support\Facades\DB::table('total_marks')->whereRaw('MONTH(created_at) = ?', $idp)->where('codclass', $class)->where('coddars', $mykarnameh)
            ->select(\Illuminate\Support\Facades\DB::raw('avg(totalmark) as avg,  user_id'))
            ->groupBy('user_id')
            ->orderby('avg', 'DESC')
            ->get();
        if (count($pmykarnamehs) == 0) {
            return '0';
        }
        $mymark = $pmykarnamehs->where('user_id', $id)->pluck('avg');
        $pdata = $pmykarnamehs->where('avg', $mymark);
        $pvalue = $pdata->keys()->first() + 1;
        $difrent = $pvalue - $value;

    }

    return $difrent;
}

function getpayerank($idk, $mykarnameh, $id, $mymark)
{

    $mykarnamehs = \Illuminate\Support\Facades\DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $idk)->where('coddars', $mykarnameh)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderby('avg', 'DESC')
        ->get();


    $data = $mykarnamehs->where('avg', $mymark);
    $value = $data->keys()->first() + 1;
    return $value;

}

function getpayedeveloop($idk, $mykarnameh, $id, $mymark)
{
    $difrent = 0;

    $mykarnamehs = \Illuminate\Support\Facades\DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $idk)->where('coddars', $mykarnameh)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderby('avg', 'DESC')
        ->get();


    $data = $mykarnamehs->where('avg', $mymark);
    $value = $data->keys()->first() + 1;

    $idp = $idk - 1;
    if ($idp > 0) {
        $pmykarnamehs = \Illuminate\Support\Facades\DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $idp)->where('coddars', $mykarnameh)
            ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
            ->groupBy('user_id')
            ->orderby('avg', 'DESC')
            ->get();
        if (count($pmykarnamehs) == 0) {
            return '0';
        }
        $mymark = $pmykarnamehs->where('user_id', $id)->pluck('avg');
        $pdata = $pmykarnamehs->where('avg', $mymark);
        $pvalue = $pdata->keys()->first() + 1;
        $difrent = $pvalue - $value;

    }

    return $difrent;
}
function gettop($idk, $dars)

{

    $marks = \Illuminate\Support\Facades\DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $idk)->where('coddars', $dars)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderBy('avg', 'desc')
        ->get();
//    dd($marks);
    $top = round($marks[0]->avg, 2);
    return $top;
}

function getavg($idk, $dars)
{
    $marks = \Illuminate\Support\Facades\DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $idk)->where('coddars', $dars)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->groupBy('user_id')
        ->get();

    $avg = $marks->avg('avg');
    $avge = round($avg, 2);
    return $avge;
}
?>


