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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت صفحه اول سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
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