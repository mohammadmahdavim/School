@extends('layouts.teacher')
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
            <br>
            <h3>
                آیتم های ایجاد کرده درس {{$dars}}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمره</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                         درس {{$dars}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')







    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <h3 style="font-family: 'B Titr';font-size: large"> آیتم های ایجاد کرده
                    برای درس
                    <b style="color: #1d68a7"> {{$dars}} </b>
                               <div class="row text-center justify-content-md-center">


                        <div class="col-md-6 m-t-b-20" style="text-align: right">
                            <a href="/teacher/createmarkshow/{{$idc}}/{{$idd}}">
                                <button class="btn btn-primary"><span
                                            style="color: #9effff;font-family: 'B Koodak';font-size: medium"><i
                                                class="icon-move-right"
                                                style="color: #9effff"></i> ایجاد آیتم جدید</span>
                                </button>
                            </a>
                        </div>

                        <div class="col-md-6 m-t-b-20" style="text-align: left">
                            <a href="/teacher/mark/{{$idc}}/{{$idd}}">
                                <button class="btn btn-success "><span
                                    >برو به صفحه نمره دهی <i class="icon-move-left" style="color: #0a6aa1"></i></span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="tab-content">
                        <div class="table-responsive">

                            <table class="table  table-striped">
                                <thead>


                                <thead>
                                <tr style="text-align: center">
                                    <th>شماره</th>
                                    <th>آیتم وارد شده</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>


                                <tbody>
                                @include('Admin.errors')
                                <?php $idn = 0; ?>
                                @foreach($cmark as $mark)
                                    <?php $idn = $idn + 1; ?>
                                    <form action="{{url('/teacher/editeemark').'/'.$mark->id}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" style="text-align: center" value="{{$mark->id}}">
                                        @method('put')
                                        <tr style="text-align: center">
                                            <td> {{$idn}} </td>
                                            <td><input class="form-rounded " dir="rtl" name="name" id="name"
                                                       style="text-align: center" value="{{$mark->name}}"></td>
                                            <td><input class="form-rounded " dir="rtl"
                                                       style="text-align: center"
                                                       value="{{ $mark->created_at->toDateString() }}"
                                                       readonly="readonly"></td>

                                            <td>
                                                <button type="submit" class="btn btn-success btn-rounded "
                                                >ویرایش کن
                                                </button>
                                            </td>
                                    </form>
                                    <td>
                                        <button class="btn btn-danger btn-rounded " onclick="deleteData({{$mark->id}})"
                                        >حذف
                                        </button>
                                    </td>
                                    </tr>
                                @endforeach


                                </tbody>


                            </table>
                        </div>
                    </div>
            </div>
        </div>

        @endsection('content')
        <script>
            function deleteData(id) {
                swal({
                    title: "آیا از حذف مطمئن هستید؟",
                    text: "اگر حذف شود تمام دیتای مرتبط با آن مانند نمرات اختصاصی به {{config('global.students')}} در این آیتم حذف می گردد!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })

                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{  url('/teacher/markdelet/')  }}" + '/' + id,
                                type: "GET",

                                success: function () {
                                    swal({
                                        title: "حذف با موفقیت انجام شد.'",
                                        icon: "success",
                                        buttons: true,
                                        timer: '400000'


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

        <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
