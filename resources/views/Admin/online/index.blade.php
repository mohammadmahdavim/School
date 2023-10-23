@extends('layouts.admin')
@section('css')
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection('css')
@section('script')
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
@endsection('css')
@section('script')

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>کلاس های آنلاین </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کلاس ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">کلاس های آنلاین مربوط به کلاس {{$id}} </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان کلاس</th>
                        <th>درس</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>روز</th>
                        <th>ساعت شروع</th>
                        <th>ساعت پایان</th>
                        <th>توضیحات</th>
                        <th>وضعیت</th>
                        <th> فایل ارسالی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>


                            <td style="text-align: center">{{$row->title}}</td>
                            <td style="text-align: center">{{$row->dars}}</td>
                            <td style="text-align: center">{{$row->date}}</td>
                            <td style="text-align: center">{{$row->enddate}}</td>
                                <td style="text-align: center">{{$row->day->name}}</td>

                                <td style="text-align: center">{{$row->start}}</td>
                            <td style="text-align: center">{{$row->end}}</td>
                                <td style="text-align: center">{!! $row->description !!}</td>
                                <td style="text-align: center">
                                @if($row->status==1)
                                    فعال
                                @else
                                    غیر فعال
                                @endif
                            </td>
                                <td style="text-align: center">
                                    @if($row->mime)
                                        <a href="{{ route('class.download', $row->id) }}"
                                           class="btn btn-outline-warning">
                                            <i class="icon-download"></i> Download </a>

                                    @endif
                                </td>
                                <td>

                                <a href="/admin/online/join/{{$row->id}}" target="_blank">
                                    <button class="btn  btn-info btn-sm">ورود</button>
                                </a>
                                <a href="/admin/online/list/{{$row->id}}">
                                    <button class="btn btn-sm btn-info">حاظرین</button>
                                </a>
                                    <a href="/admin/online/blockList/{{$row->id}}">
                                        <button class="btn btn-sm btn-danger">بلاک شده ها</button>
                                    </a>
                                <a href="/admin/online/edit/{{$row->id}}">
                                    <button class="btn btn-sm btn-success">ویرایش</button>
                                </a>
                                <a href="/online/records/{{$row->id}}" target="_blank">
                                    <button class="btn btn-sm btn-warning">فیلم</button>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="deleteData({{$row->id}})"><i
                                        class="icon-trash"></i></button>

                            </td>
                    </tr>

                    <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $rows->links() }}

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')
<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود از باکس {{config('global.students')}} نیز حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/online/Delete/')  }}" + '/' + id,
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


