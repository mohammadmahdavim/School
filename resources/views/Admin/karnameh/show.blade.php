@extends('layouts.admin')
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

    <script>
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
                url: '{{url('/admin/changeStatus')}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: status,
                    "id": id
                },
                success: function (data) {
                    if (status == 1) {
                        swal({
                            title: "نمایش کارنامه برای دبیران فعال شد",
                            icon: "success",

                        });
                    }
                    if (status == 0) {
                        swal({
                            title: "نمایش کارنامه برای دبیران غیر فعال شد",
                            icon: "success",

                        });
                    }
                }
            })


        }
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
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="/admin/students.create">
                <button class="btn btn-info">ایجاد درخواست جدید</button>
            </a>
            <div style="text-align: left">

                <br>
                <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
                <br>
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr style="text-align: center">
                            <th>شمارنده</th>
                            <th> نام کارنامه</th>
                            <th>درصد ایجاد</th>
                            <th>اجازه ایجاد</th>
                            <th>مشاهده جزییات</th>
                            <th>حذف</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $idn = 1; ?>
                        @foreach($karnamehs as $karnameh )
                            <tr>
                                <td style="text-align: center">{{$idn}}</td>
                                <td style="text-align: center">
                                    {{$karnameh->name}}
                                </td>
                                <td style="text-align: center">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             style="width:{{getbar($karnameh->id)}}%;" aria-valuenow="25"
                                             aria-valuemin="0" aria-valuemax="100">{{  getbar($karnameh->id)}}
                                            %
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center">

                                    <input style="text-align: center" type="checkbox" class="form-check-input"
                                           id="materialUnchecked"
                                           {{ $karnameh->status ? 'checked' : '' }} onclick="toggless('{{$karnameh->id}}',this) ">
                                </td>
                                <td style="text-align: center">
                                    <a href="/admin/karnameh/show/details/{{$karnameh->id}}">
                                        <button class="btn btn-info btn-rounded">نمایش</button>
                                    </a>
                                </td>
                                <td style="text-align: center">


                                    <div>

                                        <button class="btn btn-danger" onclick="deleteData({{$karnameh->id}})"><i
                                                class="ti-trash"></i>
                                        </button>


                                    </div>

                                </td>

                            </tr>
                            <?php $idn = $idn + 1 ?>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection('content')

<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام دیتای مرتبط با آن حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/karnameh/destroy/')}}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "درخواست کارنامه حذف گردید!",
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


<?php
function getbar($id)
{
    $classids = \App\teacher::all();
    $n = 0;
    foreach ($classids as $classid) {
        $skarna = \App\SKarnameh::where('dars_id', $classid->dars)->where('class_id', $classid->class_id)->where('karnameh_id', $id)->first();
        if ($skarna) {
            $n = $n + 1;

        }
    }
    if ($classids->count() > 0) {
        $n = round(($n / $classids->count()) * 100, 1);

    }
    return $n;
}
?>
