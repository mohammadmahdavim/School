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
            <h3>مقایسه دروس</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودار مقایسه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کلاس {{$id}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">

                <h4><span class="btn btn-success">کلاس {{$id}}</span></h4>

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