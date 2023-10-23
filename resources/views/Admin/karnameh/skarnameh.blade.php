@extends('layouts.admin')
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
                    <li class="breadcrumb-item active" aria-current="page">کارنامه اصلی مدرسه</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">

            <p style="text-align: center;font-size: x-large;color: black">{{\App\RKarnameh::where('id',$idk)->first()['name']}}</p>
            <br>
            <h6 style="text-align: right;color: black"><span style="color: #0000cc">دانش آموز:<span
                        style="color: #1d68a7;font-family: 'B Koodak';font-size: x-large">{{\App\User::where('id',$id)->pluck('f_name')->first()}}
                    &nbsp;
                        {{\App\User::where('id',$id)->pluck('l_name')->first()}}
                    </span></span>
                &nbsp &nbsp</h6>
            <h6 style="text-align: right;color: black"><span style="color: #0000cc"> رتبه کلی در کلاس {{classnumber($class)}} نفری:&nbsp<span
                        style="color: #1d68a7;font-family: 'B Koodak';font-size: x-large">{{getrankkol($idk,$class,$id)}}</span></span>
                &nbsp &nbsp</h6>
            <h6 style="text-align: right;color: black"><span style="color: #0000cc"> رتبه کلی در پایه {{paye($class)}} نفری:&nbsp<span
                        style="color: #1d68a7;font-family: 'B Koodak';font-size: x-large">{{getrankkolpaye($idk,$class,$id)}}</span></span>
                &nbsp &nbsp</h6>

            <div class="table-responsive">
                <br>
                <br>
                <table class="table">
                    <thead>
                    <tr class=" " style="text-align: center;color: #bb1111">
                        <th>#</th>
                        <th>نام درس</th>
                        <th>واحد</th>
                        <th>نمره {{config('global.student')}}</th>
                        <th>بالاترین نمره کلاس</th>
                        <th>میانگین نمره کلاس</th>
                        <th>بالاترین نمره پایه</th>
                        <th>میانگین نمره پایه</th>
                        <th>رتبه در کلاس</th>
                        <th>رتبه در پایه</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    <?php $idn = 1 ?>
                    @foreach($mykarnamehs as $mykarnameh)
                        @if($mykarnameh->mark<=1)
                            <tr style="background-color: red">

                        @else
                            <tr>

                                @endif

                                <td>{{$idn}}</td>

                                <td>{{\App\dars::where('id',$mykarnameh->dars_id)->first()['name']}}</td>
                                <td>{{\App\dars::where('id',$mykarnameh->dars_id)->first()['vahed']}}</td>
                                <td style="color: black">

                                    {{$mykarnameh->mark}}
                                </td>
                                <td style="color: black">
                                    {{gettop($idk,$mykarnameh->dars_id,$class)}}
                                </td>
                                <td style="color: black">
                                    {{getavg($idk,$mykarnameh->dars_id,$class)}}
                                </td>
                                <td style="color: black">
                                    {{gettoppaye($idk,$mykarnameh->dars_id,$paye)}}
                                </td>
                                <td style="color: black">
                                    {{getavgpaye($idk,$mykarnameh->dars_id,$paye)}}
                                </td>
                                <td style="text-align: center;color: black">
                                    <button
                                        class="btn btn-rounded btn-info">{{getclassrank($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)}}</button>
                                    &nbsp &nbsp

                                    @if(getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)==0)
                                        بدون تغییر
                                    @elseif( getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)>0 )
                                        <span
                                            style="color: #28B463">{{getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)}}</span>

                                    @elseif(getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)<0)
                                        <span style="color: red">{{getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)}}
                                            @endif


                                    <span>

                                        @if( getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark) > 0)
                                            <span style="color: #28B463"> <i class="fa fa-arrow-up"></i></span>

                                        @elseif(getclassdeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)==0)
                                        @else
                                            <span style="color: red">   <i class="fa fa-arrow-down"></i></span>
                                        @endif

                                    </span></td>
                                <td style="text-align: center ;color: black">
                                    <button
                                        class="btn btn-rounded btn-info">{{getpayerank($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)}}</button>
                                    &nbsp &nbsp
                                    @if(getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)==0)
                                        بدون تغییر
                                    @elseif( getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)>0 )
                                        <span
                                            style="color: #28B463">{{getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)}}</span>

                                    @elseif(getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)<0)
                                        <span style="color: red">{{getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)}}
                                            @endif


                                    <span>

                                       @if( getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark) > 0)
                                            <span style="color: #28B463"> <i class="fa fa-arrow-up"></i></span>

                                        @elseif(getpayedeveloop($idk,$mykarnameh->dars_id,$id,$mykarnameh->mark)==0)
                                        @else
                                            <span style="color: red">   <i class="fa fa-arrow-down"></i></span>
                                        @endif

                                    </span></td>
                            </tr>
                            <?php $idn = $idn + 1; ?>
                            @endforeach
                    </tbody>
                </table>


            </div>
            <div class="text-right">
                <br>
                <p class="font-weight-bolder primary-font">معدل با تاثیر ضریب : <b
                        style="color: #0a6aa1">
                        {{getmoadel($idk,$id)}}
                    </b></p>

            </div>
            <button class="noprint btn btn-primary" onclick="window.print()">پرینت کارنامه</button>
        </div>

    </div>

