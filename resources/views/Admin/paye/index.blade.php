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
            <h3>نمایش و ایجاد</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">پایه ها </a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش و ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <form method="POST" action="/admin/paye/store" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @include('Admin.errors')
                    <h4><label>ایجاد پایه جدید</label></h4>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>پایه</label></h6>

                                <select type="text" id="name" class="form-control" name="name">
                                    <option>دوازدهم</option>
                                    <option>یازدهم</option>
                                    <option>دهم</option>
                                    <option>نهم</option>
                                    <option>هشتم</option>
                                    <option>هفتم</option>
                                    <option>ششم</option>
                                    <option>پنجم</option>
                                    <option>چهارم</option>
                                    <option>سوم</option>
                                    <option>دوم</option>
                                    <option>اول</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <h6><label>ثبت</label></h6>
                            <button class="btn btn-primary" type="submit">ایجاد پایه
                            </button>
                        </div>
                    </div>


                </form>
                <form method="POST" action="/admin/paye/store" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @include('Admin.errors')
                    <h4><label>ایجاد پایه جدید</label></h4>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="center-text">
                                <h6><label>پایه(اگر پایه شما جز موارد بالا نیستش.)</label></h6>

                                <input type="text" id="name" class="form-control" name="name">
                                </input>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <h6><label>ثبت</label></h6>
                            <button class="btn btn-primary" type="submit">ایجاد پایه
                            </button>
                        </div>
                    </div>


                </form>

                <br>
                <br>
                <hr>
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                        <tr class="danger" style="text-align: right">
                            <th>شمارنده</th>
                            <th>پایه</th>
                            <th>حذف</th>


                        </tr>
                        </thead>
                        <tbody>


                        <?php $idn = 1; ?>

                        @foreach($payes as $paye)

                            <tr style="text-align: right">
                                <td>{{$idn}}</td>

                                <td>

                                    <div class="media-body">
                                        <div class="letter-icon-title text-semibold">{{$paye->name}}</div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-rounded" onclick="deleteData({{$paye->id}})"><i
                                                class="ti-trash"></i></button>
                                </td>

                            </tr>
                            <?php $idn = $idn + 1 ?>

                        @endforeach


                        <script src="/js/sweetalert.min.js"></script>
                        @include('sweet::alert')
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
            text: "اگر حذف شود تمام دیتای مرتبط با آن حذف می گردد! اگر کلاسی و یا درسی به این پایه اختصاص داده نشده حذف نمایید",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/paye/destroy')  }}" + '/' + id,
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
