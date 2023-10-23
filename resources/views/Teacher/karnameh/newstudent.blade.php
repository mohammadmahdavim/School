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
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection('css')
@section('script')
    <script src="/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت کارنامه ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> کارنامه {{config('global.students')}} کلاس
                    {{$class}}
                    </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            {{--            <p style="text-align: center;font-size: x-large;color: black">{{\App\RKarnameh::where('id',$idk)->first()['name']}}</p>--}}

            <div style="text-align: right">
                <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
                <br>
                <div class="table-responsive">
                    <table class="table  table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr style="text-align: center">
                            <th>#</th>
                            <th>عکس</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>معدل</th>
                            <th>جزییات کارنامه</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php $idn = 1 ?>
                        @foreach($students as $student )


                            <tr style="text-align: center">
                                <td>{{$idn}}</td>
                                <td>
                                    <div class="gallery">
                                        <figure class="avatar avatar-sm avatar-state-success">
                                            @if($student->filename)
                                                <img class="rounded-circle"
                                                     src="{{url('uploads/'.$student->filename)}}" alt="...">
                                            @else
                                                <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                     alt="...">
                                            @endisset
                                        </figure>
                                    </div>

                                </td>
                                <td>{{$student->f_name}}</td>
                                <td>{{$student->l_name}}</td>
                                <?php
                                $vaheds = 0;
                                $marks = 0;
                                if ($student->karnameadmin != '[]') {
                                    foreach ($student->karnameadmin as $karnameh) {
                                        $vahed = $karnameh->dars->vahed;
                                        $mark = $vahed * $karnameh->mark;
                                        $vaheds = $vaheds + $vahed;
                                        $marks = $marks + $mark;
                                        if ($vaheds == 0) {
                                            $moadel = 0;
                                        } else {
                                            $moadel = round($marks / $vaheds, 2);
                                        }
                                    }
                                } else {
                                    $moadel = 'نمره ای وجود ندارد.';
                                }
                                ?>
                                <td style="color: #1d68a7;font-size: large">

                                    {{$moadel}}

                                </td>
                                <td>
                                    @if($student->karnameadmin!='[]')
                                        <a href="/teacher/karnameh/newstudent/show/{{$student->karnameadmin[0]->name}}/{{$student->id}}/{{$moadel}}">
                                            <button class="btn btn-info btn-rounded">مشاهده</button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <?php $idn = $idn + 1 ?>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
            <br>
            <button class="noprint btn btn-primary" onclick="window.print()">پرینت کارنامه</button>

        </div>
    </div>
@endsection('content')


