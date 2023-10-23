@php($role=auth()->user()->role)
@extends($role=='معلم' ?  'layouts.teacher': 'layouts.admin')
@section('css')
    <style>
        .txtarea {
            border-right: #646464;
            border-top: #646464;
            border-left: #646464;
            border-bottom: #646464;
            width: 100%;
            background: #ffffcc;
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
            <h3> سوالات آزمون {{$exam->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون تشریحی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> آزمون {{$exam->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">

                    <h5>نام {{config('global.student')}}:
                        {{$user->f_name}}
                    </h5>
                </div>
                <div class="col-md-3" style="text-align: left">
                    @if($exam->filename)
                        <a href="{{ route('exam.download', $exam->id) }}"
                           class="btn btn-outline-warning">
                            <i class="icon-download"></i> دانلود فایل کلی آزمون </a>
                    @endif
                </div>

                <div class="col-md-3">
                    @foreach($exams->unique('dars_id') as $questions)
                        @if($questions->dars_id)
                            <button class="btn btn-success">
                                {{\App\dars::where('id',$questions->dars_id)->pluck('name')->first()}}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row">
                <?php
                $mymark = 0;
                ?>
                @foreach($exams as $questions)

                    <?php
                    if ($questions->studentanswers != '[]') {
                        $mark = $questions->studentanswers[0]->mark;
                    } else {
                        $mark = 0;
                    }
                    $mymark = $mymark + $mark;
                    ?>
                    <div class="col-md-3">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#سوال{{$questions->id}}">
                            {{$questions->title}}
                            &nbsp; @if($questions ->dars_id)
                                -
                                {{\App\dars::where('id',$questions   ->dars_id)->pluck('name')->first()}}
                            @endif
                            <span style="color: #f89a9a">
                                                            (
                            {{$questions->studentanswers!='[]' ? $mark=$questions->studentanswers[0]->mark : $mark=0}}
                             از
                            {{$questions->mark}}
                            )

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
                                                <i class="icon-download"></i> دانلود سوال </a>
                                        @endif
                                        @if($questions->studentanswers!='[]')
                                            @if($questions->studentanswers[0]->filename)
                                                <a href="{{ route('exam_answer.download', $questions->studentanswers[0]->id) }}"
                                                   class="btn btn-outline-warning">
                                                    <i class="icon-download"></i>&nbsp; دانلود پاسخ </a>
                                            @endif
                                        @endif
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @if($questions->studentanswers!='[]')
                                        <form
                                            action="/teacher/exam/descriptive/single/update/{{$questions->studentanswers[0]->id}}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" {{$questions->id}}>

                                            <div class="modal-body">

                                                @if($questions->description)
                                                    <label>صورت سوال</label>
                                                    <textarea class="form-control" readonly>
                                                    {{$questions->description}}
                                            </textarea>
                                                    <br>
                                                @endif
                                                <label>پاسخ {{config('global.student')}}</label>
                                                <textarea class="form-control" readonly>
                                                    {{$questions->studentanswers[0]->description}}
                                            </textarea>
                                                <br>
                                                <label>نمره دهی</label>
                                                <input name="mark" class="form-control" type="number" step=".1"
                                                       {{$questions->studentanswers!='[]' ? $mark=$questions->studentanswers[0]->mark : $mark=0}}
                                                       value="{{$mark}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    بستن
                                                </button>
                                                <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                                            </div>
                                        </form>

                                    @else
                                        <div class="modal-body" style="background-color: darkred">
                                            <h6 style="color: white"> بدون پاسخ</h6>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <br>
            <div class="row col-md-12" style="color: black">
                @if($mymark>=10)
                    <button class="btn btn-success"> نمره {{config('global.student')}}:&nbsp;{{$mymark}}</button>
                @else
                    <button class="btn btn-danger"> نمره {{config('global.student')}}:&nbsp;{{$mymark}}</button>

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

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('script')



