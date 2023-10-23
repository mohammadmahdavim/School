@extends('layouts.home')

@section('main')
    <main class="main-content">

        <!-- Portfolio Details Area -->
        <div class="tm-section portfolio-details-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="tm-portfoliodetails-info">
                            <ul>
                                <li><h2><b>عنوان :</b>{{$row->title}}</li>
                                </h1>
                                <li><b>نویسنده :</b>{{$row->name}}</li>
                                <li><b>نقش :</b>{{$row->role}}</li>
                                <li><b>تاریخ ارسال :</b></li>
                                <span style="color: #0d8d2d">{{$row->created_at->toDateString()}} </span>
                                <div style="text-align: center">
                                    <a href="/question/create" class="btn btn-warning" style="text-align: center"><h4
                                                style="text-align: center;color: black"><span style="color: red"> کلیک کن </span>
                                            بحث خودت رو ایجاد کن.</h4></a>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="tm-portfoliodetails-description">
                            <div class="d-flex flex-row">
                                <div class="p-2">
                                    <h3>بحث</h3>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <p>
                                        {!! $row->description !!}
                                    </p>
                                </div>

                            </div>
                            <!-- tm-blog Comments -->
                            <div class="tm-blog-comments mt-50">
                                <h4 class="small-title">نظرات ({{$commentcount}})</h4>
                                @if(\Illuminate\Support\Facades\Auth::check())

                                    @if (auth()->user()->level == 'admin')
                                        <h6 class="small-title" style="color: red">نظرات تایید نشده ({{$nocount}})</h6>
                                    @endif
                                @endif

                                <div class="tm-comment-wrapper">

                                    @foreach($comments as $comment)
                                        @if($comment->status==0)
                                            <div class="card" style="background-color: #A6ACAF">
                                                <span style="padding-top: 2px;text-align: left;color: #A93226">منتظر تایید</span>
                                                @else
                                                    <div class="card">
                                                        @endif
                                                        <div class="card-body">


                                                            <!-- Comment Single -->
                                                            <div class="tm-comment">
                                                                <div class="tm-comment-thumb">

                                                                    {{--<h4><span style="color: #b91d19;">کامنت:</span></h4>--}}
                                                                    @if(\Illuminate\Support\Facades\Auth::check())

                                                                        @if (auth()->user()->level == 'admin')
                                                                            <input style="text-align: center"
                                                                                   type="checkbox"
                                                                                   class="form-check-input"
                                                                                   id="comment{{$comment->id}}"
                                                                                   {{ $comment->status ? 'checked' : '' }} onclick="toggless('{{$comment->id}}',this) ">
                                                                            <label
                                                                                    for="comment{{$comment->id}}">تایید
                                                                            </label>
                                                                        @endif
                                                                    @endif
                                                                    <img
                                                                            class="rounded-circle" width="60px"
                                                                            src="/assets/profile/avatar.png"
                                                                            alt="...">
                                                                </div>
                                                                {{--<div class="tm-comment-content">--}}
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h6 class="tm-comment-authorname"><a
                                                                                    style="color: black"
                                                                                    href="#">نظر{{$comment->name}}
                                                                                :</a>
                                                                        </h6>

                                                                    </div>
                                                                    {{--</div>--}}

                                                                    <div class="col-md-12">
                                                                        <span class="tm-comment-date"> {!!   $comment->created_at->toDateString()!!}</span>
                                                                    </div>
                                                                    <div class="col-md-12">

                                                                        <p>
                                                                            {{$comment->body}}


                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-12">

                                                                        <button type="button"
                                                                                class="btn btn-primary btn-rounded btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModal{{$comment->id}}">
                                                                            پاسخ <i class="fa fa-reply-all"></i>
                                                                        </button>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if (\Illuminate\Support\Facades\Auth::check()) {

                                                                if (auth()->user()->level == 'admin') {

                                                                    $pcomments = \App\PComment::where('comment_id', $comment->id)->get();
                                                                }
                                                            } else {
                                                                $time = \Morilog\Jalali\Jalalian::now()->subMinutes(5);
                                                                $pcomments1 = \App\PComment::where('status', 1)->where('comment_id', $comment->id)->get();
                                                                $pcomments2 = \App\PComment::where('status', 0)->where('comment_id', $comment->id)->where('created_at', '>=', $time)->get();
                                                                $pcomments = $pcomments1->merge($pcomments2);
                                                            }
                                                            ?>
                                                            <hr>
                                                            @foreach($pcomments as $pcomment)
                                                                @if($pcomment->status==0)
                                                                    <div class="card" style="background-color: #A6ACAF">
                                                                        <span style="padding-top: 2px;text-align: left;color: #A93226">منتظر تایید</span>
                                                                        @else
                                                                            <div class="card">
                                                                                @endif
                                                                                <div class="tm-comment tm-comment-replypost">
                                                                                    <div class="tm-comment-thumb">

                                                                                        {{--<h6 style="color:black;">پاسخ کامنت</h6>--}}
                                                                                        @if(\Illuminate\Support\Facades\Auth::check())

                                                                                            @if (auth()->user()->level == 'admin')
                                                                                                <input style="text-align: center"
                                                                                                       type="checkbox"
                                                                                                       class="form-check-input"
                                                                                                       id="pcomment{{$pcomment->id}}"
                                                                                                       {{ $pcomment->status ? 'checked' : '' }} onclick="togglesss('{{$pcomment->id}}',this) ">
                                                                                                <label
                                                                                                        for="pcomment{{$pcomment->id}}">تایید
                                                                                                </label>
                                                                                            @endif
                                                                                        @endif
                                                                                        <img
                                                                                                class="rounded-circle" width="60px"
                                                                                                src="/assets/profile/avatar.png"
                                                                                                alt="...">
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">

                                                                                            <h6 class="tm-comment-authorname"><a
                                                                                                        style="color: black"
                                                                                                        href="#">نظر{{$comment->name}}
                                                                                                    :</a>
                                                                                            </h6>

                                                                                        </div>

                                                                                        <div class="col-md-12">
                                                                        <span class="tm-comment-date">
                                                                            {!!   $pcomment->created_at->toDateString()!!}</span>
                                                                                            <p>
                                                                                                {{$pcomment->body}}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                    </div>
                                                        </div>
                                                        <br>
                                                        @endforeach


                                                    </div>


                                            </div>
                                            <!--// tm-blog Comments -->

                                            <!-- tm-blog Commentbox -->
                                            <div class="tm-blog-commentbox mt-50">
                                                <h5 class="small-title">ارسال نظر</h5>
                                                <form action="/comment/store/{{$row->id}}" method="post">
                                                    {{csrf_field()}}
                                                    @include('errors')

                                                    <div class="tm-commentbox-singlefield w-33">
                                                        <label for="tm-comment-namefield">نام و نام خانوادگی*</label>
                                                        @if(\Auth::check())
                                                            <input name="name" id="name"
                                                                   value="{{auth()->user()->f_name}}-{{auth()->user()->l_name}}">
                                                        @else
                                                            <input name="name" id="name" type="text" required>

                                                        @endif
                                                    </div>
                                                    <div class="tm-commentbox-singlefield">
                                                        <label for="tm-comment-textbox">نظر</label>
                                                        <textarea name="comment" id="tm-comment-textbox" cols="30"
                                                                  rows="7" required></textarea>
                                                    </div>
                                                    <div class="tm-commentbox-singlefield">
                                                        <button type="submit" class="tm-button">ارسال نظر<b></b></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--// tm-blog Commentbox -->

                                </div>
                                <!--// tm-blog Comments -->



                            </div>
                            <!-- /tm-blog Comments -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Portfolio Details Area -->

    </main>
    <!--// Main Content -->

