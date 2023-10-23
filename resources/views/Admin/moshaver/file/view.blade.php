@extends('layouts.admin')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">

    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <script type="text/javascript" src="/assets/jss/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/jss/js/pages/form_multiselect.js"></script>

    <!-- end::dataTable -->

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
                    <li class="breadcrumb-item"><a href="#">برنامه های مشاوره ای</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                        <tr class="danger">
                            <th>عنوان</th>
                            <th>پایه</th>
                            <th>برنامه مشاوره ای</th>
                            <th>تاریخ ارسال</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $barnameh)
                            <tr>
                                <td>
                                    <div class="media-body">
                                        <div class="letter-icon-title text-semibold">{{$barnameh->title}}</div>
                                    </div>
                                </td>
                                <td>

                                    <div class="media-body">
                                        <div class="letter-icon-title text-semibold">{{$barnameh->paye}}</div>
                                    </div>
                                </td>


                                <div class="media-body">
                                    <td><a href="{{ route('barname.moshaver.download', $barnameh->id) }}"
                                           class="btn btn-outline-warning"> <i class="icon-download"></i> Download </a>

                                    </td>
                                </div>
                                <td>
                                    {{$barnameh->created_at->ToDateString()}}
                                </td>

                                <td class="text-center">
                                    <button class="btn btn-danger btn-rounded" onclick="deleteData({{$barnameh->id}})">
                                        <i
                                                class="ti-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')



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
                        url: "{{  url('/admin/moshaver/file/destroy')  }}" + '/' + id,
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