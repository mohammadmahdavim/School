@extends('layouts.student')
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
            <h3>آزمون های شما </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">آزمون های شما</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')

    <div class="card">
        <div class="card-body">


            <br>

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان آزمون</th>
                        <th>نوع آزمون</th>
                        <th>درس</th>
                        <th>زمان پاسخدهی</th>
                        <th>تاریخ پایان</th>
                        <th>ساعت شروع</th>
                        <th>نمره</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($exams as $exam)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$exam->title}}</td>
                            <td>
                                @if($exam->type==0)
                                    تستی
                                @else
                                    تشریحی
                                @endif
                            </td>
                            <td>{{$exam->examclass[0]->darsname->name}}</td>
                            <td>{{$exam->time}} دقیقه</td>
                            <td>
                                <button type="text" id="mark4" name="mark4"
                                        @if(getexpire($exam) == 'پایان فرصت') class="btn btn-danger"
                                        @else class="btn btn-success" @endif >{{getexpire($exam)}}
                                </button>
                            </td>
                            <td>{{ $exam->start }}</td>
                            <td>
                                @if($exam->status==1)

                                    @if(!empty($exam->mymarks[0]))
                                        @if(config('global.type_mark')==1)

                                            <span style="color: black">{{round($exam->mymarks[0]->mark,2)}}</span>
                                        @else
                                            @if ($exam->mymarks[0]->mark >config('global.mark1'))
                                                خیلی خوب

                                            @elseif (($exam->mymarks[0]->mark <= config('global.mark1')) && ($exam->mymarks[0]->mark > config('global.mark2')))

                                                خوب
                                            @elseif (($exam->mymarks[0]->mark <= config('global.mark2')) && ($exam->mymarks[0]->mark > config('global.mark3')))
                                                قابل قبول
                                            @elseif (($exam->mymarks[0]->mark <= config('global.mark3')) && ($exam->mymarks[0]->mark > 0))
                                                نیاز به تلاش مجدد
                                            @else
                                                {{$exam->mymarks[0]->mark}}
                                            @endif
                                        @endif
                                    @endif
                                @endif


                            </td>
                            <td>
                                @if($exam->status==1 )
                                    <a href="/student/exam/view/{{$exam->id}}">
                                        <button class="btn btn-warning">مشاهده پاسخ ها</button>
                                    </a>
                                @elseif($exam->finish->where('user_id',$iduser)=='[]')
                                    <a href="/student/takeexam/{{$exam->id}}">
                                        <button class="btn btn-primary"> آزمون دهید</button>
                                    </a>
                                @else
                                    <button class="btn btn-info">شرکت کردید</button>
                                @endif
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            {{--{{ $exams->links() }}--}}

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('content')


<script>

</script>
<?php
function getexpire($exam)
{
    $expire = $exam->expire;
    $date = explode('/', $expire);
    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
    $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';

    if ($exam->texprie != null) {
        $gregorian = implode('-', $toGregorian) . ' ' . $exam->texprie;

    }
    $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
    $nowTimestamp = \Morilog\Jalali\Jalalian::forge("now")->getTimestamp();

    if ($dateEx >= $nowTimestamp) {


        $time = $dateEx - time(); // to get the time since that moment

        $tokens = array(
            31536000 => 'سال',
            2592000 => 'ماه',
            604800 => 'هفته',
            86400 => 'روز',
            3600 => 'ساعت',
            60 => 'دقیقه',
            1 => 'ثانیه'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);

            return $numberOfUnits . ' ' . $text . ' مانده';
        }

    } else {

        return 'پایان فرصت';
    }

}


?>
<script>
    // function start(id){
    //     swal({
    //         title: "آیا مطمئن هستید میخواهید آزمون را شروع کنید؟",
    //         text: "با شروع آزمون زمان محاسبه شده و فقط یک بار مجاز به آزمون دادن هستید!!!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //
    //         .then((willDelete) => {
    //             if (willDelete) {
    //                 $.ajax({
    //                     url: "takeexam" + '/' + 56,
    //                     type: "GET",
    //
    //                     success: function () {
    //
    //                         window.location = "/student/takeexam".id;
    //                     }
    //                     });
    //
    //
    //             } else {
    //                 swal("عملیات  لغو گردید");
    //             }
    //         });
    //
    //
    // }
</script>

