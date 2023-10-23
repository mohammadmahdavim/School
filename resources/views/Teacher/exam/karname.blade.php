@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')

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
            <h3>نمرات آزمون {{$exam->title}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمرات آزمون {{$exam->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <br>
            <a href="/teacher/exam/karnameExport/{{$exam->id}}">
                <button class="btn btn-outline-danger">خروجی اکسل</button>
            </a>
            <br>
            <br>
            <div style="overflow-x:auto;">
                <table class="table table-bordered  mb-0 table-fixed">
                    <thead>
                    <tr class="success" style="text-align: center;color: black">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>کلاس</th>
                        <th>نمره</th>
                        <th>رتبه</th>
                        <th>میانگین</th>
                        <th>بالاترین</th>
                        <th>پایین ترین</th>

                        @foreach($doros as $dars)
                            <th style="background-color: forestgreen">نمره {{$dars->name}}</th>
                            <th>رتبه {{$dars->name}}</th>
                            <th>میانگین {{$dars->name}}</th>
                            <th>بالاترین {{$dars->name}}</th>
                            <th>پایین ترین {{$dars->name}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody style="color: black">
                    <?php $idn = 1; ?>
                    @foreach($examMarks->where('dars_id','کل') as $mark)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td style="background-color: lightblue">{{$mark->user->f_name}}</td>
                            <td style="background-color: lightblue">{{$mark->user->l_name}}</td>
                            <td style="background-color: lightblue">{{$mark->user->class}}</td>
                            <td style="background-color: lightblue">{{round($mark->mark,2)}}</td>
                            <td style="background-color: lightblue">{{getRanking($mark->user_id,$mark->exam_id,$mark->dars_id)}}</td>
                            <td style="background-color: lightblue">{{round($average,2)}}</td>
                            <td style="background-color: lightblue">{{round($top,2)}}</td>
                            <td style="background-color: lightblue">{{round($min,2)}}</td>
                            @foreach($doros as $dars)
                                <td style="background-color: forestgreen">
                                    @if($examMarks->where('dars_id',$dars->id)->where('user_id',$mark->user_id)!='[]')
                                        {{$examMarks->where('dars_id',$dars->id)->where('user_id',$mark->user_id)->pluck('mark')->first()}}
                                    @else
                                        0
                                @endif

                                <td>
                                    {{getRanking($mark->user_id,$mark->exam_id,$dars->id)}} </td>
                                <td>
                                    {{$examMarks->where('dars_id',$dars->id)->avg('mark')}}

                                </td>
                                <td>
                                    {{$examMarks->where('dars_id',$dars->id)->max('mark')}}
                                </td>
                                <td>
                                    {{$examMarks->where('dars_id',$dars->id)->min('mark')}}
                                </td>

                            @endforeach
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
<?php
function getRanking($id, $exam, $dars)
{
    $collection = \App\ExamMark::where('exam_id', $exam)->where('dars_id', $dars)->orderBy('mark', 'DESC')->get();
    $mark = \App\ExamMark::where('user_id', $id)->where('exam_id', $exam)->where('dars_id', $dars)->pluck('mark')->first();
    $data = $collection->where('mark', $mark);
    $value = $data->keys()->first() + 1;

    return $value;
}

?>
<script>

    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام سوالات و جواب های مرتبط حذف می گردد!!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/exam/delete/')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "حذف با موفقیت انجام شد!",
                                icon: "success",

                            });
                            window.location.reload(true);
                        },
                        error: function () {
                            swal({
                                title: "خطا...",
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })

                        }
                    });
                } else {
                    swal("عملیات حذف لغو گردید");
                }
            });

    }

</script>
