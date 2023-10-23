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
            <h3> مشاهده کارنامه {{$namekarname}}
                درس
                {{\App\dars::where('id',$idd)->pluck('name')->first() }}
            </h3>


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مشاهده کارنامه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$namekarname}}
                        درس
                        {{\App\dars::where('id',$idd)->pluck('name')->first() }}

                    </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <div class="col-md-4 m-t-b-20">
                    <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-12">
                </div>

                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <div style="position: fixed">
                            <thead>
                            <tr style="text-align: center">
                                <th> تصویر {{config('global.student')}}</th>

                                <th class="form-group input-group-text" scope="col">نام نام
                                    خانوادگی {{config('global.student')}}</th>
                                @foreach($cmarks as $cmark)
                                    <th style="text-align: center" class="">{{$cmark->name}}
                                        - {{(\App\CKarnameh::where('item_id',$cmark->id)->where('id_karnameh', $idk)->pluck('percent')->first())*100}}
                                        %
                                    </th>
                                @endforeach


                                <th style="text-align: center">نهایی</th>
                                <th class="input-group-text" scope="col">نام نام
                                    خانوادگی {{config('global.student')}}</th>

                            </tr>
                            </thead>
                        </div>
                        <tbody>
                        <div>


                        </div>
                        @foreach($skarnamehs as $skarname)
                            <tr style="text-align: center">

                                <td>
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->resizeimage))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.auth()->user()->resizeimage)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>
                                </td>

                                <td style="text-align: center">
                                    {{\App\User::where('id' ,$skarname->user_id)->pluck('f_name')->first()}}
                                    - {{\App\User::where('id' ,$skarname->user_id)->pluck('l_name')->first()}}
                                </td>
                                @foreach($cmarks as $mark)
                                    @if(config('global.type_mark')==1)
                                        <td style="text-align: center" class="form-group">


                                            {{\App\MarkItem::where('user_id',$skarname->user_id)->where('item_id',$mark->id)->pluck('mark')->first()}}

                                        </td>

                                    @else

                                        <?php
                                        $mark = \App\MarkItem::where('user_id', $skarname->user_id)->where('item_id', $cmark->id)->pluck('mark')->first();
                                        ?>
                                        <td style="text-align: center" class="form-group">

                                            @if ( $mark>3)
                                                خیلی خوب
                                            @elseif (2 < $mark && $mark <= 3 )
                                                خوب
                                            @elseif (1 < $mark && $mark <= 2 )
                                                قابل قبول
                                            @elseif ($mark <= 1)
                                                نیاز به تلاش مجدد

                                            @endif


                                            {{--{{\App\MarkItem::where('user_id',$skarname->user_id)->where('item_id',$cmark->id)->pluck('mark')->first()}}--}}

                                        </td>
                                    @endif
                                @endforeach
                                @if(config('global.type_mark')==1)

                                <td style="text-align: center;font-size: larger;color: #0000C0">

                                    {{round($skarname->mark,2)}}
                                </td>
                                @else
                                    <td style="text-align: center;font-size: larger;color: #0000C0">
                                        @if ($skarname->mark >3)
                                            خیلی خوب
                                        @elseif (($skarname->mark <= 3) && ($skarname->mark > 2))
                                            خوب
                                        @elseif (($skarname->mark <= 2) && ($skarname->mark> 1))
                                            قابل قبول
                                        @elseif ($skarname->mark <= 1)
                                            نیاز به تلاش مجدد

                                        @endif
                                        @endif
                                        {{--{{round($skarname->mark,2)}}--}}
                                    </td>
                                    </td>
                                    <td style="text-align: center">
                                        {{\App\User::where('id' ,$skarname->user_id)->pluck('f_name')->first()}}
                                        - {{\App\User::where('id' ,$skarname->user_id)->pluck('l_name')->first()}}
                                    </td>

                                    @endforeach

                            </tr>

                            <script src="/js/sweetalert.min.js"></script>

                            @include('sweet::alert')
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection('content')
