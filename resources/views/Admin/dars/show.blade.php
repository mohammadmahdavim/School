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
                    <li class="breadcrumb-item"><a href="#">دروس</a></li>
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
                <div style="overflow-x:auto;">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0 table-fixed">
                            <thead>
                            <tr class="danger">
                                <th>تصویر</th>
                                <th>نام درس</th>

                                <th>واحد</th>
                                <th>رشته</th>
                                <th>پایه</th>
                                <th>آپلود تصویر</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @include('Admin.errors')
                            @foreach($dars as $dar )
                                <form action="{{url('/admin/dars/edite').'/'.$dar->id}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @method('put')
                                    <tr>
                                        <td>
                                            <div class="gallery">
                                                <figure class="avatar avatar-sm avatar-state-success">
                                                    @if(!empty($dar->file))
                                                        <img class="rounded-circle"
                                                             src="{{url('images/'.$dar->file)}}"
                                                             alt="...">
                                                    @else
                                                        <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                             alt="...">
                                                    @endisset
                                                </figure>

                                            </div>
                                        </td>
                                        <td><input class="js-example-basic-single" dir="rtl" style="text-align: center"
                                                   value="{{$dar->name}}" id="name"
                                                   name="name"></td>

                                        <td><input class="form-control" type="number" dir="rtl" style="text-align: center"
                                                   value="{{$dar->vahed}}" id="vahed"
                                                   name="vahed"></td>

                                        <td><select class="js-example-basic-single" dir="rtl" style="text-align: center"
                                                    id="reshte" name="reshte">
                                                <option>{{$dar->reshte}}</option>
                                                <option>بدون رشته</option>
                                                <option>ریاضی</option>
                                                <option>تجربی</option>
                                                <option>انسانی</option>
                                                <option>هنرستان</option>

                                            </select>
                                        </td>
                                        <td><select class="js-example-basic-single" dir="rtl" style="text-align: center"
                                                    id="paye"
                                                    name="paye">
                                                <option>{{$dar->paye}}</option>
                                                @foreach($paye as $p)
                                                    <option>{{$p->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" name="file">

                                        </td>
                                        <td>
                                            <div>
                                                <button class="btn btn-info" type="submit">ثبت تغییرات</button>
                                                </a>
                                            </div>
                                        </td>
                                </form>
                                <td>
                                    <div>
                                        <button class="btn btn-danger" onclick="deleteData({{$dar->id}})">حذف</button>
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

        <div style="text-align: center">
            {{--{!! $dars->render() !!}--}}
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
                                url: "{{  url('/admin/dars/destroy/')  }}" + '/' + id,
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
