@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
@endsection('css')
@section('script')
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <script>
        jQuery(document).ready(function () {
            jQuery('#hideshow').on('click', function (event) {
                jQuery('#search').toggle('show');
            });
        });
    </script>
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>
                نمایش کتابخانه
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کتاب های در دست امانت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <input type='button' class="btn btn-primary" id='hideshow' value='جستجوی پیشرفته'>
            <div id='search'  style="display: none">
                <form method="get" action="/admin/library/intrust">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <input class="form-control" id="issue" name="issue" value="{{request()->issue}}"
                                   placeholder="شماره کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="name" name="name" value="{{request()->name}}"
                                   placeholder="نام کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="user" name="user" value="{{request()->user}}"
                                   placeholder="امانت گیرنده کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                          <select name="tamdid" class="form-control">
                              <option >تمدید</option>
                              <option @if(request()->tamdid==1) selected @endif value="1">بله</option>
                              <option @if(request()->tamdid==2) selected @endif value="2">خیر</option>
                          </select>
                        </div>
                        <div class="p-2">
                            <input type="text" name="start_date" id="date-picker-shamsi-list"
                                   class="form-control text-right"
                                   value="{{request()->start_date}}" placeholder="تاریخ دریافت از ..." autocomplete="off">
                            <br>
                            <input class="form-control date-picker-shamsi"  name="end_date"
                                   value="{{request()->end_date}}"
                                   placeholder="تاریخ دریافت تا ..." autocomplete="off">
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>شماره کتاب</th>
                        <th>نام</th>
                        <th>امانت گیرنده</th>
                        <th>تمدید کرده؟</th>
                        <th>تاریخ دریافت</th>
                        <th>مهلت برگشت</th>

                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($data as $row)
                        <tr class="form-group" STYLE="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->issue}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->f_name}}-{{$row->l_name}}</td>
                            <td>
                                @if($row->count==1 )
                                    بله
                                @else
                                    خیر
                                @endif
                            </td>
                            <td>{{$row->created_at}}</td>
                            <td>
                                @if(($row->expire) >= $date)

                                    <button type="text"
                                            class="btn btn-success"
                                    >{{getexpire($row->expire)}}
                                    </button>
                                @else
                                    <button type="text"
                                            class="btn btn-danger"
                                    >{{getexpire($row->expire)}}
                                    </button>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(($row->expire) <= $date)
                                    <form method="post" action="/admin/library/fines">
                                        @csrf
                                        <input name="library_id" value="{{$row->library_id}}" hidden>
                                        <input name="user_id" value="{{$row->user_id}}" hidden>
                                        <input name="day" value="{{getday($row->expire)}}" hidden>
                                        <button title="محاسبه جریمه" class="btn btn-danger btn-rounded">جریمه</button>
                                    </form>
                                @endif
                                @if(count(\App\Reservation::where('library_id',$row->library_id)->where('status',1)->get())>0)
                                    <button type="button" title="رزرو شده" class="btn btn-warning btn-rounded"
                                            data-toggle="modal" data-target="#myModal-{{$row->id}}">در صف دریافت
                                    </button>
                                    <?php
                                    $reserves = \App\Reservation::where('library_id', $row->library_id)->where('status', 1)->orderBy('created_at')->get();
                                    $idmodal = 1;
                                    ?>
                                    <div class="modal fade bd-example-modal-lg" id="myModal-{{$row->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">لیست رزرو ها</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table id="example1"
                                                               class="table  table-striped table-bordered ">
                                                            <thead>
                                                            <tr style="text-align: center">

                                                                <th>شمارنده</th>
                                                                <th>نام رزرو کننده</th>
                                                                <th>نام کتاب</th>
                                                                <th>تاریخ رزور</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($reserves as $row)
                                                                <tr class="form-group text-center">
                                                                    <td style="text-align: center">{{$idmodal}}</td>
                                                                    <td>{{$row->user->f_name}}
                                                                        -{{$row->user->l_name}}</td>
                                                                    <td>{{$row->library->name}}</td>
                                                                    <td>{{$row->created_at->ToDateString()}}</td>
                                                                </tr>
                                                                <?php $idmodal = $idmodal + 1 ?>

                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">بستن
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($row->count==0)
                                    <button type="button" title="تمدید کردن" class="btn btn-primary btn-rounded"
                                            onclick="tamdid({{$row->id}})">تمدید
                                    </button>
                                @endif
                                <button type="button" title="برگشت کتاب" class="btn btn-success btn-rounded"
                                        onclick="back({{$row->id}})">برگشت کتاب
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>


    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')
<script>
    function back(id) {

        swal({
            title: "آیا موراد جریمه را بررسی نمودید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/library/back')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "فرآیند برگشت با موفقیت انجام شد!",
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
                    swal("عملیات برگشت لغو گردید");
                }
            });

    }


    function tamdid(id) {

        swal({
            title: "آیا از تمدید مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/library/trust/tamdid')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "تمدید با موفقیت انجام شد!",
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
                    swal("عملیات تمدید لغو گردید");
                }
            });

    }
</script>

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

        return floor($time / 86400) . 'روز مانده';
    } else {

        $time = time() - $dateEx; // to get the time since that moment


        return floor($time / 86400) . ' روز گذشته';
    }

}

function getday($expire)
{
    $date = explode('-', $expire);
    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
    $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
    $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
    $time = time() - $dateEx; // to get the time since that moment
    $numberOfUnits = floor($time / 86400);
    return $numberOfUnits;

}
?>
