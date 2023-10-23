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
            <h3>لیست دروس آزمون {{$exam->title}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست دروس آزمون {{$exam->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <br>

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>درس</th>
                        <th>ترتیب</th>
                        <th>سوالات</th>
                        <th>حذف درس</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($doros as $dars)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$dars->darsname->name}}</td>
                            <td>
                                <form action="/admin/exam/doros/sort/{{$exam->id}}" method="post">
                                    @csrf
                                    <input name="dars_id" value="{{$dars->dars_id}}" hidden>
                                    <select name="sort" class="form-control">
                                        <option></option>
                                        @for($i = 1; $i <= $exam->number_dars; $i++)
                                            <option @if($i==$dars->sort) selected @endif>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-sm btn-info" type="submit">ثبت</button>
                                </form>
                            </td>
                            <td><a href="/admin/exam/dars/{{$dars->id}}">
                                    <button class="btn btn-primary">کلیک کنید</button>
                                </a></td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteData({{$dars->id}})"><i
                                        class="icon-trash"></i></button>
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
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام سوالات و جواب های مرتبط حذف می گردد!!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/exam/dars/delete/')  }}" + '/' + id,
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
