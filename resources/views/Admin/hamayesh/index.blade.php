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
            <h3>
                لیست همایشات
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">همایشات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست همایشات</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان</th>
                        <th>مدیر</th>
                        <th>تاریخ</th>
                        <th>ساعت</th>
                        <th>وضعیت</th>
                        <th>تصویر</th>
                        <th>چک لیست افراد</th>
                        <th>مشاهده و یرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($rows as $row)
                        <tr class="form-group" style="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->manager}}</td>
                            <td>{{$row->date}}</td>
                            <td>{!! $row->time !!}</td>

                            <td style="text-align: center">

                                <input style="text-align: center" type="checkbox" class="form-check-input"
                                       id="materialUnchecked"
                                       {{ $row->status ? 'checked' : '' }} onclick="toggless('{{$row->id}}',this) ">
                            </td>
                            <td class="table-inbox-attachment">
                                @if(!empty($row->file) )
                                    <img src="{{url('images/'.$row->file)}}" alt="Cinque Terre" width="80"
                                         height="80">
                                @else
                                    <span>عکسی وجود ندارد</span>
                                @endif
                            </td>
                            <td style="text-align: center"><a href="/admin/hamayesh/{{$row->id}}">
                                    <button class="btn btn-outline-primary">کلیک کنید</button>
                                </a></td>
                            <td style="text-align: center"><a href="/admin/hamayesh/{{$row->id}}/edit">
                                    <button class="btn btn-outline-info">کلیک کنید</button>
                                </a></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-rounded" onclick="deleteData({{$row->id}})"><i
                                            class="ti-trash"></i></button>
                            </td>


                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')
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
            url: '{{url('/admin/selection/changeStatus')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "رویداد فعال شد",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "رویداد غیر فعال شد",
                        icon: "success",

                    });
                }
            }
        })


    }
</script>

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
                        url: "{{  url('/admin/hamayesh/delete')  }}" + '/' + id,
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
