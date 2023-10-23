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
            <h3>پیشرفت دروس</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودارها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پیشرفت دروس</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                    <span style="font-family: 'B Koodak'"> رتبه کلی شما در  درس <b>{{$dars}}</b> تا اینجا <b>{{ $rank }}</b>   می باشد </span>
                    <div>
                        <div class="">
                            <div class="panel-body">
                                {!!$marks->html() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Charts::scripts() !!}
    {!! $marks->script() !!}
@endsection('content')
