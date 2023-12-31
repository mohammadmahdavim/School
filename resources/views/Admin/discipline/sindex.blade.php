@extends('layouts.admin')
@section('css')

    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">

@endsection('css')
@section('script')


    <!-- end::select2 -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
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
        <div id='searchform'>
            <form method="get" action="/admin/discipline/index">
                @csrf
                <div class="d-flex flex-row">
                    <div class="p-2">
                        <label>دانش آموز</label>

                        <select name="user_id" class="js-example-basic-single">
                            <option></option>
                            @foreach($users as $user)
                                <option @if($user->id==request()->user_id) selected
                                        @endif value="{{$user->id}}">{{$user->f_name}} {{$user->l_name}}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <div class="p-2">
                        <br>
                        <input type="text" name="start_date" id="date-picker-shamsi"
                               class="form-control text-right"
                               value="{{request()->start_date}}" placeholder="تاریخ ثبت از ..."
                               autocomplete="off">
                        <br>
                    </div>
                    <div class="p-2">
                        <br>
                        <input type="text" name="end_date" id="date-picker-shamsi-new"
                               class="form-control text-right"
                               value="{{request()->end_date}}" placeholder="تاریخ ثبت تا ..."
                               autocomplete="off">
                        <br>
                    </div>

                    <div class="p-2">
                        <br>
                        <button type="submit" class="btn btn-warning">جستجوکن</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="card-body">
            <a href="/admin/discipline/create">
                <button class="btn btn-outline-danger">ثبت مورد جدید</button>
            </a>
            <div class="table-responsive">

            <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">

                <thead>
                <br>

                <tr style="text-align: center">
                    <th>شمارنده</th>
                    <th>کلاس</th>
                    <th>نام دانش آموز</th>
                    <th>مورد انضباطی</th>
                    <th>میزان کسر نمره</th>
                    <th>تاریخ</th>
                    <th>توضیحات</th>
                    <th>حذف مورد</th>

                </tr>
                </thead>
                <tbody>

                <?php $idn = 1; ?>
                @foreach($disciplines as $discipline )
                    <tr style="text-align: center">
                        <td style="text-align: center">{{$idn}}</td>
                        <td style="text-align: center"> {{\App\User::where('id',$discipline->user_id)->first()['class']}}</td>
                        <td>
                            {{\App\User::where('id',$discipline->user_id)->first()['l_name']}}
                            - {{\App\User::where('id',$discipline->user_id)->first()['f_name']}}</td>
                        <td>{{\App\CDiscipline::where('id',$discipline->disciplines_id)->first()['name']}}</td>
                        <td>{{(\App\CDiscipline::where('id',$discipline->disciplines_id)->first()['mark'])}}</td>
                        <td>{{$discipline->date}}</td>
                        <td>{{$discipline->description}}</td>

                        <td>


                            <div style="text-align: center">

                                <button class="btn btn-danger" onclick="deleteData({{$discipline->id}})"><i
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
                        url: "{{  url('/admin/discipline/destroy/')  }}" + '/' + id,
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
