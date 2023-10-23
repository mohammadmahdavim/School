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
            <h3> پیش نمایش کارنامه {{$namekarname}}
                درس
                {{\App\dars::where('id',$darsid)->first()['name'] }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">پیش نمایش کارنامه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$namekarname}}
                        درس
                        {{\App\dars::where('id',$darsid)->first()['name'] }}

                    </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('header')
    <div class="page-header">
        <div>
            <h3>کارنامه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کارنامه</a></li>
                    <li class="breadcrumb-item active" aria-current="page"></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-md-4 m-t-b-20">
                        <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-12">
                    </div>
                    <div class="col-md-8 m-t-b-20" style="text-align: left">
                        <a href="/teacher/karnameh/create/{{$idk}}/{{$idc}}/{{$darsid}}">
                            <button class="btn btn-success">بازگشت به صفحه درصد</button>
                        </a>
                    </div>
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
                                        - {{(\App\CKarnameh::where('item_id',$cmark->id)->where('id_karnameh',$idk)->pluck('percent')->first())*100}}
                                        %
                                    </th>
                                @endforeach


                                <th style="text-align: center">نمره نهایی</th>
                                <th class="input-group-text" scope="col">نام نام
                                    خانوادگی {{config('global.student')}}</th>

                            </tr>
                            </thead>
                        </div>
                        <tbody>
                        <div>


                        </div>
                        @foreach($marks as $mark)
                            <form action="{{url('teacher/ckarnameh/student') . '/' . $idk }}" method="post">

                                <input class="form-control" type="hidden"
                                       name="idclass" id="idclass" value="{{$idc}}">
                                <input class="form-control" type="hidden"
                                       name="iddars" id="iddars" value="{{$darsid}}">

                                {{csrf_field()}}
                                @include('Admin.errors')


                                <tr style="text-align: center">

                                    <td>
                                        <div class="gallery">
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
                                        </div>
                                    </td>

                                    <td>
                                        <li id="user_id" style="background-color: #a8e4ff"
                                            class="form-control input-group-text"
                                            value="{{$mark->id}}">{{\App\User::where('id' ,$mark->user_id)->first()['f_name']}}
                                            - {{\App\User::where('id' ,$mark->user_id)->first()['l_name']}}</li>
                                    </td>
                                    @foreach($cmarks as $cmark)
                                        @if(config('global.type_mark')==1)

                                            <td style="text-align: center">


                                                {{\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first()}}

                                            </td>
                                        @else
                                            <td style="text-align: center">

                                                @if (\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() >3)
                                                    خیلی خوب

                                                @elseif ((\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() <= 3) && (\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() > 2))

                                                    خوب
                                                @elseif ((\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() <= 2) && (\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() > 1))
                                                    قابل قبول
                                                @elseif ((\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() <= 1) && (\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first() > 0))
                                                    نیاز به تلاش مجدد

                                                @endif
                                                {{--<!--{{\App\MarkItem::where('user_id',$mark->user_id)->where('item_id',$cmark->id)->pluck('mark')->first()}}-->--}}

                                            </td>
                                        @endif
                                    @endforeach

                                    <td style="text-align: center;font-size: larger;color: #0000C0">
                                        @if(config('global.type_mark')==1)

                                            {{$allmark[$mark->user_id]}}
                                        @else
                                            @if ($allmark[$mark->user_id] >3)
                                                خیلی خوب

                                            @elseif (($allmark[$mark->user_id] <= 3) && ($allmark[$mark->user_id]> 2))
                                                خوب
                                            @elseif (($allmark[$mark->user_id] <= 2) && ($allmark[$mark->user_id]> 1))
                                                قابل قبول
                                            @elseif ($allmark[$mark->user_id]<= 1)
                                                نیاز به تلاش مجدد

                                            @endif
                                        @endif

                                        <input style="text-align: center;font-size: larger;color: #0000C0"
                                               id="mark-{{$mark->user_id}}" name="mark-{{$mark->user_id}}"
                                               class="input-group-text" value="{{round($allmark[$mark->user_id],2)}}"
                                               required type="hidden">

                                    </td>

                                    <td>
                                        <li id="user_id" style="background-color: #a8e4ff"
                                            class="form-control input-group-text"
                                            value="{{$mark->id}}">{{\App\User::where('id' ,$mark->user_id)->first()['f_name']}}
                                            - {{\App\User::where('id' ,$mark->user_id)->first()['l_name']}}</li>
                                    </td>

                                    @endforeach

                                </tr>
                                <div class="form-group">


                                    <button class="btn btn-info" type="submit">ثبت نهایی کارنامه
                                    </button>

                                </div>

                            </form>
                            <script src="/js/sweetalert.min.js"></script>

                            @include('sweet::alert')
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection('content')
