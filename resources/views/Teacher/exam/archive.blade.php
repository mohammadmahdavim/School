@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')@section('css')
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
            <h3>آرشیو آزمون ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون</a></li>
                    <li class="breadcrumb-item active" aria-current="page">آرشیو آزمون ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center" class="success">

                        <th>عنوان آزمون</th>
                        <th>زمان پاسخدهی</th>
                        <th>تاریخ پایان</th>
                        <th>تاریخ ایجاد</th>
                        <th>مشاهده سوالات</th>
                        <th>ویرایش و اختصاص کلاس</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row )
                        <tr style="text-align: center">

                            <td>{{$row->title}}</td>
                            <td>{{$row->time}}</td>
                            <td>{{$row->expire}}</td>
                            <td>{{ $row->created_at->toDateString() }}</td>
                            <td><a href="/teacher/exam/{{$row->id}}"><button class="btn btn-info">کلیک کنید</button></a></td>

                            {{--<td><a href="/teacher/exam/{{$row->id}}"><button class="btn btn-info">کلیک کنید</button></a></td>--}}
                            {{--<td><a href="/teacher/exam/student/{{$row->examclass[0]->class->classnamber}}/{{$row->id}}"><button class="btn btn-primary">کلیک کنید</button></a></td>--}}
                            <td><a href="/teacher/exam/sync/{{$row->id}}"><button class="btn btn-success">ویرایش</button></a></td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteData({{$row->id}})"><i
                                            class="icon-trash"></i></button>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>



@endsection('content')

<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام سوالات و جواب های مرتبط حذف می گردد!!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/teacher/exam/delete/')  }}" + '/' + id,
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
