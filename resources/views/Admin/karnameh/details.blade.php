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
    <!-- begin::modal -->
    <script src="/assets/js/examples/modal.js"></script>
    <!-- end::modal -->
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
                    <li class="breadcrumb-item active" aria-current="page">جزییات</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">

            <div style="text-align: left">

                <br>
                <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
                <br>
                {{--<div class="table-wrapper-scroll-y my-custom-scrollbar">--}}
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th> دبیر</th>
                        <th>وضعیت</th>
                        <th>تعداد</th>
                        <th>مشاهده جزییات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($teachers as $teacher )
                        @if(gettypee($id,$teacher->user_id)== 'کامل')
                            <tr style="background-color: #0000C0;color: #FAFCFC">
                        @elseif(gettypee($id,$teacher->user_id)== 'ناقص')
                            <tr style="background-color:#239B56 ;color: #FAFCFC">

                        @else
                            <tr style="background-color: #D02926;color: #FAFCFC">

                                @endif
                                <td style="text-align: center">{{$idn}}</td>
                                <td style="text-align: center">
                                    {{\App\User::where('id',$teacher->user_id)->first()['f_name']}}-
                                    {{\App\User::where('id',$teacher->user_id)->first()['l_name']}}
                                </td>
                                <td style="text-align: center">
                                    <span>{{gettypee($id,$teacher->user_id)}}</span>
                                </td>
                                <td style="text-align: center">
                                    <p><span>{{  getteacher($id,$teacher->user_id)}}</span> از
                                        <span>{{  getall($teacher->user_id)}}</span></p>
                                </td>
                                <td style="text-align: center">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-dark btn-rounded" data-toggle="modal"
                                                data-target="#exampleModalCenter{{$teacher->user_id}}">
                                            نمایش
                                        </button>
                                        <div class="modal fade" id="exampleModalCenter{{$teacher->user_id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle"
                                                            style="color: #0a001f"> {{\App\User::where('id',$teacher->user_id)->first()['f_name']}}
                                                            -
                                                            {{\App\User::where('id',$teacher->user_id)->first()['l_name']}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <?php

                                                    $allclass = \App\teacher::where('user_id', $teacher->user_id)->get();

                                                    ?>
                                                    <div class="modal-body"
                                                         style="color: #0a001f;text-align: center ">
                                                        <table style="color: #0a001f">
                                                            <thead>
                                                            <tr style="color: #0b0b0b;text-align: center">
                                                                <th> درس</th>
                                                                <th>وضعیت</th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($allclass as $allclasss)
                                                                <tr>
                                                                    <td>{{\App\dars::where('id',$allclasss->dars)->first()['name']}}
                                                                        - {{$allclasss->class_id}}</td>
                                                                    <?php
                                                                    $skarna = \App\SKarnameh::where('dars_id', $allclasss->dars)->where('class_id', $allclasss->class_id)->where('karnameh_id', $id)->where('teacher_id', $teacher->user_id)->first();
                                                                    ?>
                                                                    @if(empty($skarna))
                                                                        <td style="color: #bb1111">ارسال نشده است.</td>
                                                                    @else
                                                                        <td style="color: #0000C0">ارسال شده است.</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">بستن
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<script>
    $(function () {
        $('.toggle-class').change(function () {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/admin/changeStatus',
                data: {'status': status, 'user_id': user_id},
                success: function (data) {
                    console.log(data.success)
                }
            });
        })
    })
</script>
<?php

function getteacher($id, $teacherr)
{

    $classids = \App\teacher::where('user_id', $teacherr)->get();
    $n = 0;
    foreach ($classids as $classid) {
        $skarna = \App\SKarnameh::where('dars_id', $classid->dars)->where('class_id', $classid->class_id)->where('karnameh_id', $id)->where('teacher_id', $teacherr)->first();
        if ($skarna){
            $n = $n + 1;

        }
    }
    return  $n;

}

function getall($id)
{
    $classid = \App\teacher::where('user_id', $id)->count();
    return $classid;

}

function gettypee($id, $teacherr)
{

    $classids = \App\teacher::where('user_id', $teacherr)->get();
    $n = 0;
    foreach ($classids as $classid) {
        $skarna = \App\SKarnameh::where('dars_id', $classid->dars)->where('class_id', $classid->class_id)->where('karnameh_id', $id)->where('teacher_id', $teacherr)->first();
        if ($skarna){
            $n = $n + 1;

        }
    }
    $darsn = \App\teacher::where('user_id', $teacherr)->count();
    $ns = $darsn - $n;
    if ($ns == 0) {
        $type = 'کامل';
    } elseif ($ns == $darsn) {
        $type = 'بدون ارسال';
    } else {
        $type = 'ناقص';
    }
    return $type;
}
?>
