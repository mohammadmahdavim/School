@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')
@section('css')
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
                    <li class="breadcrumb-item active" aria-current="page"> سوالات آزمون {{$exam->title}}</li>
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

                    <h3> سوالات آزمون {{$exam->title}}</h3>
                </div>
                <div class="col-md-6" style="text-align: left">
                    @if($exam->filename)
                        <a href="{{ route('exam.download', $exam->id) }}"
                           class="btn btn-outline-warning">
                            <i class="icon-download"></i> دانلود فایل کلی آزمون </a>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <?php
                $allmark = 0;
                ?>
                @foreach($exam->questions as $questions)
                    <div class="col-md-3">
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#سوال{{$questions->id}}">
                            {{$questions->title}}
                            &nbsp;
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

                                        </h5>
                                        @if($questions->file)
                                            <a href="{{ route('exam_question.download', $questions->id) }}"
                                               class="btn btn-outline-warning">
                                                <i class="icon-download"></i>&nbsp; دانلود سوال </a>
                                        @endif
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/teacher/exam/descriptive/question/update/{{$questions->id}}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" {{$questions->id}}>

                                        <div class="modal-body">

                                            <textarea class="form-control" style="text-align: right" name="description">
                                                {{$questions->description}}
                                            </textarea>
                                            <br>
                                            <input class="form-control" type="file" name="file">
                                            <br>
                                            <label>نمره </label>
                                            <input name="mark" class="form-control" type="number" step=".1"
                                                   value="{{$questions->mark}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                                            </button>
                                            <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                                        </div>
                                        <?php
                                        $allmark = $allmark + $questions->mark;
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
            <br>
            <div class="row col-md-12" style="color: black">
                    <label>مجموع نمرات این آزمون:</label>&nbsp;
                    <h5>{{$allmark}}</h5>

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



