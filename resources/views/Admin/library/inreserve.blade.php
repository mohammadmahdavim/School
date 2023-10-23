@extends('layouts.admin')
@section('css')
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
            <h3>
                نمایش کتابخانه
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">رزرو شده ها</li>
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
                        <th>شماره کتاب</th>
                        <th>عنوان</th>
                        <th>رزور کننده</th>
                        <th>نویسنده</th>
                        <th>ناشر</th>
                        <th>موجودی</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($data as $row)
                        <tr class="form-group" STYLE="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->library->issue}}</td>
                            <td>{{$row->library->name}}</td>
                            <td>{{$row->user->f_name}} {{$row->user->l_name}}</td>
                            <td>{{$row->library->author}}</td>
                            <td>{{$row->library->publisher}}</td>
                            <td>{{$row->library->count}} جلد</td>
                            <td>{{$row->created_at->ToDateString()}} </td>
                            <td class="text-center">

                                <button onclick="deleteData({{$row->id}})" title="لغو رزرو"
                                        class="btn btn-success btn-warning btn-rounded">لغو رزرو
                                </button>
                                @if($row->library->count>0)
                                    <form method="post" action="/admin/library/trust/store">
                                        @csrf
                                        @include('errors')
                                        <input id="user_id" name="user_id" value="{{$row->user_id}}" hidden>
                                        <input id="library_id" name="library_id" value="{{$row->library_id}}" hidden>


                                        <button type="submit" class="btn btn-primary btn-rounded" title="امانت">امانت
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $data->links() }}

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
                        url: "{{  url('/admin/library/cancelreserve')  }}" + '/' + id,
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
