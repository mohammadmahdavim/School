@extends('layouts.admin')
@section('css')

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
            <h3>نمونه سوالات</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">نمونه سوالات</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success">
                        <th>آپلود کننده</th>
                        <th>پایه</th>
                        <th>درس</th>
                        <th>فصل</th>
                        <th>تعداد دانلود</th>
                        <th>تاریخ ارسال</th>
                        <th>درآمد شما از این مطلب</th>
                        <th>دانلود مطلب</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question )
                        <tr style="text-align: center">
                            <td>{{\App\User::where('id',$question->user_id)->first()['f_name']}} {{\App\User::where('id',$question->user_id)->first()['l_name']}}</td>
                            <td>{{$question->paye}}</td>
                            <td>{{$question->dars}}</td>
                            <td>{{$question->chapter}}</td>
                            <td>
                                {{$question->downloadcount}}
                            </td>
                            <td>{{ $question->created_at }}</td>

                            <td>
                                0تومان
                            </td>
                            <td>
                                <a href="{{ route('question.download', $question->id) }}" class="btn btn-outline-warning">
                                    <i class="icon-download"></i> Download </a>

                            <td>
                                <button class="btn btn-danger" onclick="deleteData({{$question->id}})"><i
                                            class="icon-trash"></i></button>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>



@endsection('content')

<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
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
                        url: "{{  url('/admin/question/Delete/')  }}" + '/' + id,
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
