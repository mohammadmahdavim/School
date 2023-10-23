@extends('layouts.admin')

@section('content')
    <script>
        function toggless(id, obj) {
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
                url: '{{url('/admin/RTamas/changeStatus')}}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: status,
                    "id": id
                },
                success: function (data) {
                    if (status == 1) {
                        swal({
                            title: "به این درخواست رسیدگی شد",
                            icon: "success",

                        });
                    }
                    if (status == 0) {
                        swal({
                            title: "از حالت رسیدگی خارج شد",
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

                مشاهده درخواست های همکاری
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">درخواست ها</li>
                    <li class="breadcrumb-item active" aria-current="page">مشاهده</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="card">
        <div class="card-body">
            <div class=" table-responsive ">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr class="success">
                        <th>شمارنده</th>
                        <th>وضعیت رسیدگی</th>
                        <th>ایمیل</th>
                        <th>شماره تلفن</th>
                        <th>دسته بندی</th>
                        <th>تاریخ درخواست تماس</th>
                        <th>تاریخ ارسال درخواست</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach( $rows as $row )


                        @if($row->status == 0)
                            <tr style="color: red">
                        @elseif($row->status == 1)
                            <tr style="color: black">
                                @endif
                                <td style="text-align: center">{{$idn}}</td>
                                <td style="text-align: center">

                                    <input style="text-align: center" type="checkbox" class="form-check-input"
                                           id="materialUnchecked"
                                           {{ $row->status ? 'checked' : '' }} onclick="toggless('{{$row->id}}',this) ">
                                </td>
                                <td>
                                    {{$row->email}}
                                </td>
                                <td>
                                    {{$row->phone}}
                                </td>
                                <td>
                                    {{$row->place}}
                                </td>
                                <td>
                                    {{$row->date}}
                                </td>
                                <td>
                                    {{$row->created_at}}
                                </td>
                                <td>
                                    <div>
                                        <button class="btn btn-danger" onclick="deleteData({{$row->id}})">حذف</button>
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
                        url: "{{  url('/admin/RTamas/destroy/')  }}" + '/' + id,
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

