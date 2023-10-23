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
            <h3>سهم دورس</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودارها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سهم دورس</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

                    <div class="table-responsive">
                        <div class="row">
                            <div class="panel-body">
                                {!!$dayere->html() !!}
                                {!! Charts::scripts() !!}
                                {!! $dayere->script() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>


@endsection('content')