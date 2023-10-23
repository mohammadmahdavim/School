@extends('layouts.home')
@section('slider')
    <div class="tm-breadcrumb-area tm-padding-section text-center" data-overlay="1"
         data-bgimage="/assets/images/bg/bg-breadcrumb.jpg">
        <div class="container">
            <div class="tm-breadcrumb">
                <h2 class="tm-breadcrumb-title">جزئیات مطالب</h2>
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="#">{{$row->place}}</a></li>
                    <li>{{$row->title}}</li>
                </ul>
            </div>
        </div>
    </div>

@endsection('slider')


@section('main')

    <main class="main-content">

        <!-- Blogs Area -->
        <div class="tm-section blogs-area bg-white tm-padding-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="tm-blog tm-blog-details sticky-sidebar">
                            @if(count(\App\HomeImage::where('matlab_id',$row->id)->orderby('created_at', 'desc')->get())==1)
                                <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$row->id)->orderby('created_at', 'desc')->first()->resize_image)}}"
                                     class="img-fluid" alt="...">
                            @else

                                <div class="swiper-container text-center swiper-demo2">
                                    <div class="swiper-wrapper">
                                        @foreach(\App\HomeImage::where('matlab_id',$row->id)->orderby('created_at', 'desc')->get() as $image)
                                            <div class="swiper-slide">
                                                <img src="{{url('images/'.$image->resize_image)}}"
                                                     class="img-fluid" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            @endif
                            <div class="tm-blog-content">
                                <div class="tm-blog-meta">
                                    <span>
                                    @foreach(\App\Tags::where('matlab_id',$row->id)->get() as $mytag)
                                            <span><i class="fa fa-folder-o"></i><a
                                                        href="/view/tag/{{$mytag->id}}">{{$mytag->tag}}</a></span>
                                    @endforeach
                                </div>
                                <h3>{{$row->title}}</h3>
                                <p>{!! $row->body !!}</p>
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
                                                                                            class="rounded-circle"
                                                                                            width="60px"
                                                                                            src="/assets/profile/avatar.png"
                                                                                            alt="...">
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <h6 class="tm-comment-authorname">
                                                                                            <a
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
                            <!-- /tm-blog Comments -->

                            <div class="col-lg-4 col-12">
                                <div class="widgets sidebar-widgets sticky-sidebar">

                                    <!-- Single Widget -->
                                    <div class="single-widget widget-search">
                                        <h5 class="widget-title">جستجو</h5>
                                        <form action="/search" class="widget-search-form" method="post">
                                            @csrf
                                            <input name="search" id="serrch" type="text" placeholder="جستجوی...">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                    <!--// Single Widget -->

                                    <!-- Single Widget -->
                                    <div class="single-widget widget-categories">
                                        <h5 class="widget-title">دسته بندی ها</h5>
                                        <ul>
                                            @foreach($tags as $tag)
                                                <li><a href="/view/tag/{{$tag->id}}">{{$tag->tag}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!--// Single Widget -->

                                    <!-- Single Widget -->
                                    <div class="single-widget widget-recentpost">
                                        <h5 class="widget-title">پست های اخیر</h5>
                                        <ul>
                                            @foreach($recents as $recent)
                                                <li>
                                                    @if(\App\HomeImage::where('matlab_id',$recent->id)->first() )

                                                        <a href="/single/{{$recent->id}}" class="widget-recentpost-image">
                                                            <img src="{{url('images/'.\App\HomeImage::where('matlab_id',$recent->id)->orderby('created_at', 'desc')->first()['resize_image'])}}"
                                                                 alt="blog thumbnail">
                                                        </a>
                                                    @endif
                                                    <div class="widget-recentpost-content">
                                                        <h6><a href="/single/{{$recent->id}}">{{$recent->title}}</a>
                                                        </h6>
                                                        <span>{{$recent->created_at->toDateString()}}</span>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <!--// Single Widget -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--// Blogs Area -->


    </main>
    <!--// Main Content -->

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

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

