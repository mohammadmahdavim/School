@extends('layouts.teacher')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
    <link rel="stylesheet" type="text/css" href="/assets/excel/css/component.css"/>
    <style>
        .fab {
            width: 40px;
            height: 40px;
            background-color: gold;
            border-radius: 50%;
            box-shadow: 0 6px 10px 0 #666;
            transition: all 0.1s ease-in-out;

            font-size: 20px;
            color: white;
            text-align: center;
            line-height: 40px;

            position: fixed;
            right: 2%;
            bottom: 18%;
        }

        .fab:hover {
            box-shadow: 0 6px 14px 0 #666;
            transform: scale(1.15);
        }

        @media screen and (max-width: 1000px) {
            .fab {
                display: none;
            }
        }
    </style>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 700px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection('css')
@section('script')
    <!-- begin::datepicker -->


    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->
    <script src="/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script src="/js/sweetalert.min.js"></script>

    <script src="/assets/excel/ry.stickyheader.js/jquejs"></script>
    @include('sweet::alert')
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>گزارش مشاوره ای</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">گزارش مشاوره ای</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ثبت گزارش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body" style="padding-right: -10px">

            <div style="text-align: right">
                <br>
                <b> لطفا نام و یا نام خانوادگی {{config('global.student')}} را سرچ کنید...</b></div>

            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-responsive">
                <table class="overflow-y" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>عکس</th>
                        <th style="text-align: center">نام</th>
                        <th style="text-align: center">نام خانوادگی</th>
                        <th style="text-align: center">ثبت گزارش</th>
                        <th style="text-align: center">گزارشات این {{config('global.student')}}</th>


                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @include('Admin.errors')
                    @foreach($data as $user )
                        <tr style="text-align: center">
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->filename)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>
                                </div>
                            </td>
                            <td style="text-align: center">{{$user->f_name}}</td>
                            <td style="text-align: center">{{$user->l_name}}</td>
                            <td style="text-align: center">
                                <div class="col-md-12" style="text-align: center">

                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#mark-{{$user->id}}">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="mark-{{$user->id}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="/teacher/moshaver/sabt" method="post">
                                                @csrf


                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalCenterTitle">
                                                        نام {{config('global.student')}}:
                                                        {{$user->f_name}}
                                                        {{$user->l_name}}

                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label style="text-align: right">تاریخ</label>
                                                    <input name="user_id" value="{{$user->id}}" hidden>
                                                    <input name="class_id" value="{{$user->class}}" hidden>
                                                    <input style="text-align: center" type="text" name="date-picker-shamsi-list"
                                                           id=""
                                                           class="form-control"
                                                           dir="ltr" required autocomplete="off">
                                                    <label style="text-align: right">متن</label>
                                                    <textarea name="text" rows="3" class="form-control">
                                                            </textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">بستن
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">ذخیره
                                                        تغییرات
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td style="text-align: center">
                                <a href="/teacher/moshaver/show/{{$user->id}}">
                                    <button class="btn btn-warning">مشاهده</button>
                                </a>

                            </td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>



@endsection('content')

<script>

</script>