@endsection('main')
<!-- Modal -->
@foreach($comments as $comment)
    <div class="modal fade" id="exampleModal{{$comment->id}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال پاسخ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pcomment/store/{{$row->id}}/{{$comment->id}}" method="post">
                        {{csrf_field()}}
                        @include('errors')

                        <div class="tm-commentbox-singlefield w-33">
                            <label for="tm-comment-namefield">نام و نام خانوادگی*</label>
                            @if(\Auth::check())
                                <input name="name" id="name"
                                       value="{{auth()->user()->f_name}}-{{auth()->user()->l_name}}">
                            @else
                                <input name="name" id="name" type="text" required>

                            @endif
                        </div>
                        <div class="tm-commentbox-singlefield">
                            <label for="tm-comment-textbox">نظر</label>
                            <textarea name="comment" id="tm-comment-textbox" cols="30"
                                      rows="7" required></textarea>
                        </div>
                        <div class="tm-commentbox-singlefield">
                            <button type="submit" class="tm-button">ارسال نظر<b></b></button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!--end Modal -->
<script>
    function toggless(id, obj) {
        var $input = $(obj);
        var status = 0;
        if ($input.prop('checked')) {
            var status = 1;
        }

        $.ajaxSetup({

            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: '{{url('/admin/comment/changeStatus')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "نمایش کامنت برای همه فعال شد",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "نمایش کامنت  غیر فعال شد",
                        icon: "success",

                    });
                }
            }
        })


    }

    function togglesss(id, obj) {
        var $input = $(obj);
        var status = 0;
        if ($input.prop('checked')) {
            var status = 1;
        }

        $.ajaxSetup({

            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: '{{url('/admin/pcomment/changeStatus')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "نمایش پاسخ کامنت برای همه فعال شد",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "نمایش پاسخ کامنت  غیر فعال شد",
                        icon: "success",

                    });
                }
            }
        })


    }

</script>