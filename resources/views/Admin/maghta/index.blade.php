@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')

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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مقطع</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title">ایجاد</h5>
                    <form method="POST" action="/admin/maghta/store">
                        {{csrf_field()}}
                        @include('Admin.errors')
                        <span>نام</span>
                        <input name="name" class="form-control" required>
                        <br>
                        <button class="btn btn-info" type="submit">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr class="danger" style="text-align: center">
                            <th>شمارنده</th>
                            <th>اسم</th>
                            <th>حذف</th>

                        </tr>
                        </thead>
                        <tbody>

                        @include('Admin.errors')
                        @foreach($rows as $key=>$row )
                            <tr style="text-align: center">
                                <td>
                                    {{$key+1}}
                                </td>

                                <td>
                                    {{$row->name}}
                                </td>

                                <td>
                                    <div>
                                        <button class="btn btn-danger" onclick="deleteData({{$row->id}})">حذف</button>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
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
                        url: "{{  url('/admin/maghta/destroy/')  }}" + '/' + id,
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
