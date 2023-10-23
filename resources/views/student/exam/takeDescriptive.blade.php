@extends('layouts.student')
@section('css')


    <style>
        body {
            text-align: center;
        }

        h1 {
            color: #396;
            font-weight: 100;
            font-size: 40px;
            margin: 40px 0px 20px;
        }

        #clockdivme {
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }

        #clockdivme > div {
            text-align: center;
            padding: 10px;
            border-radius: 3px;
            background: #00BF96;
            display: inline-block;
        }

        #clockdivme div > span {
            padding: 15px;
            border-radius: 3px;
            background: #00816A;
            display: inline-block;
        }

        .smalltext {
            padding-top: 5px;
            font-size: 16px;
        }
    </style>

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
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین تشریحی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> آزمون {{$exams[0]->exam->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
<div class="card">
    <div class="card-body">
        <div style="text-align: center;padding-right: 300px">
            <div id="clockdivme">

                <div>
                    <span class="seconds"></span>
                    <div class="smalltext">Seconds</div>
                </div>
                <div>
                    <span class="minutes"></span>
                    <div class="smalltext">Minutes</div>
                </div>

                <div>
                    <span class="hours"></span>
                    <div class="smalltext">Hours</div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6" style="text-align: right">

                    <h3> سوالات آزمون {{$exams[0]->exam->title}}</h3>
                </div>
                <div class="col-md-3" style="text-align: left">
                    @if($exams[0]->exam->filename)
                        <a href="{{ route('exam.download', $exams[0]->exam->id) }}"
                           class="btn btn-outline-warning">
                            <i class="icon-download"></i>&nbsp; دانلود فایل کلی آزمون </a>
                    @endif
                </div>
                <div class="col-md-3">
                    @foreach($exams->unique('dars_id') as $questions)

                        @if($questions->dars_id)
                            <button class="btn btn-info">
                                <span> درس {{\App\dars::where('id',$questions->dars_id)->pluck('name')->first()}}</span>

                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row">

                @foreach($exams as $questions)

                    <div class="col-md-3">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#سوال{{$questions->id}}">
                            {{$questions->title}}
                            @if($questions->dars_id)
                                -
                                {{\App\dars::where('id',$questions->dars_id)->pluck('name')->first()}}&nbsp;
                            @endif
                            <span style="color: #f89a9a">

                            ({{$questions->mark}} نمره)
                            </span>
                        </button>

                        <div class="modal fade bd-example-modal-lg" id="سوال{{$questions->id}}" tabindex="-1"
                             role="dialog"
                             aria-labelledby="{{$questions->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$questions->id}}">{{$questions->title}}
                                            @if($questions->dars_id)
                                                -
                                                {{\App\dars::where('id',$questions->dars_id)->pluck('name')->first()}}&nbsp;
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
                                                    <i class="icon-download"></i>&nbsp; دانلود پاسخ شما </a>
                                            @endif
                                        @endif

                                        <br>
                                    </div>
                                    <form action="/student/exam/descriptive/answer"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input name="question_id" type="hidden" value="{{$questions->id}}">

                                        <div class="modal-body">
                                            @if($questions->description)
                                                <label>صورت سوال</label>
                                                <textarea class="form-control" readonly>
                                                    {{$questions->description}}

                                            </textarea>
                                                <br>
                                            @endif
                                            <label>پاسخ شما</label>

                                            <textarea class="form-control" name="description">
                                                @if($questions->useranswers!='[]')
                                                    {{$questions->useranswers[0]->description}}
                                                @endif
                                            </textarea>
                                            <br>
                                            <label> آپلود پاسخ</label>

                                            <input class="form-control" type="file" name="file">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                                            </button>
                                            <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>


            <div>
                <br>
                <a href="/student/finish/{{$exams[0]->exam->id}}" title="درصورت اتمام آزمون خود این دکمه را بزنید">
                    <button class="btn btn-danger btn-block" style="text-align: center">پایان آزمون</button>
                </a>

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
<script>

    function getTimeRemaining(endtime) {
        const total = Date.parse(endtime) - Date.parse(new Date());
        const seconds = Math.floor((total / 1000) % 60);
        const minutes = Math.floor((total / 1000 / 60) % 60);
        const hours = Math.floor((total / (1000 * 60 * 60)) % 24);

        return {
            total,
            hours,
            minutes,
            seconds

        }

    }

    function initializeClock(id, endtime) {
        const clock = document.getElementById(id);
        const hoursSpan = clock.querySelector('.hours');
        const minutesSpan = clock.querySelector('.minutes');
        const secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            const t = getTimeRemaining(endtime);
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        const timeinterval = setInterval(updateClock, 1000);
    }

    var time =  @json($endtime) ;
    if (time < 0) {
        alert('d')
    }
    // const deadline = new Date(Date.parse(new Date()) + 240 * 60 * 1000);
    const deadline = new Date(Date.parse(new Date()) + time * 1000);
    initializeClock('clockdivme', deadline);

</script>
<script>
    function myoption(option, question) {

        swal({
            title: "آیا از انتخاب گزینه مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var question_id = question;
                    var option_value = option;

                    $.ajax({
                        url: '{{ url('/student/exam/tik') }}',
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            "option_value": option_value,
                            "question_id": question_id,

                        },
                        success: function (data) {
                            swal({
                                title: data,
                                icon: "success",

                            });
                            $("#questions").load(" #questions");
                        },
                        // warning: function () {
                        //     swal({
                        //         title: "گزینecwecewه با موفقیت انتخاب شد!",
                        //         icon: "success",
                        //
                        //     });
                        //     window.location.reload(true);
                        // },
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
                    swal("عملیات  لغو گردید");
                    $("#questions").load(" #questions");

                }
            });

    }

</script>





