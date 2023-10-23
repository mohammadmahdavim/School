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
            <h3>مقایسه نمرات</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودار</a></li>
                    <li class="breadcrumb-item active" aria-current="page">مقایسه نمرات</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

{{--فعلا بیخالش--}}
            {{--<form action="/student/chartmarkrender" method="post">--}}

                {{--{{csrf_field()}}--}}
                {{--<label> انتخاب درس برای مشاهده نمودار</label>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-3">--}}
                        {{--<br>--}}

                        {{--<select id="dars" name="dars" class="select2-dropdown form-control">--}}

                            {{--@foreach($doros as $dars)--}}

                                {{--<option value="{{$dars->id}}"> درس {{$dars->name}} </option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-5">--}}
                        {{--<br>--}}
                        {{--<button class="btn btn-success">اعمال درس</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}
            <div class="table-responsive">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <div class="row">
                                <div class="panel-body">
                                    {!!$mark->html() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}

    {!! $mark->script() !!}
@endsection('content')