@endsection('content')

<?php

function getmoadel($idk, $id)
{
    $mykarnamehs = \App\SKarnameh::where('karnameh_id', $idk)->where('user_id', $id)->get();
    $marks = 0;
    $vaheds = 0;
    foreach ($mykarnamehs as $mykarnameh) {
        $vahed = \App\dars::where('id', $mykarnameh->dars_id)->first()['vahed'];
        $mark = ($mykarnameh->mark) * $vahed;
        $vaheds = $vaheds + $vahed;
        $marks = $marks + $mark;
    }
    if ($vaheds == 0) {
        $moadel = 0;
    } else
        $moadel = round($marks / $vaheds, 2);

    return $moadel;
}

function getclassrank($idk, $mykarnameh, $id, $mymark)
{

    $class = \App\User::where('id', $id)->first()['class'];
//$rank=\App\SKarnameh::where('karnameh_id',$idk)->where('class_id',$mykarnameh)->orderBy('mark', 'DESC')->get();
    $collection = collect(\App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->where('class_id', $class)->where('dars_id', $mykarnameh)->get());
    $data = $collection->where('mark', $mymark);
    $value = $data->keys()->first() + 1;
    return $value;

}

function getclassdeveloop($idk, $mykarnameh, $id, $mymark)
{
    $class = \App\User::where('id', $id)->first()['class'];

    $kolkarnamehs = \Illuminate\Support\Facades\DB::table('r_karnamehs')->orderBy('created_at')->get();
    $collection = collect(\App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->where('class_id', $class)->where('dars_id', $mykarnameh)->get());
    $data = $collection->where('mark', $mymark);
    $valuee = $data->keys()->first() + 1;
    $difrent = 0;
    $pvalue = 0;
    foreach ($kolkarnamehs as $key => $value) {
        if ($value->id == $idk) {
            if ($key !== 0) {
                $pkey = $key - 1;
                $pid = $kolkarnamehs[$pkey]->id;
                $pcollection = collect(\App\SKarnameh::orderBy('mark', 'DESC')->where('class_id', $class)->where('karnameh_id', $pid)->where('dars_id', $mykarnameh)->get());
                $mymark = $pcollection->where('user_id', $id)->first()['mark'];
                $pdata = $pcollection->where('mark', $mymark);
                $pvalue = $pdata->keys()->first() + 1;
            } elseif ($key == 0) {
                $pvalue = $valuee;
            }
        }
    }
    $difrent = $pvalue - $valuee;

    return $difrent;
}

function getpayerank($idk, $mykarnameh, $id, $mymark)
{


    $collection = collect(\App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->where('dars_id', $mykarnameh)->get());
    $data = $collection->where('mark', $mymark);
    $value = $data->keys()->first() + 1;
    return $value;

}

