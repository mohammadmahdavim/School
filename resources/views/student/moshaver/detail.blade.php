@extends('layouts.student')
@section('css')

@endsection('css')
@section('script')

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <br>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">جلسه ها </a></li>
                    <li class="breadcrumb-item active" aria-current="page">جزییات</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">


            <div class="row">
                <div style="text-align: right" class="col-md-6">
                    <b>نام دبیر: </b>{{$row->user->f_name}} {{$row->user->l_name}}
                </div>

            </div>
            <br>
            <!-- /mail toolbar -->


            <!-- Mail details -->
            <div class="media stack-media-on-mobile mail-details-read">


                <div class="media-body">
                    <div class="letter-icon-title text-semibold"><b> عنوان جلسه: </b>{{ $row->title}}
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div style="text-align: right">
                <label style="font-family: 'B Koodak';font-size: medium;text-align: right">
                    <b>
                        پیام شخصی شما:</b>
                    <br>
                    @if($comment)

                        {{$comment->comment	}}
                    @else
                        پیامی ندارید
                    @endif
                </label>
            </div>
            <br>


            <!-- /mail details -->

            <hr>

            <!-- Mail container -->
            <div style="text-align: right">
                <label style="font-family: 'B Koodak';font-size: medium;text-align: right">توضیحات جلسه:</label>
                <br>

                {!! $row->description !!}

            </div>


        </div>
    </div>
@endsection

