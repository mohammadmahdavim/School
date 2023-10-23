@extends('layouts.teacher')
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
            <h3>مقایسه نمرات {{config('global.students')}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودارها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">مقایسه نمرات {{config('global.students')}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <h4><span class="btn btn-danger">کلاس {{$id}}</span></h4>
                <div class="text-body">
                    <h3>
                        <span class="btn btn-success"> شما تا الان برای این کلاس <span style="font-size: large;color: #0000cc"> &nbsp{{$itemcount}}  آیتم &nbsp </span>مشخص کرده اید و میانگین نمرات {{config('global.students')}} به این صورت می باشد.  </span>
                    </h3>
                </div>
                {!!$chartt->html() !!}
            </div>
        </div>
    </div>

    {!! Charts::scripts() !!}
    {!! $chartt->script() !!}
@endsection('content')
