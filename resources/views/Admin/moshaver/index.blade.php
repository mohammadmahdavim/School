@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>
                نمایش جلسات
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">جلسات</a></li>
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
            <div class="media-body table-responsive">
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>مشاوره</th>
                        <th>عنوان</th>
                        <th>تاریخ اجراء</th>
                        <th>ساعت</th>
                        <th>اختصاص کلاس و {{config('global.student')}}</th>
                        <th>لیست {{config('global.students')}}</th>
                        <th>عملیات</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($rows as $row)
                        <tr style="text-align: center" class="form-group">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->user->f_name}} {{$row->user->l_name}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->date}}</td>
                            <td>{{$row->start}}</td>
                            <td>
                                <a href="/admin/moshaver/sync/{{$row->id}}">
                                    <button class="btn btn-info">کلیک کنید</button>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/moshaver/student/{{$row->id}}">
                                    <button class="btn btn-info">مشاهده</button>
                                </a>
                            </td>
                            <td style="text-align: center">
                                <a href="/admin/moshaver/edit/{{$row->id}}">
                                    <button class="btn btn-outline-dark">ویرایش</button>
                                </a>
                                @if($row->online==1)
                                    <a href="/admin/moshaver/join/{{$row->id}}" target="_blank">
                                        <button class="btn  btn-info btn-sm">ورود</button>
                                    </a>
                                    <a href="/admin/moshaver/records/{{$row->id}}" target="_blank">
                                        <button class="btn btn-sm btn-warning">فیلم</button>
                                    </a>
                                @endif
                            </td>

                            <td class="text-center">
                                <button class="btn btn-danger btn-rounded" onclick="deleteData({{$row->id}})"><i
                                        class="ti-trash"></i></button>
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
                        url: "{{  url('/admin/moshaver/destroy')  }}" + '/' + id,
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
