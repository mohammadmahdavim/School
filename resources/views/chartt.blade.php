@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chart Demo</div>

                    <div class="panel-body">
                        {{--{!! $chart->html() !!}--}}
                    </div>
                    <div class="panel-body">
                        {!! $chartt->html() !!}
                    </div>
                    <hr>
                    {!!$pie->html() !!}
                    <hr>
                    {!!$piee->html() !!}
                    <hr>
                    {!!$dayere->html() !!}
                    <hr>
                    {!!$tamrinss->html() !!}
                    <hr>
                </div>
            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}
    {{--{!! $chart->script() !!}--}}
    {!! $chartt->script() !!}

    {!! $pie->script() !!}
    {!! $piee->script() !!}
    {!! $dayere->script() !!}
    {!! $tamrinss->script() !!}

@endsection