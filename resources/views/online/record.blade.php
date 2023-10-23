@extends('layouts.profile')
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
            <br>
            <h3>فیلم های ضبط شده </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کلاس ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">فیلم های ضبط شده کلاس {{$class->title}} </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان کلاس</th>
                        <th>درس</th>
                        <th>تاریخ کلاس</th>
                        <th>تایم</th>
                        {{--                        <th>حجم</th>--}}
                        <th>ورود</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($urls as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">{{$class->title}}</td>
                            <td style="text-align: center">{{$class->dars}}</td>
                            <td style="text-align: center">{{\Morilog\Jalali\Jalalian::fromDateTime(\Illuminate\Support\Carbon::createFromTimestamp(round($row['startTime']/1000)))   }}</td>
                            <td style="text-align: center">{{round(($row['endTime']-($row['startTime']))/3600)}}ثانیه
                            </td>
                            <td style="text-align: center">
                                <a target="_blank" href="{{$row['playback']['format']['url']}}">
                                    <button class="btn btn-info">ورود</button>
                                </a>
                            </td>
                    </tr>

                    <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')
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
                        url: "{{  url('/teacher/online/Delete/')  }}" + '/' + id,
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


