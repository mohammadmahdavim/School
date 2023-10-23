@extends('layouts.student')
@section('css')
@endsection('css')
@section('script')
    <script>
        submitformDatekarnameh = function () {
            var data = $('#datek').serialize();
            $.ajaxSetup({

                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#karnamehrender').html('');


            $.ajax({
                url: '{{url('/student/karnameh/render/month')}}',
                type: 'post',
                data: data,
                success: function (data) {
                    $('#karnamehrender').html(data);


                },
                error: function () {
                    alert("error!!!!");
                }
            })

        }


    </script>

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>معدل</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمودارها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">معدل</li>
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
                        {!!$chartt->html() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Charts::scripts() !!}
    {!! $chartt->script() !!}
@endsection('content')