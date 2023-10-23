@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
@endsection('css')
@section('script')
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <script>
        jQuery(document).ready(function () {
            jQuery('#hideshow').on('click', function (event) {
                jQuery('#search').toggle('show');
            });
        });
    </script>
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>
                نمایش کتابخانه
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <input type='button' class="btn btn-primary" id='hideshow' value='جستجوی پیشرفته'>
            <div id='search'  style="display: none">
                <form method="get" action="/admin/library/index">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <input class="form-control" id="issue" name="issue" value="{{request()->issue}}"
                                   placeholder="شماره کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="name" name="name" value="{{request()->name}}"
                                   placeholder="نام کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="author" name="author" value="{{request()->author}}"
                                   placeholder="نویسنده کتاب را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="publisher" name="publisher" value="{{request()->publisher}}"
                                   placeholder="ناشر را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input type="text" name="start_date" id="date-picker-shamsi-list"
                                   class="form-control text-right"
                                     value="{{request()->start_date}}" placeholder="تاریخ ایجاد از ...">
                            <br>
                            <input class="form-control date-picker-shamsi"  name="end_date"
                                   value="{{request()->end_date}}"
                                   placeholder="تاریخ ایجاد تا ...">
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>شماره کتاب</th>
                        <th>نام کتاب</th>
                        <th>نویسنده</th>
                        <th>ناشر</th>
                        <th>موجودی</th>
                        <th>تاریخ ایجاد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($data as $row)
                        <tr class="form-group" STYLE="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->issue}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->author}}</td>
                            <td>{{$row->publisher}}</td>
                            <td>{{$row->count}} جلد</td>
                            <td>{{$row->created_at->ToDateString()}} </td>
                            <td class="text-center">
                                <button title="حذف" class="btn btn-danger btn-rounded"
                                        onclick="deleteData({{$row->id}})"><i
                                            class="ti-trash"></i></button>
                                <a href="/admin/library/edit/{{$row->id}}">
                                    <button title="ویرایش" class="btn btn-success btn-rounded">ویرایش</button>
                                </a>
                                @if($row->count>0)
                                    <a href="/admin/library/trust/{{$row->id}}">
                                        <button type="button" class="btn btn-primary btn-rounded">امانت
                                        </button>
                                    </a>
                                @else
                                    <a href="/admin/library/reservation/{{$row->id}}">
                                        <button title="رزرو کردن" class="btn btn-warning btn-rounded">رزرو</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $data->links() }}

        </div>
    </div>


    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
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
                        url: "{{  url('/admin/library/delete')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "حذف با موفقیت انجام شد!",
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
