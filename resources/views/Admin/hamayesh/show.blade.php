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
                لیست افراد همایش {{$row->title}}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">همایشات</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست افراد همایش {{$row->title}}
                    </li>
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
            <form method="POST" action="/admin/hamayesh/list/{{$row->id}}">
                @csrf
                <div class="media-body table-responsive">
                    <table id="example1" class="table  table-striped table-bordered ">
                        <thead>
                        <tr style="text-align: center">
                            <th>شمارنده</th>
                            <th>حضور</th>
                            <th>تصویر</th>

                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>نقش</th>
                            <th>پایه</th>
                            <th>کلاس</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $idn = 1; ?>

                        @foreach($row->memeber as $ro)
                            <tr class="form-group" style="text-align: center">
                                <td style="text-align: center">{{$idn}}</td>
                                <td>
                                    <input style="text-align: center" type="checkbox" name="member[]" class="form-check-input" value="{{$ro->user->id}}">

                                </td>
                                <td>
                                    <div class="gallery">
                                        <figure class="avatar avatar-sm avatar-state-success">
                                            @if(!empty($ro->user->filename))
                                                <img class="rounded-circle"
                                                     src="{{url('uploads/'.$ro->user->filename)}}"
                                                     alt="...">
                                            @else
                                                <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                     alt="...">
                                            @endisset
                                        </figure>

                                    </div>
                                </td>

                                <td>{{$ro->user->f_name}}</td>
                                <td>{{$ro->user->l_name}}</td>
                                <td>{{$ro->user->role}}</td>
                                <td>{{$ro->user->paye}}</td>
                                <td>{{$ro->user->class}}</td>


                            </tr>
                            <?php $idn = $idn + 1 ?>
                        @endforeach

                        </tbody>

                    </table>
                </div>
                <button type="submit">ثبت</button>
            </form>

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
