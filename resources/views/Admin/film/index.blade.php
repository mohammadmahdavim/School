@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#exampleModal").modal('show');
        });
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ایجاد دسته جدید</h5>
            <form action="/admin/section" method="post">
                @csrf
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-4">
                        <label>نام دسته</label>
                        <input class="form-control" name="section" required>
                    </div>


                    <div class="col-md-4">
                        <br>

                        <button type="submit" class="btn btn-primary">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <span>دسته ها</span>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <td>نام</td>

                        <td>حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sections as $section)
                        <tr style="text-align: center">
                            <td>{{$section->section}}</td>

                            <td class="text-center">
                                <button class="btn btn-danger btn-rounded" onclick="deleteData({{$section->id}})"><i
                                            class="ti-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ایجاد زیر دسته جدید</h5>
            <form action="/admin/bakhsh" method="post">
                @csrf
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-4">
                        <label>نام دسته</label>
                        <select class="form-control" name="section">
                            @foreach($sections as $section)
                                <option value="{{$section->id}}">{{$section->section}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>نام زیر دسته</label>
                        <input class="form-control" name="bakhsh" required>
                    </div>


                    <div class="col-md-4">
                        <br>

                        <button type="submit" class="btn btn-primary">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <span>زیر دسته ها</span>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <td>نام دسته</td>
                        <td>نام زیر دسته</td>

                        <td>حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bakhshs as $bakhsh)
                        <tr style="text-align: center">
                            <td>{{$bakhsh->section}}</td>
                            <td>{{$bakhsh->bakhsh}}</td>

                            <td class="text-center">
                                <button class="btn btn-danger btn-rounded" onclick="deleteData({{$bakhsh->id}})"><i
                                            class="ti-trash"></i></button>
                            </td>
                        </tr>
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
                        url: "{{  url('/admin/filmsection/delete')  }}" + '/' + id,
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



