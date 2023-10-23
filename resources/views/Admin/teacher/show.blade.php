@extends('layouts.admin')
@section('css')
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
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش {{config('global.teachers')}}</li>
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
                    <a href="/admin/teacher.create/1">
                        <button class="btn btn-outline-primary">ایجاد {{config('global.teacher')}} جدید(۱ کلاس و چند
                            درس)
                        </button>
                    </a>
                    <a href="/admin/teacher.create/2">
                        <button class="btn btn-outline-primary">ایجاد {{config('global.teacher')}} جدید(۱ درس و چند
                            کلاس)
                        </button>
                    </a>
                    <a href="/admin/program/teacher">
                        <button class="btn btn-outline-danger">مشاهده برنامه حضور {{config('global.teachers')}}</button>
                    </a>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <br>
                        <table class="table" id="myTable">
                            <thead>
                            <tr class="info">
                                <th> عکس</th>
                                <th>نام {{config('global.teacher')}}</th>
                                <th> نام خانوادگی {{config('global.teacher')}}</th>
                                <th> نمایش کلاس ها</th>
                                <th>ویرایش</th>
                                <th>حذف</th>

                            </tr>
                            </thead>
                            <tbody>
                            @include('Admin.errors')

                            @foreach($users as $user )

                                {{--<td><a href="{{$article->path}}"> {{$article->title}}</a></td>--}}
                                <tr>

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
                                    <td>{{$user->f_name}}
                                    </td>
                                    <td>{{$user->l_name}}
                                    </td>
                                    <td>
                                        <div>
                                            <a class="form-control btn btn-info"
                                               href="/admin/teacher/showclass/{{$user->id}}"> مشاهده کلاس ها
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="/admin/teacher/edit/{{$user->id}}">
                                                <button class="form-control btn btn-success"> ویرایش
                                                </button>
                                            </a>
                                        </div>
                                    <td>

                                        <div>
                                            <button class="btn btn-danger" onclick="deleteData({{$user->id}})">حذف
                                            </button>
                                        </div>

                                    </td>


                                </tr>

                            @endforeach
                            <script src="/js/sweetalert.min.js"></script>
                            @include('sweet::alert')
                            </tbody>
                        </table>

                    </div>
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
                        url: "{{  url('/admin/teacher/destroy')  }}" + '/' + id,
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
