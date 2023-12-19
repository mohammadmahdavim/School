@extends('layouts.admin')
@section('css')
    <style>
        @media print {
            .noprint {
                visibility: hidden;
                display: none;
            }
        }

        @page {
            margin: 0;
        }
        .page-break {
            page-break-before: always;
        }
        #printContent {
            display: block;
        }
    </style>
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>کارت ورود به جلسه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کارت ورود به جلسه</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="page-break"></div>

    <div class="card" id="printContent">
        <div class="card-body">
            <div class="card">
                <div class="card-body border">
                    {{--                        <p style="text-align: center;font-size: medium;color: black"> کارنامه ماهانه {{$KarnamehName}}</p>--}}
                    <div class="d-flex justify-content-between">
                        <div class="p-2">
                            <img src="{{'/uploads/'.\App\Setting::first()->logo}}" height="100px" width="100px">

                        </div>
                        <div class="p-2">
                            <p style="text-align: center;font-size: medium;color: black">
                                @include('includ.name')
                                <br>
                                سال تحصیلی:1402-1403
                                <br>
کارت ورود به جلسه                            </p>
                        </div>
                        <?php

                        ?>
                        <div class="p-2">
                            <figure class="avatar avatar-xl">
                                @if(!empty($user->filename))
                                    <img class="rounded-circle"
                                         src="{{url('uploads/'.$user->filename)}}"
                                         alt="...">
                                @else
                                    <img class="rounded-circle" src="/assets/profile/avatar.png"
                                         alt="...">
                                @endisset
                            </figure>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-3">
                            نام:
                            {{$user->f_name}}
                            <br>
                            نام خانوادگی:
                            {{$user->l_name}}


                        </div>
                        <div class="col-6" style="text-align: center">

                            شماره دانش آموزی:
                            {{$user->shomarande}}

                            <br>
                            پایه:
                            {{$user->paye}}


                        </div>
                        <div class="col-3">
                            <?php
                            $class = \App\clas::where('classnamber', $user->class)->first();
                            ?>
                            رشته تحصیلی:
                            {{$class->reshte}}
                            <br>
                            کلاس:
                            {{$class->description}}

                        </div>
                    </div>

                </div>
            </div>

            <button class="noprint btn btn-primary" onclick="window.print()">پرینت </button>
        </div>

    </div>

@endsection('content')


