@extends('layouts.admin')

@section('content')
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
                            url: "{{  url('/admin/blog/destroy/')  }}" + '/' + id,
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
    <script>
        function toggleess(id, obj) {
            var $input = $(obj);
            var status = 0;
            if ($input.prop('checked')) {
                var status = 1;
            }

            $.ajaxSetup({

                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: '{{url('/admin/Blog/changeStatus')}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: status,
                    "id": id
                },
                success: function (data) {
                    if (status == 1) {
                        swal({
                            title: "مقاله تایید شد",
                            icon: "success",

                        });
                    }
                    if (status == 0) {
                        swal({
                            title: "مقاله رد شد",
                            icon: "success",

                        });
                    }
                }
            })


        }
    </script>

    <div class="page-header">
        <div>
            <h3>

                مشاهده وبلاگ های دانش آموزان
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">وبلاگ ها</li>
                    <li class="breadcrumb-item active" aria-current="page">مشاهده</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-striped table-bordered">
                        <thead>
                        <tr class="success" style="text-align: center">
                            <th>شمارنده</th>
                            <th>تصویر</th>
                            <th>وضعیت رسیدگی</th>
                            <th>نویسنده</th>
                            <th>عنوان</th>
                            <th>توضیحات کوتاه</th>
                            <th>مشاهده</th>
                            <th>تاریخ ارسال</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $idn = 1; ?>

                        @foreach( $blogs as $blog )


                            @if($blog->status == 0)
                                <tr style="color: red;text-align: center">
                            @elseif($blog->status == 1)
                                <tr style="color: black;text-align: center">
                                    @endif
                                    <td style="text-align: center">{{$idn}}</td>
                                    <td>
                                        <div class="gallery">
                                            <img src="{{url('images/'.$blog->filename)}}" alt="Cinque Terre" width="80"
                                                 height="80">
                                        </div>
                                    </td>
                                    <td style="text-align: center">

                                        <input style="text-align: center" type="checkbox" class="form-check-input"
                                               id="materialUnchecked"
                                               {{ $blog->status ? 'checked' : '' }} onclick="toggleess('{{$blog->id}}',this) ">
                                    </td>
                                    <td>
                                        {{$blog->name}} {{$blog->role}}
                                    </td>
                                    <td>
                                        {{$blog->title}}
                                    </td>
                                    <td>
                                        {{$blog->little_body}}
                                    </td>
                                    <td style="text-align: center"><a href="/admin/Blog/single/{{$blog->id}}">
                                            <button class="btn btn-outline-dark">کلیک کنید</button>
                                        </a></td>
                                    <td>
                                        {{$blog->updated_at}}
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn btn-danger" onclick="deleteData({{$blog->id}})">حذف
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
        </div>
    </div>

@endsection('content')
