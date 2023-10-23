@extends('layouts.student')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('css')
    <style>

        @media print {
            .noprint {
                visibility: hidden;
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
                <p style="text-align: center;font-size: x-large;color: black"> کارنامه ماهانه {{$KarnamehName}}</p>
                <br>
                <h6 style="text-align: right;color: black"><span style="color: #0000cc"> رتبه کلی در کلاس {{$studentnumbers}} نفری:&nbsp<span
                                style="color: #1d68a7;font-family: 'B Koodak';font-size: x-large">{{$rankkol}}</span></span>
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
                            <th>
                                <button class="btn btn-warning">نمره دانش آموز</button>
                            </th>
                            <th>بالاترین نمره کلاس</th>
                            <th>میانگین نمره کلاس</th>
                            <th>رتبه در کلاس</th>
                            <th>رتبه در پایه</th>
                            <th>نمودار کلی</th>
                        </tr>
                        </thead>
                        <tbody style="text-align: center">
                        <?php $idn = 1 ?>
                        {{--@dd($mykarnamehs)--}}
                        @if(count($mykarnamehs)>0)
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
                                            {{--{{$mykarnameh->avg}}--}}
                                            @if ($mykarnameh->avg >3)
                                                خیلی خوب

                                            @elseif (($mykarnameh->avg <= 3) && ($mykarnameh->avg > 2))

                                                خوب
                                            @elseif (($mykarnameh->avg <= 2) && ($mykarnameh->avg > 1))
                                                قابل قبول
                                            @elseif (($mykarnameh->avg <= 1) && ($mykarnameh->avg > 0))
                                                نیاز به تلاش مجدد
                                            @else
                                                {{$mykarnameh->avg}}
                                            @endif
                                        </td>
                                        <td style="color: black">

                                            {{--{{gettop($idk,$mykarnameh->coddars)}}--}}

                                            @if (gettop($idk,$mykarnameh->coddars) >3)
                                                خیلی خوب

                                            @elseif ((gettop($idk,$mykarnameh->coddars) <= 3) && (gettop($idk,$mykarnameh->coddars) > 2))

                                                خوب
                                            @elseif ((gettop($idk,$mykarnameh->coddars) <= 2) && (gettop($idk,$mykarnameh->coddars) > 1))
                                                قابل قبول
                                            @elseif ((gettop($idk,$mykarnameh->coddars) <= 1) && (gettop($idk,$mykarnameh->coddars) > 0))
                                                نیاز به تلاش مجدد
                                            @else
                                                {{gettop($idk,$mykarnameh->coddars)}}
                                            @endif
                                        </td>
                                        <td style="color: black">

                                            {{--{{getavg($idk,$mykarnameh->coddars)}}--}}
                                            @if (getavg($idk,$mykarnameh->coddars) >3)
                                                خیلی خوب

                                            @elseif ((getavg($idk,$mykarnameh->coddars) <= 3) && (getavg($idk,$mykarnameh->coddars) > 2))

                                                خوب
                                            @elseif ((getavg($idk,$mykarnameh->coddars) <= 2) && (getavg($idk,$mykarnameh->coddars) > 1))
                                                قابل قبول
                                            @elseif ((getavg($idk,$mykarnameh->coddars) <= 1) && (getavg($idk,$mykarnameh->coddars) > 0))
                                                نیاز به تلاش مجدد
                                            @else
                                                {{getavg($idk,$mykarnameh->coddars)}}
                                            @endif
                                        </td>
                                        <td style="text-align: center;color: black">
                                            <button class="btn btn-rounded btn-info">{{getclassrank($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</button>
                                            &nbsp &nbsp

                                            @if(getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)==0)
                                                بدون تغییر
                                            @elseif( getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)>0 )
                                                <span style="color: #28B463">{{getclassdeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</span>

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
                                            <button class="btn btn-rounded btn-info">{{getpayerank($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</button>
                                            &nbsp &nbsp
                                            @if(getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)==0)
                                                بدون تغییر
                                            @elseif( getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)>0 )
                                                <span style="color: #28B463">{{getpayedeveloop($idk,$mykarnameh->coddars,$id,$mykarnameh->avg)}}</span>

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
                                @endif
                        </tbody>
                    </table>


                </div>
                @if(count($mykarnamehs)>0)

                    <div class="text-right">
                        <br>
                        <p class="font-weight-bolder primary-font">معدل با تاثیر ضریب : <b
                                    style="color: #0a6aa1">
                                {{--{{$moadel}}--}}

                                @if (getavg($idk,$mykarnameh->coddars) >3)
                                    خیلی خوب

                                @elseif (($moadel <= 3) && ($moadel > 2))

                                    خوب
                                @elseif (($moadel <= 2) && ($moadel > 1))
                                    قابل قبول
                                @elseif (($moadel <= 1) && ($moadel > 0))
                                    نیاز به تلاش مجدد
                                @else
                                    {{$moadel}}
                                @endif
                            </b></p>

                    </div>
                @endif

            </div>
            <button class="noprint" onclick="window.print()">پرینت کارنامه</button>
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


