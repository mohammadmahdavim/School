@extends('layouts.teacher')
@section('css')
@endsection('css')
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>نمودار پیشرفت کلاس</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودارها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمودار پیشرفت کلاس</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <h4><span class="btn btn-danger">کلاس {{$idclassT}} -
                 درس
                 {{$darsname}} </span></h4>

                {!!$chartt->html() !!}
            </div>
        </div>
    </div>


    {!! Charts::scripts() !!}
    {!! $chartt->script() !!}

@endsection('content')