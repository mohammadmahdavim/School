@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->
@endsection('css')
@section('script')
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

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
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> نمایش {{config('global.students')}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div style="padding-right:8px">
                <a href="/admin/students.create">
                    <button class="btn btn-info">ایجاد {{config('global.student')}} جدید</button>
                </a>
            </div>

            <br>
            <br>
            <div id='searchform'>
                <form method="get" action="/admin/students" >
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <input class="form-control" id="name" name="name" value="{{request()->name}}"
                                   placeholder="نام را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="Fname" name="Fname" value="{{request()->Fname}}"
                                   placeholder="نام پدر را وارد کنید">
                        </div>
                        <div class="p-2">

                            <select id="class" name="class" class="form-control">
                                <option value="">کلاس را انتخاب کنید</option>
                                @foreach($allclass as $oneclass)
                                    <option @if(request()->class==$oneclass->classnamber) selected @endif>{{$oneclass->classnamber}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-2">
                            <input class="form-control" id="codemeli" name="codemeli" value="{{request()->codemeli}}"
                                   placeholder="کد ملی را وارد کنید">
                        </div>
                        <div class="p-2">
                            <input type="text" name="start_date" id="date-picker-shamsi-list"
                                   class="form-control text-right"
                                   value="{{request()->start_date}}" placeholder="تاریخ ثبت نام از ..."
                                   autocomplete="off">
                            <br>
                            <input class="form-control date-picker-shamsi" name="end_date"
                                   value="{{request()->end_date}}"
                                   placeholder="تاریخ ثبت نام تا ..." autocomplete="off">
                        </div>
                        <div class="p-2">
                            <button type="submit" class="btn btn-warning">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">

                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نام پدر</th>
                        <th>پایه تحصیلی و کلاس</th>
                        <th>کد ملی</th>
                        <th>ویرایش اطلاعات</th>
                        <th>حذف</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @include('Admin.errors')
                    @foreach($users as $user )
                        <form action="{{url('/admin/student/edite').'/'.$user->id}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            @method('put')

                            <tr style="text-align: center">
                                <td style="text-align: center">{{$idn}}</td>

                                <td>
                                    <div class="gallery">
                                        <figure class="avatar avatar-sm avatar-state-success">
                                            @if(!empty($user->filename))
                                                <img class="rounded-circle"
                                                     src="{{url('uploads/'.$user->filename)}}"
                                                     alt="...">
                                            @else
                                                <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                     alt="...">
                                            @endisset
                                        </figure>

                                    </div>
                                </td>
                                <td>{{$user->f_name}}</td>
                                <td>{{$user->l_name}}</td>
                                <td>{{$user->fname}}</td>

                                <td>
                                    {{$user->paye}} - {{$user->class}}
                                </td>
                                <td>
                                    {{$user->codemeli}}
                                </td>

                                <td>
                                    <a href="/admin/students/edit/{{$user->id}}">
                                        <button type="button" class="btn btn-info">ویرایش</button>

                                    </a>

                                </td>
                        </form>
                        <td>


                            <div>

                                <button class="btn btn-danger" onclick="deleteData({{$user->id}})"><i
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
            {{ $users->links() }}

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
                        url: "{{  url('/admin/student/destroy/')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "{{config('global.student')}} و اولیا مورد نظر با موفقیت حذف شد!",
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
