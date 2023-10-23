@extends('layouts.admin')
@section('css')

@endsection('css')
@section('script')
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
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
                    <li class="breadcrumb-item active" aria-current="page"> نمایش {{config('global.studentS')}}</li>
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
            <input id="myInput" type="text" placeholder="نام {{config('global.student')}} را وارد کنید" class="form-control col-md-4">
            <br>

            <div class="media-body table-responsive">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">

                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نام پدر</th>
                        <th>کلاس</th>
                        <th>پایه تحصیلی</th>
                        <th>کد ملی</th>
                        <th>ویرایش اطلاعات</th>
                        <th>حذف</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @include('Admin.errors')
                    @foreach($users as $user )
                        <form action="{{url('/admin/student/edite').'/'.$user->id}}" method="post">
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
                                <td>{{$user->fname}} </td>
                                <td>
                                    {{$user->class}}
                                </td>
                                <td>
                                    {{$user->paye}}
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
