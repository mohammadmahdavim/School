@extends('layouts.admin')
@section('css')

@endsection('css')
@section('script')

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
            <h3>لیست {{config('global.students')}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست {{config('global.students')}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <br>
<a href="/admin/exam/downloadExcel/{{$examid}}/{{$class}}"><button class="btn btn-dark">خروجی اکسل</button></a>
            <br>

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed" >
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نمره</th>
                        <th>مشاهده جزییات</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $idn = 1; ?>
                        @foreach($marks as $mark)
                            <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$mark->user->f_name}}</td>
                            <td>{{$mark->user->l_name}}</td>
                            <td>
                                @if(config('global.type_mark')==1)

                                {{round($mark->mark,2)}}

                                @else
                                    @if ($mark->mark >3)
                                        خیلی خوب

                                    @elseif (($mark->mark <= 3) && ($mark->mark > 2))

                                        خوب
                                    @elseif (($mark->mark <= 2) && ($mark->mark > 1))
                                        قابل قبول
                                    @elseif (($mark->mark <= 1) && ($mark->mark > 0))
                                        نیاز به تلاش مجدد
                                    @else
                                        {{$mark->mark}}
                                    @endif
                                @endif
                            </td>


                                <td><a href="/admin/exam/student/single/{{$mark->user->id}}/{{$mark->exam_id}}"><button class="btn btn-primary">کلیک کنید</button></a></td>

                    </tr>
                    <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('content')

