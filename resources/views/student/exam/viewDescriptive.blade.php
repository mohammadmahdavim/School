@extends('layouts.student')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <style>
        hr {
            border-top: 2px dashed red;
        }
    </style>
@endsection('css')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3> آزمون {{$exams[0]->exam->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> آزمون {{$exams[0]->exam->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <div style="text-align: center">
                <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                    آزمون {{$exams[0]->exam->title}}
                </h4>
            </div>


            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <?php
                $allmark = 0;
                $mymark = 0;
                ?>
                @foreach($exams as $questions)
                    <div class="col-md-3">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#سوال{{$questions->id}}">
                            {{$questions->title}}
                            &nbsp;
                            &nbsp; @if($questions ->dars_id)

                                -
                                {{\App\dars::where('id',$questions   ->dars_id)->pluck('name')->first()}}
                            @endif
                            <span style="color: #f89a9a">

                            (
                            {{$questions->useranswers!='[]' ? $mark=$questions->useranswers[0]->mark : $mark=0}}
                             از
                            {{$questions->mark}}
                            )

                             <?php
                                $allmark = $allmark + $questions->mark;
                                $mymark = $mymark + $mark;
                                ?>
                            </span>
                        </button>

                        <div class="modal fade bd-example-modal-lg" id="سوال{{$questions->id}}" tabindex="-1"
                             role="dialog"
                             aria-labelledby="{{$questions->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$questions->id}}">{{$questions->title}}
                                            &nbsp; @if($questions ->dars_id)

                                                -
                                                {{\App\dars::where('id',$questions   ->dars_id)->pluck('name')->first()}}
                                            @endif
                                        </h5>
                                        @if($questions->file)
                                            <a href="{{ route('exam_question.download', $questions->id) }}"
                                               class="btn btn-outline-warning">
                                                <i class="icon-download"></i>&nbsp; دانلود سوال </a>
                                        @endif
                                        @if($questions->useranswers!='[]')
                                            @if($questions->useranswers[0]->filename)
                                                <a href="{{ route('exam_answer.download', $questions->useranswers[0]->id) }}"
                                                   class="btn btn-outline-warning">
                                                    <i class="icon-download"></i>&nbsp; دانلود پاسخ </a>
                                            @endif
                                        @endif

                                        <br>
                                    </div>
                                    <input name="question_id" type="hidden" value="{{$questions->id}}">

                                    <div class="modal-body">
                                        @if($questions->description)
                                            <label>صورت سوال</label>
                                            <textarea class="form-control" readonly>
                                                    {{$questions->description}}

                                            </textarea>
                                            <br>
                                        @endif
                                        @if($questions->useranswers!='[]')


                                            <label>پاسخ شما</label>

                                            <textarea class="form-control" name="description" readonly>
                                                {{$questions->useranswers[0]->description}}
                                            </textarea>
                                        @endif

                                        <br>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <hr>
            <div class="row col-md-12" style="color: black">
                @if($mymark>=10)
                    <button class="btn btn-success"> نمره شما:&nbsp;{{$mymark}}</button>
                @else
                    <button class="btn btn-danger"> نمره شما:&nbsp;{{$mymark}}</button>

                @endif
            </div>
        </div>
    </div>
    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('content')
@section('script')

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->

@endsection('script')



