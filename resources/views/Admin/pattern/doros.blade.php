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
    <script src="/assets/js/jquery.min.js"></script>
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
            <h3>لیست الگو ها </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">الگو ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست دروس الگو {{$pattern->name}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <span style="color: black">عنوان الگو:{{$pattern->name}}</span>

                </div>
                <div class="col-md-6">
                    <span style="color: black">کلاس:{{$pattern->class_id}}</span>

                </div>
                <div class="col-md-6">
                    <span style="color: black">تاریخ شروع:{{$pattern->date_from}}</span>

                </div>
                <div class="col-md-6">
                    <span style="color: black">تاریخ پایان:{{$pattern->date_to}}</span>

                </div>
            </div>
            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="">
                <form action="/admin/pattern/doros/store" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="pattern" value="{{$pattern->id}}">
                    <table class="table table-responsive table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr class="success" style="text-align: center">
                            <th>درس</th>
                            @foreach($days as $day)
                                <th>{{$day->name}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doros as $dars)

                            <tr style="text-align: center">
                                <td>{{$dars->name}}</td>
                                @foreach($patternItems as $key=>$patternItem)
                                    <td><input class="form-control" name="time[{{$key}}][{{$dars->id}}]"
                                               value="{{$patternItem->where('dars_id',$dars->id)->pluck('time')->first()}}"
                                               placeholder="زمان(دقیقه)    ">
                                        <select class="form-control" name="status[{{$key}}][{{$dars->id}}]">
                                            @foreach($statuses as $status)
                                                <option
                                                    @if($patternItem->where('dars_id',$dars->id)->pluck('status')->first()==$status->id) selected
                                                    @endif value="{{$status->id}}">{{$status->name}}</option>
                                            @endforeach
                                        </select>

                                        <input class="form-control" name="description[{{$key}}][{{$dars->id}}]"
                                               value="{{$patternItem->where('dars_id',$dars->id)->pluck('description')->first()}}"
                                               placeholder="توضیحات"
                                        >
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    <button class="btn btn-info btn-block">ثبت</button>
                </form>
            </div>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')
<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود از باکس {{config('global.students')}} نیز حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/online/Delete/')  }}" + '/' + id,
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
            url: '{{url('/admin/pattern/changeStatus')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "نمایش الگو برای دانش آموزان فعال شد",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "نمایش الگو برای دانش آموزان غیر فعال شد",
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
                        url: "{{  url('/admin/pattern/destroy/')}}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "الگو حذف گردید!",
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



