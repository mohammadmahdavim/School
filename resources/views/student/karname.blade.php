@extends('layouts.student')
@section('css')
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
            <h3>کارنامه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کارنامه</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')






    <div class="card">
        <div class="card-body p-50">
            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="font-weight-800 d-flex align-items-center">
                        <div class="col-md-3">

                            <img class="m-l-20" src="/assets/images/654149x300.jpg" alt="...">
                        </div>
                    </h2>
                    <div class="col-md-4">
                        <h4 class="font-weight-800 d-flex align-items-center">کارنامه سال تحصیلی ۹۹-۱۳۹۸ مدرسه
                            آرامش</h4>
                    </div>
                    <div class="col-md-3">
                        <img src="{{url('uploads/'.auth()->user()->filename)}}" alt="Cinque Terre" width="100"
                             height="100">
                    </div>
                </div>
                <hr class="m-t-b-50">
                <div class="row">

                    <div class="col-md-3">
                        <br>
                        <label>استان: تهران</label>

                        <br>
                        <label>شهر: تهران</label>

                        <br>
                        <label>سال تحصیلی: 97-98</label>


                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>نام: {{$users->f_name}}</label>

                        <br>
                        <label>نام خانوداگی:{{$users->l_name}} </label>

                        <br>
                        <label>نام پدر: {{$users->fname}}</label>

                    </div>

                    <div class="col-md-3">
                        <br>
                        <label>ش.ش: {{$users->codemeli}}</label>

                        <br>
                        <label>کلاس: {{$users->paye}} - {{$users->class}}</label>

                        <br>
                        <label>تاریخ تولد: {{$users->birthday}}</label>


                    </div>
                </div>
                <hr class="m-t-b-50">


                <div class="table-responsive">

                    <table class="table m-t-b-50">
                        <thead>
                        <tr class="bg-dark text-white">
                            <th>کد درس</th>
                            <th>نام درس</th>
                            <th>واحد</th>

                            <th>نمره</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doros as $dars)
                            <tr>
                                <td>{{$dars->id}}</td>

                                <td>{{$dars->name}}</td>
                                <td>{{$dars->vahed}}</td>
                                {{--<td>{{\App\dars::find($dars->id)->TotalMarks()->where('user_id',$users->id)->pluck('totalmark')->first()}}</td>--}}
                                <td>{{getmark($dars->id)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                <div class="text-right">
                    <p class="font-weight-bolder primary-font">معدل با تاثیر ضریب : <b
                                style="color: #0a6aa1">{{$moadel}}</b></p>

                </div>
                <br>
                <div class="row">

                    <div class="col-md-3">
                        <label> تعداد واحد درسی: <b>{{getvahed($doros)}}</b></label>
                        <br>
                        <label> تعداد واحد قبولی: <b>{{getpass($doros)}}</b></label>
                        <br>
                        <label> تعداد واحد تجدید: <b>{{getrad($doros)}}</b></label>
                        <br>

                        <label> جمع نمرات: <b>{{getkol($doros)}}</b></label>

                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <br>
                        <label class="font-weight-800 primary-font">مدیر آموزشگاه:</label>
                        <br>
                        مهر وامضا
                    </div>
                    <div class="col-md-3">
                        <br> <label class="font-weight-800 primary-font"> مسول ثبت نمره:</label>
                        <br>
                        مهر و امضا


                    </div>
                </div>

                <div class="text-left d-print-none">
                    <hr class="m-t-b-50">
                    {{--<a href="#" class="btn btn-primary">--}}
                    {{--<i class="fa fa-send m-l-5"></i> ارسال صورتحساب--}}
                    {{--</a>--}}
                    <a href="javascript:window.print()" class="btn btn-success m-r-5">
                        <i class="fa fa-print m-l-5"></i> چاپ
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
<?php

function getmark($id)
{
    $items = \App\CMark::where('dars', $id)->get();

    $totalmark = \App\TotalMark::where('user_id', auth()->user()->id)->where('coddars', $id)->first()['totalmark'];
    $bist = 0;
    foreach ($items as $item) {
        $bistt = $item->bist;
        $bist += $bistt;
    }
    if ($bist == 0) {
        $finalmark = 'هنوز امتحانی گرفته نشده است.';
    } else
        $finalmark = round(($totalmark / $bist) * 20, 2);
    return $finalmark;
}
function getvahed($doros)
{
    $vahed = 0;
    foreach ($doros as $dars) {
        $vaheds = $dars->vahed;
        $vahed += $vaheds;
    }
    return $vahed;
}
function getpass($doros)
{
    $vahed = 0;
    foreach ($doros as $dars) {
        $vaheds = $dars->vahed;
        $items = \App\CMark::where('dars', $dars->id)->get();

        $totalmark = \App\TotalMark::where('user_id', auth()->user()->id)->where('coddars', $dars->id)->first()['totalmark'];
        $bist = 0;
        foreach ($items as $item) {
            $bistt = $item->bist;
            $bist += $bistt;
        }
        if ($bist == 0) {
            $finalmark = 0;
        } else
            $finalmark = round(($totalmark / $bist) * 20, 2);
        if ($finalmark >= 10) {
            $vahed += $vaheds;
        }
    }
    return $vahed;
}
function getrad($doros)
{
    $vahed = 0;
    foreach ($doros as $dars) {
        $vaheds = $dars->vahed;
        $items = \App\CMark::where('dars', $dars->id)->get();

        $totalmark = \App\TotalMark::where('user_id', auth()->user()->id)->where('coddars', $dars->id)->first()['totalmark'];
        $bist = 0;
        foreach ($items as $item) {
            $bistt = $item->bist;
            $bist += $bistt;
        }
        if ($bist == 0) {
            $finalmark = 10;
        } else
            $finalmark = round(($totalmark / $bist) * 20, 2);
        if ($finalmark < 10) {
            $vahed += $vaheds;
        }
    }
    return $vahed;
}
function getkol($doros)
{
    $totalmarks = 0;
    foreach ($doros as $dars) {

        $items = \App\CMark::where('dars', $dars->id)->get();

        $totalmark = \App\TotalMark::where('user_id', auth()->user()->id)->where('coddars', $dars->id)->first()['totalmark'];
        $bist = 0;
        foreach ($items as $item) {
            $bistt = $item->bist;
            $bist += $bistt;
        }
        if ($bist == 0) {
            $finalmark = 0;
        } else
            $finalmark = round(($totalmark / $bist) * 20, 2);

        $totalmarks += $finalmark;

    }
    return $totalmarks;
}

?>



