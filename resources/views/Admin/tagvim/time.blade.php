@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#exampleModal").modal('show');
        });
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ایجاد ساعت جدید</h5>
            <form action="/admin/tagvim/time/store" method="post">
                @csrf
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-3">
                        <label>از ساعت</label>
                        <input class="form-control" name="start">
                    </div>
                    <div class="col-md-3">
                        <label>تا ساعت</label>
                        <input class="form-control" name="end">
                    </div>
                    <div class="col-md-3">
                        <label>نام مستعار</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="col-md-3">
                        <br>

                        <button type="submit" class="btn btn-primary">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">                <thead>
                <tr>
                    <td>نام</td>
                    <td>ساعت</td>
                    <td>ویرایش</td>
                    <td>حذف</td>
                </tr>
                </thead>
                <tbody>
                @foreach($times as $time)
                    <tr>
                        <td>{{$time->name}}</td>
                        <td>{{$time->start}} - {{$time->end}}</td>
                        <td>
                            <button type="button" class="btn btn-primary m-l-5 m-t-5" data-toggle="modal" data-target="#mark-{{$time->id}}">ویرایش
                            </button>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="mark-{{$time->id}}" aria-labelledby="myLargeModalLabel{{$time->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="/admin/tagvim/time/edit/{{$time->id}}">
                                        @csrf

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ویرایش</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>از ساعت</label>
                                                    <input name="start" class="form-control" value="{{$time->start}}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>تا ساعت</label>
                                                    <input name="end" class="form-control" value="{{$time->end}}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>نام</label>
                                                    <input name="name" class="form-control" value="{{$time->name}}">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                                            </button>
                                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-rounded" onclick="deleteData({{$time->id}})"><i
                                        class="ti-trash"></i></button>
                        </td>                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
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
                        url: "{{  url('/admin/tagvim/time/delete')  }}" + '/' + id,
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



