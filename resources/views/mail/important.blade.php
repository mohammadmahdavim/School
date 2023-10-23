@extends('layouts.profile')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->

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
            <br>
            <h3>پیام های مهم</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">پیام ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پیام های مهم</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-body">
                    {{--<div class="sidebar sidebar-main sidebar-default sidebar-separate">--}}
                    <div class="sidebar-content">

                        <!-- Actions -->
                        <div class="sidebar-category">
                            <div class="category-title">
                                <b>عملیات</b>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <a href="/mail/create">
                                        <button class="btn btn-primary btn-block">ایجاد پیام</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /actions -->
                        <br>
                        <br>
                        <br>

                        <!-- Sub navigation -->
                        <div class="sidebar-category">
                            <div class="category-title">
                                <b>صندوق مدیریت پیام ها</b>

                            </div>
                            <hr>
                            <div class="contact-list">
                                <ul class="list">

                                    <li class="active"><a href="/mails/inbox"><i class="icon-drawer-in"></i> &nbsp

                                            پیام های
                                            دریافتی
                                            @if($count != 0)<span class="badge badge-danger">{{$count}}</span>@endif</a>
                                    </li>
                                    <hr>
                                    <li><a href="/mail/outbox"><i class="icon-drawer-out"></i>&nbsp
                                            پیام های ارسالی</a></li>
                                    <hr>
                                    <li><a href="/mail/important"><i class="icon-stars"></i>&nbsp
                                            پیام های مهم </a></li>
                                    <li class="navigation-divider"></li>

                                </ul>
                            </div>
                        </div>
                        <!-- /sub navigation -->


                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="card ">

                <div class="card-body">

                    <table id="example1" class="table table-striped table-bordered">
                        <thead>
                        <tr class="success">
                            <th>عملیات</th>
                            <th>ارسال کننده</th>
                            <th>عنوان</th>
                            <th>دانلود فایل ضمیمه</th>
                            <th>تاریخ</th>

                        </tr>
                        </thead>
                    <tbody data-link="row" class="rowlink">

                    @foreach($mails as $mail )


                        @if($mail->status != 0)
                            <tr style="" id="tr_{{$mail->id}}">
                        @else
                            <tr class="unread" id="tr_{{$mail->id}}">
                                @endif

                                @if($mail->important==1)
                                <td class="table-inbox-checkbox rowlink-skip">
                                    <a href="<?= url('/mail/onupdatein/' . $mail->mail_id); ?>">
                                        <i class="icon-star-full2"></i>
                                    </a>
                                </td>
                                @else
                                    <td class="table-inbox-checkbox rowlink-skip">
                                        <a href="<?= url('/mail/updatein/' . $mail->mail_id); ?>">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </a>
                                    </td>
                                @endif
                                {{--<td class="table-inbox-checkbox rowlink-skip">--}}
										{{--<span class="btn bg-warning-400 btn-rounded btn-icon btn-xs">--}}
											{{--<span class="letter-icon"></span>--}}
										{{--</span>--}}
                                {{--</td>--}}
                                <td class="table-inbox-name">
                                    <a href="<?= url('/mail/showin/' . $mail->mail_id); ?>">
                                        <div class="letter-icon-title text-default">{{ getAuthor(getMyMail($mail->mail_id)->user_id)->f_name.' '.getAuthor(getMyMail($mail->mail_id)->user_id)->l_name  }}</div>
                                    </a>
                                </td>
                                <td class="table-inbox-message">
                                    <span class="table-inbox-subject">{{ getMyMail($mail->mail_id)->subject  }}</span>
                                    {{--<span class="table-inbox-preview">{!!  str_limit(getMyMail($mail->mail_id)->body,70)  !!}</span>--}}
                                </td>

                                <td class="table-inbox-attachment">
                                    @if(!empty(checkAttah($mail->mail_id)->filename) != 0)
                                        <a href="{{ route('mail.download', $mail->id) }}"> <i
                                                    class="icon-download"></i> Download </a>
                                    @endif
                                </td>


                                <td class="table-inbox-time" style="font-size: 6.5pt">
                                    {{ get_time_ago(getMyMail($mail->mail_id)->time)  }}
                                </td>
                            </tr>
                            @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!-- /single line -->

    </div>



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
                            url: "{{  url('/admin/project/delete')  }}" + '/' + id,
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












    <script type="text/javascript">
        $(document).ready(function () {


            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function (e) {


                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("لطفا پیامی را انتخاب کنید!");
                } else {


                    var check = confirm("آیا از حذف کردن مطمئن هستید؟");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('خطایی در حذف رخ داد!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function (index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });


            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });


            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('خطایی رخ داد');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });


                return false;
            });
        });
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')






@endsection


<?php

use App\MailModel;
use App\AttachMailModel;
function getMyMail($id)
{
    $mail = MailModel::find($id);
    return $mail;
}

function getAuthor($id)
{
    $author = \App\User::find($id);
//        dd($author);
    return $author;
}

function get_time_ago($time) // e.g. '2013-05-28 17:25:43'
{

    $time = time() - $time; // to get the time since that moment

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

        return $numberOfUnits . ' ' . $text . ' پیش';
    }

}


function checkAttah($id)
{
    $attach = \App\MailModel::find($id);
    return $attach;
}
?>
