@extends('layouts.admin')

@section('script')
    <script>
        $(document).on("click", ".delete", function () {
            var id = $(this).data('id');
            var el = this;

            Swal.fire({
                title: 'از حذف مطمئن هستید؟',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a018',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.value) {
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: '{{ url('admin/permissions') }}/' + id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },

                        success: function (data) {
                            if (data == 'ok') {
                                Swal.fire(
                                    'موفق',
                                    'حذف گردید',
                                    'success'
                                );
                                $(el).closest("tr").remove();
                            } else {
                                Swal.fire(
                                    'خطا',
                                    'مشکلی رخ داد',
                                    'danger'
                                )
                            }
                        }
                    });
                }
            });
        });

    </script>
    <script>
        $(document).on("click", ".update", function () {
            var id = $(this).data('id');
            var el = this;
            $("#modal_default").modal('show');
            $("#content-update").html("");
            $("#loading_box").show();

            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '{{ url('admin/permissions') }}/' + id + '/edit',
                type: 'GET',

                success: function (data) {
                    $("#loading_box").hide();
                    $("#content-update").html(data);
                }
            });

        });

    </script>
@stop

@section('css')

@stop
@section('header')
    <div class="page-header">
        <div>
            <h3>مجوز ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">مجوز ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <!-- Bordered striped table -->
<div class="card">
    <div class="card-body">
        <div class="panel-heading">
            <h5 class="panel-title">مدیریت مجوزها</h5>
            <div class="heading-elements">
                <button class="btn btn-info btn-rounded">
                    <a href="{{ url('admin/permissions/create') }}" class="btn bg-blue btn-xs btn-icon">
                        <i class="icon-plus2"></i>
                        افزودن مجوز
                    </a>
                </button>

            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="permissions">
                <thead>
                <tr style="text-align: center">
                    <th>#</th>
                    <th>نام دسترسی</th>
                    <th>عنوان دسترسی</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $key=>$permission)
                    <tr style="text-align: center">
                        <td>{{$key+1}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->label}}</td>
                        <td>
                            <button class="btn btn-danger btn-rounded" onclick="deleteData({{$permission->id}})"><i
                                        class="ti-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!-- /bordered striped table -->

    {{ $permissions->links() }}


@endsection

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
                        url: "{{  url('/admin/permissions/delete')  }}" + '/' + id,
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
