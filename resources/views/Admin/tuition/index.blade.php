@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
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
            <h3>شهریه ها </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">شهریه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">شهریه ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center" class="success">
                        <th>شمارنده</th>
                        <th>عنوان</th>
                        <th>مبلغ</th>
                        <th>کلاس</th>
                        <th>تاریخ ایجاد</th>
                        <th>فرصت پرداخت</th>
                        <th>حذف</th>
                        <th>نمایش پرداختی ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($tuitions as $tuition)

                        <tr style="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>


                            <td>{{$tuition->title}}</td>
                            <td>{{$tuition->price}} ریال</td>
                            <td>
                                <button class="btn btn-rounded" id="mark2"
                                        name="mark2">{{$tuition->class->classnamber}}</button>
                            </td>
                            <td>{{ $tuition->created_at }}</td>
                            <td>{{ $tuition->expire }}</td>

                            <td class="text-center">
                                <button class="btn btn-danger btn-rounded" onclick="deleteData({{$tuition->id}})"><i
                                            class="ti-trash"></i></button>
                            </td>
                            <td>
                                <a href="/admin/tuition/{{$tuition->id}}">
                                    <button class="btn btn-info">نمایش</button>
                                </a>
                            </td>

                        </tr>
                        <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            {{ $tuitions->links() }}

        </div>
    </div>


    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

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
                        url: "{{  url('/admin/tuition/delete')  }}" + '/' + id,
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
