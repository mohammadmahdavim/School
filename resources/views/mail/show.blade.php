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
            <h3>پیام ارسال شده از {{ getAuthor($mail->user_id)->f_name.' - '.getAuthor($mail->user_id)->l_name  }}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">پیام ها </a></li>
                    <li class="breadcrumb-item active" aria-current="page">مشاهده پیام</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">


            <div class="row">
                <div style="text-align: right" class="col-md-6">
                    <b>تاریخ ارسال: </b>{{get_time_ago($mail->time)}}
                </div>
                <div style="text-align:left" class="col-md-6">
                    @if($mail->user_id == Auth::user()->id)<a
                            href="/mail/edit/{{$mail->id}}" class="btn btn-default"><button class="btn btn-success"><i
                                    class="icon-pencil"></i> <span
                                    class="hidden-xs position-right">ویرایش</span></button></a>@endif

                </div>

            </div>
            <br>
            <!-- /mail toolbar -->


            <!-- Mail details -->
            <div class="media stack-media-on-mobile mail-details-read">


                <div class="media-body">
                    {{--<h6 class="media-heading">{{$tamrin->subject}}</h6>--}}
                    <div class="letter-icon-title text-semibold"> ارسال
                        کننده:<b> {{ getAuthor($mail->user_id)->f_name.' - '.getAuthor($mail->user_id)->l_name  }}</b>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div style="text-align: right">
                <label style="font-family: 'B Koodak';font-size: medium;text-align: right"> عنوان
                    پیام: {{$mail->subject}} </label>
            </div>
            <br>


            <!-- /mail details -->


            <!-- Mail container -->
            <div style="text-align: right">
                <label style="font-family: 'B Koodak';font-size: medium;text-align: right">توضیحات پیام</label>
                <br>

                {!! $mail->body !!}

            </div>
            <!-- /mail container -->

            <hr>
            <!-- Attachments -->
            <div class="mail-attachments-container">
                <h6 class="mail-attachments-heading">پیوست </h6>
                @if(!empty(checkAttah($mail->id)->filename) != 0)
                    <a href="{{ route('mailmodel.download', $mail->id) }}"><i
                                class="icon-download"></i></a>
                @endif
            </div>
        </div>
    </div>
@endsection

<?php
use App\MessageReseiver;

function getAuthor($id)
{
    $author = \App\User::find($id);
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



function getMyMail($id)
{
    $user_id = Auth::user()->id;
    $ids = \App\MessageReseiver::where('user_id', $user_id)->where('mail_id', $id)->first()['id'];
    return $ids;
}
function checkAttah($id)
{
    $attach = \App\MailModel::find($id);
    return $attach;

}
?>