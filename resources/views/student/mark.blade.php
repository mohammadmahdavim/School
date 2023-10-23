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
            <h3> درس {{$dars}}  </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمرات من</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> درس {{$dars}}  </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <span style="text-align: center;font-size: large;color: #1c7430">   درس: {{$dars}}</span>
            <br>
            <br>
            <span style="text-align: center;font-size: large;color: #0F192A">   {{config('global.teacher')}}:آقای

                {{getdabir($id)}}

            </span>

            <div class="table-responsive">
                <table class="table">
                    <thead>


                    <tr>

                        <th style="text-align: center"></th>
                        @foreach($items as $item)
                            <th style="text-align: center">{{$item->name}}</th>
                        @endforeach

                        <th style="text-align: center;color: black">نمره میانگین</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        {{--<td>--}}
                            {{--<button class="btn btn-info">بیشترین نمره این آیتم</button>--}}
                        {{--</td>--}}
                        {{--@foreach($items as $item)--}}
                            {{--<td style="text-align: center"><input class="btn btn-rounded"--}}
                                                                  {{--Style="border-style:solid;background-color: #ddeeee;text-align: center"--}}
                                                                  {{--type="text"--}}
                                                                  {{--readonly value="{{$item->max}}"></td>--}}

                            {{--<td style="text-align: center">20</td>--}}
                        {{--@endforeach--}}
                    </tr>

                    <tr>

                        <td>
                            <button class="btn btn-outline-danger"> نمرات شما</button>
                        </td>
                        @foreach($items as $item)

                            <td style="text-align: center">

                                @if(!empty(\App\MarkItem::where('item_id',$item->id)->where('user_id',$iduser)->pluck('mark')))

                                  <button class="btn btn-info">{{getmark($item->id,$iduser)}}</button>

                            </td>
                            @else
                                <spane style="color: #0000cc"> غیبت موجه</spane>

                            @endif
                        @endforeach
                        <br>

                        <td style="text-align: center"><button class="btn btn-outline-dark btn-rounded">{{$avg}}   </button></td>


                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

@endsection('content')

<?php
function getdabir($dars)
{

    $class = auth()->user()->class;
    $teacherid = \App\teacher::where('dars', $dars)->where('class_id',$class)->pluck('user_id')->first();
    $teacher= \App\User::where('id', $teacherid)->pluck('l_name')->first();

    return $teacher;
}

function getmark($itemid, $iduser)
{

    $mark = \App\MarkItem::where('item_id', $itemid)->where('user_id', $iduser)->pluck('mark')->first();

    return $mark;
}
?>
