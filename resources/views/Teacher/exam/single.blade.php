@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')
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
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
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

            <div style="text-align: center" class="row">
                <div class="col-md-3">
                    <h4>
                        آزمون {{$exams[0]->exam->title}}
                    </h4>
                </div>
                <div class="col-md-3">
                    @if($exams[0]->exam->filename)
                        <a href="{{ route('exam.download', $exams[0]->exam->id) }}"
                           class="btn btn-outline-warning">
                            <i class="icon-download"></i>&nbsp; دانلود فایل کلی آزمون </a>
                    @endif
                </div>
                <div class="col-md-3">
                    <a href="/teacher/exam/student/{{\App\clas::where('id',$exam['examclass'][0]->class_id)->pluck('classnamber')->first()}}/{{$exam->id  }}">
                        <button class="btn btn-info"> لیست {{config('global.students')}}</button>
                    </a>
                </div>
            </div>
            <br>
            <div id="questions">
                @foreach($exams as $exam)
                    @if($exam->dars_id)
                        <button
                            class="btn btn-outline-whatsapp">{{\App\dars::where('id',$exam->dars_id)->pluck('name')->first()}}
                        </button>
                    @endif
                    @if($exam->studentanswers!='[]')
                        <button class="btn btn-primary">گزینه درست:{{$exam->studentanswers[0]->correct}}</button>
                        <button class="btn btn-info">گزینه انتخابی
                            {{config('global.student')}}
                            :
                            {{$exam->studentanswers[0]->option_id}}</button>
                    @else
                        <span> گزینه ای انتخاب نشده است.</span>
                    @endif
                    <div id="questions0">
                        <div class="row">


                            <div class="col-md-12">
                                <br>
                                <label>صورت سوال </label>
                                <br>
                                <textarea rows="6" cols="40" type="text"
                                          class="form-control">
                                        {{$exam->description}}
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

                                @endif
                            </div>
                            <div class=" col-md-6">
                                <br>
                                @if(!empty($exam->image))
                                    {{--@dd($exam->image);--}}
                                    <img class="" width="410" height="300"
                                         src="{{url('/images/exam/'.$exam->image)}}"
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



