@extends('layouts.admin')
@section('css')

@endsection('css')
@section('script')

    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>دروس یک کلاس</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودار مقایسه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">دروس</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="panel-body">
                    <h4><span class="btn btn-success">درس {{$darss}}</span></h4>
                    <h4><span class="btn btn-info">پایه {{$payename}}</span></h4>

                    <div>
                        <div class="row">
                            <div class="panel-body">
                                {!!$chartt->html() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}
    {!! $chartt->script() !!}
@endsection('content')


