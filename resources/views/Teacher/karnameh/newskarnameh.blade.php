@extends('layouts.teacher')
@section('css')
    <style>
        @media print {
            .noprint {
                visibility: hidden;
                display: none;

            }
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
            <h3>کارنامه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت کارنامه ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        کارنامه {{$mykarnamehs[0]->user->l_name}}
                        - {{$mykarnamehs[0]->user->f_name}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <p style="text-align: center;font-size: x-large;color: black">{{$mykarnamehs[0]->name}}</p>
            <p style="text-align: right;font-size: x-large;color: black">{{$mykarnamehs[0]->user->l_name}}
                - {{$mykarnamehs[0]->user->f_name}}</p>

            <div class="table-responsive">

                <table class="table m-t-b-50">
                    <thead>
                    <tr class="bg-dark text-white">
                        <th>#</th>
                        <th>نام درس</th>
                        <th>واحد</th>
                        <th>نمره</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1 ?>
                    @foreach($mykarnamehs as $mykarnameh)
                        @if(($mykarnameh->mark)<10)
                            <tr style="background-color: red">

                        @else
                            <tr>

                                @endif

                                <td>{{$idn}}</td>

                                <td>{{$mykarnameh->dars->name}}</td>
                                <td>{{$mykarnameh->dars->vahed}}</td>
                                <td style="color: black">{{($mykarnameh->mark)}}</td>
                            </tr>
                            <?php $idn = $idn + 1; ?>
                            @endforeach
                    </tbody>
                </table>


            </div>
            <div class="text-right">
                <p class="font-weight-bolder primary-font">معدل با تاثیر ضریب : <b
                            style="color: #0a6aa1">{{$moadel}}</b></p>

            </div>
            <br>
            <button class="noprint btn btn-primary" onclick="window.print()">پرینت کارنامه</button>
        </div>

    </div>

@endsection('content')



