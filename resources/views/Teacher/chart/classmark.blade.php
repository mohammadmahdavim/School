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
            <h3>مقایسه کلاس ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودارها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">مقایسه کلاس ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

                                <div class="table-responsive">

                                {!!$chartt->html() !!}
                            </div>
                            </div>
                        </div>


    {!! Charts::scripts() !!}
    {!! $chartt->script() !!}
@endsection('content')