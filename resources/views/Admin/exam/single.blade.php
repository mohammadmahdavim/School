@extends('layouts.admin')
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
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
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
                    @if($exams[0]->exam->filename)
                        <a href="{{ route('exam.download', $exams[0]->exam->id) }}"
                           class="btn btn-outline-warning">
                            <i class="icon-download"></i>&nbsp; دانلود فایل کلی آزمون </a>
                    @endif
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
            <div id="questions">
                @foreach($exams as $exam)
                    <button class="btn btn-primary">گزینه
                        درست:{{ ($exam->myoptions ? $exam->myoptions[0]->correct : '') }}</button>
                    <button class="btn btn-info">گزینه انتخابی
                        {{config('global.student')}}
                        :
                        @if($exam->studentanswers!=[])
                            {{$exam->studentanswers[0]->option_id}}
                        @endif
                    </button>
                    <div id="questions0">
                        <div class="row">


                            <div class="col-md-12">
                                <br>
                                <label>صورت سوال </label>
                                <br>
                                <textarea rows="6" cols="40" type="text"
                                          class="form-control">
                                        {{$exam->title}}
                        </textarea>
                                <br>

                            </div>
                            <div class=" col-md-6">
                                <br>
                                @if(!empty($exam->file))
                                    {{--@dd($exam->file);--}}
                                    <img class="" width="410" height="300"
                                         src="{{url('/images/exam/'.$exam->file)}}"
                                         alt="...">
                                @else
                                    <img class="" width="410" height="300"
                                         src="/homee/images/education.jpg"
                                         alt="...">
                                @endif
                            </div>
                            <div class=" col-md-6">
                                <br>
                                @if(!empty($exam->image))
                                    {{--@dd($exam->image);--}}
                                    <img class="" width="410" height="300"
                                         src="{{url('/images/exam/'.$exam->image)}}"
                                         alt="...">
                                @else
                                    <img class="" width="410" height="300"
                                         src="/homee/images/education.jpg"
                                         alt="...">
                                @endif
                            </div>
                        </div>
                        <br>
                        <label>گزینه ها</label>

                        <div class=" col-md-12">
                            @foreach($exam->myoptions as $myoptions)
                                <?php
                                $images = \App\OptionImage::where('question_id', $myoptions->question_id)->get();
                                ?>
                                <div class="row">

                                    <div class="col-md-3">
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['1']}}">
                                        @if($images!='[]')
                                            @if($one=$images->where('option_id',1)->first())
                                                <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                     width="250">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['2']}}">
                                        @if($images!='[]')
                                            @if($one=$images->where('option_id',2)->first())
                                                <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                     width="250">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['3']}}">
                                        @if($images!='[]')
                                            @if($one=$images->where('option_id',3)->first())
                                                <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                     width="250">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['4']}}">
                                        @if($images!='[]')
                                            @if($one=$images->where('option_id',4)->first())
                                                <img src="{{url('/images/exam/'.$one->image)}}" height="190"
                                                     width="250">
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <br>

                        </div>
                        <hr>

                    </div>
                @endforeach
            </div>
            {{ $exams->links() }}

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



