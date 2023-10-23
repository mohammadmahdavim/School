@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')
@section('css')
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

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>تکالیف ارسال کرده</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تکالیف</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تکالیف ارسال کرده کلاس {{$id}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success">
                        <th>شمارنده</th>

                        <th>کلاس</th>
                        <th>درس</th>
                        <th>عنوان</th>

                        <th>تاریخ ارسال</th>
                        <th>تاریخ اتمام فرصت</th>
                        <th>درصد تحویل {{config('global.students')}} این کلاس</th>
                        <th>دانلود تمرین</th>
                        <th>دانلود پاسخ تمرین</th>
                        <th>نمایش توضیحات</th>
                        <th>حذف</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($tamrin as $tamrinn )
                        <tr>
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$tamrinn->class_id}}</td>
                            <td>{{$tamrinn->dars}}</td>

                            <td>{{$tamrinn->title}}</td>
                            <td>{{ $tamrinn->created_at->toDateString() }}</td>
                            <td><span style="font-family: B Titr">{{getexpire($tamrinn->expire)}} </span></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         style="width:{{getbar($idclas,$tamrinn->id)}}%;" aria-valuenow="25"
                                         aria-valuemin="0"
                                         aria-valuemax="100">{{  getbar($idclas,$tamrinn->id)}}
                                        %
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('books.download', $tamrinn->id) }}" class="btn btn-outline-warning">
                                    <i class="icon-download"></i> Download </a>
                            </td>
                            @if($tamrinn->pmime)
                            <td>
                                <a href="{{ route('jtamrinteacher.download', $tamrinn->id) }}"
                                   class="btn btn-outline-warning">
                                    <i class="icon-download"></i> Download </a>
                                <br>

                                <label
                                        for="materialUnchecked{{$tamrinn->id}}">اجازه نمایش
                                </label>
                                &nbsp &nbsp
                                <input style="text-align: center"
                                       type="checkbox"
                                       class="form-check-input"
                                       id="materialUnchecked{{$tamrinn->id}}"
                                       {{ $tamrinn->status ? 'checked' : '' }} onclick="toggless('{{$tamrinn->id}}',this) ">
                            </td>
                                @else
                                <td>
                                    پاسخی آپلود نکردید.
                                </td>
                            @endif
                            <td><a href="/teacher/tamrin/show/{{$tamrinn->id}}">
                                    <button class="btn btn-info">کلیک کنید</button>
                                </a></td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteData({{$tamrinn->id}})"><i
                                            class="icon-trash"></i></button>
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>



@endsection('content')
<?php

function getexpire($expire)
{

    $date = explode('-', $expire);
    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
    $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
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


//        if ($days >= 1) {
//            return $days . " " . 'روز مانده';
//        } elseif ($days == 0) {
//            return 'تا ساعت دوازده امشب فرصت باقی مانده است';
//        }


//$a=\Illuminate\Support\Carbon::now();
}

function getbar($idclas, $tamrinn)

{
    $contst = \App\student::where('classid', $idclas)->count();
    $answercount = \App\JTamrin::where('tamrin_id', $tamrinn)->count();
    $percent = round(($answercount / $contst) * 100);
    return $percent;


}

?>
<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود از باکس {{config('global.students')}} نیز حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/tamrin/Delete/')  }}" + '/' + id,
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

    function toggless(id, obj) {
        var $input = $(obj);
        var status = 0;
        if ($input.prop('checked')) {
            var status = 1;
        }

        $.ajaxSetup({

            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: '{{url('/teacher/tamrin/changeStatus')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "نمایش پاسخ تمرین برای همه فعال شد",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "نمایش پاسخ تمرین  غیر فعال شد",
                        icon: "success",

                    });
                }
            }
        })


    }

</script>
