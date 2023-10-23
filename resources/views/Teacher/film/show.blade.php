@extends('layouts.teacher')
@section('css')
    <style>
        .alignleft {
            float: left;
        }
        .alignright {
            float: right;
        }
    </style>
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
            <h3>مطالب ارسال کرده</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مطالب</a></li>
                    <li class="breadcrumb-item active" aria-current="page">مطالب ارسال کرده</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">


            <div style="text-align: right">
                <b style="text-align: center">تاریخ ارسال:</b>
            </div>
            <div id="textbox">
                <div class="alignright">
                    <p class="navbar-text"> {{ $film->created_at->toDateString() }}  </p>
                </div>
                <div class="alignleft">
                    <a href="/teacher/film/edite/{{$film->id}}" class="btn btn-outline-success"><i class="icon-pencil"></i>	&nbsp<span
                                class="hidden-xs position-right">ویرایش</span></a>
                </div>
            </div>
            <!-- /mail toolbar -->
            <!-- Mail details -->
            <div class="media stack-media-on-mobile mail-details-read">


                <div class="media-body">
                    <h6 class="media-heading">{{$film->subject}}</h6>
                    <br>
                    <br>
                    <div class="letter-icon-title text-semibold" style="text-align: center"> ارسال
                        کننده:<b> {{\App\User::where('id',$film->user_id)->first()['f_name']}}
                            - {{\App\User::where('id',$film->user_id)->first()['l_name']}} </b></div>
                </div>


            </div>
            <!-- /mail details -->


            <!-- Mail container -->
            <div class="mail-container-read">
                <br>
                <label style="font-family: 'B Koodak';font-size: large">کلاس: </label>
                {!! $film->class_id !!}
                <br>
                <label style="font-family: 'B Koodak';font-size: large">درس: </label>
                {!! $namedars!!}
            </div>
            <div class="mail-container-read">
                <br>
                <label style="font-family: 'B Koodak';font-size: large">عنوان مطلب: </label>

                <br>
                {!! $film->title !!}

            </div>
            <!-- /mail container -->

            <hr>
            <!-- Attachments -->
            <div class="mail-attachments-container">
                <label style="font-family: 'B Koodak';font-size: large">توضیحات مطلب:</label>
                <br>

                {!! $film->description !!}
            </div>
        </div>
    </div>
    <!-- /attachments -->


    <!-- /single mail -->
@endsection('content')

<?php
function checkAttah($id)
{
    $attach = \App\Film::find($id);
    return $attach;

}
?>

