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
            <h3>مشاهده مواردانضباطی</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مشاهده مواردانضباطی</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">

        <div class="card-body">
            <a href="/admin/cdiscipline/create"><button class="btn btn-outline-danger">ایجاد مورد جدید</button></a>

            <div class="table-responsive">
            <table class="table  table-bordered table-striped mb-0 table-fixed" id="myTable">

                <thead>
                <br>
                <tr style="text-align: center">
                    <th>شمارنده</th>
                    <th>مورد انضباطی</th>
                    <th>میزان کسر نمره</th>
                    <th>توضیحات</th>
                    <th>ثبت تغییرات</th>
                    <th>حذف مورد</th>

                </tr>
                </thead>
                <tbody>
                @include('Admin.errors')
                <?php $idn = 1; ?>
                @foreach($disciplines as $discipline )
                    <form action="{{url('/admin/cdiscipline/update').'/'.$discipline->id}}" method="post">
                        {{csrf_field()}}

                        @method('put')

                        <tr>
                            <td style="text-align: center">{{$idn}}</td>
                            <td><input class="input-group-text" dir="rtl" id="name" name="name"
                                       value="{{$discipline->name}} "></td>
                            <td>
                                <input style="text-align: center" type="number" value="{{$discipline->mark/5}}"   name="mark" id="mark" step="0.01" class="form-control">
                            </td>
                            <td><input class="input-group-text" dir="rtl" id="description" name="description"
                                       value="{{$discipline->description}} "></td>


                            <td>
                                <div style="text-align: center">

                                    <button type="submit" class="btn btn-info">ویرایش</button>

                                </div>

                            </td>
                    </form>
                    <td>


                        <div style="text-align: center">

                            <button class="btn btn-danger" onclick="deletdicipline({{$discipline->id}})"><i
                                        class="ti-trash"></i>
                            </button>


                        </div>

                    </td>

                    </tr>
                    <?php $idn = $idn + 1 ?>

                @endforeach

                </tbody>

            </table>
            </div>
            <!-- begin::sweet alert demo -->
            <script src="/js/sweetalert.min.js"></script>
        @include('sweet::alert')
        <!-- begin::sweet alert demo -->

        </div>
    </div>




@endsection('content')
<script>
    function deletdicipline(id) {
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
                        url: "{{  url('/admin/cdiscipline/destroy/')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "مورد انضباطی شما با موفقیت حذف گردید!",
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