function getpayedeveloop($idk, $mykarnameh, $id, $mymark)
{
    $kolkarnamehs = \Illuminate\Support\Facades\DB::table('r_karnamehs')->orderBy('created_at')->get();
    $collection = collect(\App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->where('dars_id', $mykarnameh)->get());
    $data = $collection->where('mark', $mymark);
    $valuee = $data->keys()->first() + 1;
    $difrent = 0;
    $pvalue = 0;
    foreach ($kolkarnamehs as $key => $value) {
        if ($value->id == $idk) {
            if ($key !== 0) {
                $pkey = $key - 1;
                $pid = $kolkarnamehs[$pkey]->id;
                $pcollection = collect(\App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $pid)->where('dars_id', $mykarnameh)->get());
                $mymark = $pcollection->where('user_id', $id)->first()['mark'];
                $pdata = $pcollection->where('mark', $mymark);
                $pvalue = $pdata->keys()->first() + 1;
                $difrent = $pvalue - $valuee;
            }
        }
    }


    return $difrent;
}




function gettop($idk, $dars,$class)

{
    $marks = \App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->where('class_id', $class)->where('dars_id', $dars)->first()['mark'];
    return $marks;
}

function getavg($idk, $dars,$class)
{

    $avg = \App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->where('class_id',$class)->where('dars_id', $dars)->avg('mark');
    $avge = round($avg, 2);
    return $avge;
}
function gettoppaye($idk, $dars,$paye)

{
    $classes = \App\clas::where('paye', $paye)->pluck('classnamber');
    $marks = \App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->wherein('class_id', $classes)->where('dars_id', $dars)->first()['mark'];
    return $marks;
}

function getavgpaye($idk, $dars,$paye)
{
    $classes = \App\clas::where('paye', $paye)->pluck('classnamber');
    $avg = \App\SKarnameh::orderBy('mark', 'DESC')->where('karnameh_id', $idk)->wherein('class_id', $classes)->where('dars_id', $dars)->avg('mark');
    $avge = round($avg, 2);
    return $avge;
}

function classnumber($class)
{
    $classnumber = $class;
    $studentnumbers = \App\student::where('classid', $classnumber)->count();
    return $studentnumbers;
}
function paye($class)
{
    $classnumber = $class;
    $paye=\App\clas::where('classnamber',$class)->pluck('paye')->first();
    $allclass=\App\clas::where('paye',$paye)->pluck('classnamber');
    $studentnumbers = \App\student::wherein('classid', $allclass)->count();
    return $studentnumbers;
}


function getrankkolpaye($idk,$class,$id)
{

    $paye=\App\clas::where('classnamber',$class)->pluck('paye')->first();
    $class=\App\clas::where('paye',$paye)->pluck('classnamber');
//$rank=\App\SKarnameh::where('karnameh_id',$idk)->where('class_id',$mykarnameh)->orderBy('mark', 'DESC')->get();
    $collection = collect(\App\SMkarnameh::orderBy('mark', 'DESC')
        ->where('karnameh_id', $idk)
        ->wherein('class_id', $class)
        ->groupBy('user_id')
        ->avg('dars_id'));
    $collection = \Illuminate\Support\Facades\DB::table('s_mkarnamehs')
        ->where('karnameh_id', $idk)
        ->wherein('class_id', $class)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderByDesc('avg')
        ->get();
//    dd($collection);

    $data = $collection->where('user_id', $id);
    $value = $data->keys()->first() + 1;
    return $value;


}

function getrankkol($idk,$class,$id)
{


//$rank=\App\SKarnameh::where('karnameh_id',$idk)->where('class_id',$mykarnameh)->orderBy('mark', 'DESC')->get();
    $collection = collect(\App\SMkarnameh::orderBy('mark', 'DESC')
        ->where('karnameh_id', $idk)
        ->where('class_id', $class)
        ->groupBy('user_id')
        ->avg('dars_id'));
    $collection = \Illuminate\Support\Facades\DB::table('s_mkarnamehs')
        ->where('karnameh_id', $idk)
        ->where('class_id', $class)
        ->select(\Illuminate\Support\Facades\DB::raw('avg(mark) as avg,  user_id'))
        ->groupBy('user_id')
        ->orderByDesc('avg')
        ->get();
//    dd($collection);

    $data = $collection->where('user_id', $id);
    $value = $data->keys()->first() + 1;
    return $value;


}
?>



