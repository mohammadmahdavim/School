@extends('layouts.admin')
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
            <h3>موارد ثبت شده</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">گزارش مشاوره ای</a></li>
                    <li class="breadcrumb-item active" aria-current="page">موارد ثبت شده</li>
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
                        <th style="text-align: center">گزارش ثبت شده</th>
                        <th style="text-align: center">تاریخ</th>
                        <th style="text-align: center">حذف</th>


                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @include('Admin.errors')
                    @foreach($data as $user )
                        <tr style="text-align: center">
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->user->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->user->filename)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>
                                </div>
                            </td>
                            <td style="text-align: center">{{$user->user->f_name}}</td>
                            <td style="text-align: center">{{$user->user->l_name}}</td>
                            <td style="text-align: center">
                              {!! $user->text !!}

                            </td>
                            <td style="text-align: center">
                                {!! $user->date !!}

                            </td>
                            <td>


                                <div style="text-align: center">

                                    <button class="btn btn-danger" onclick="deleteData({{$user->id}})"><i
                                                class="ti-trash"></i>
                                    </button>


                                </div>

                            </td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>




@endsection('content')

<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام دیتای مرتبط با آن حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/moshaver/destroy/')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "مورد انضباطی شما با موفقیت حذف گردید!",
                                icon: "success",

                            });
                            window.location.reload(true);
                        },
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
                    swal("عملیات حذف لغو گردید");
                }
            });

    }

</script>
