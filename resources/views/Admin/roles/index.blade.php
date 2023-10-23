@extends('layouts.admin')

@section('script')

@stop

@section('css')

@stop
@section('header')
    <div class="page-header">
        <div>
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اولیا</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Bordered striped table -->
            <div class="panel panel-flat">

                <button class="btn btn-info btn-rounded">
                    <a href="{{ url('admin/roles/create') }}" class="btn bg-blue btn-xs btn-icon">
                        <i class="icon-plus2"></i>
                        افزودن نقش
                    </a>
                </button>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr style="text-align: center">
                            <th>#</th>
                            <th>نام نقش</th>
                            <th>عنوان نقش</th>
                            <th>دسترسی ها</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key=>$role)
                            <tr style="text-align: center">
                                <td>{{$key+1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->label}}</td>
                                <td>
                                    @foreach($role->permissions as $permission)

                                        <span class="btn btn-info btn-rounded ">  {{$permission->label}}</span>
                                    @endforeach
                                </td>

                                <td>
                                    <button class="btn btn-danger btn-rounded"
                                            onclick="deleteData({{$role->id}})"><i
                                                class="ti-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /bordered striped table -->
        </div>
    </div>

    {{ $roles->links() }}
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
                        url: "{{  url('/admin/roles/delete')  }}" + '/' + id,
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
