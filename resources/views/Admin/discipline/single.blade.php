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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مشاهده مواردانضباطی</a></li>

                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">

            <input id="myInput" type="text" placeholder="نام دانش آموز را جستجو کنید" class="form-control col-md-4">
            <br>
            <div class="table-responsive">

            <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                <thead>
                <tr style="text-align: center">
                    <th>عکس</th>
                    <th>نام</th>
                    <th>مورد ثبت شده</th>
                    <th>نمره کسر شده</th>
                    <th>تاریخ ثبت</th>
                    <th>حذف مورد</th>
                </tr>
                </thead>
                <tbody>
                @foreach($disiplins as $disiplin )

                    <tr style="text-align: center">
                        <td>
                            <div class="gallery">
                                <figure class="avatar avatar-sm avatar-state-success">
                                    @if(!empty($disiplin->user->filename))
                                        <img class="rounded-circle"
                                             src="{{url('uploads/'.$disiplin->user->filename)}}"
                                             alt="...">
                                    @else
                                        <img class="rounded-circle" src="/assets/profile/avatar.png"
                                             alt="...">
                                    @endisset
                                </figure>

                            </div>
                        </td>
                        <td>{{$disiplin->user->f_name}} - {{$disiplin->user->l_name}}</td>
                        <td>{{$disiplin->CDisciplines->name}}</td>
                        <td style="background-color: #b91d19;color: black">{{($disiplin->mark)/10}}</td>
                        <td>{{$disiplin->created_at->toDateString()}}</td>
                        <td style="text-align: center">
                            <div style="text-align: center">

                                <button class="btn btn-danger" onclick="deleteData({{$disiplin->id}})"><i
                                            class="ti-trash"></i>
                                </button>


                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr style="text-align: center">
                    <td>
                        نمره انضباط کل
                    </td>
                    <td></td>
                    <td></td>
                    <td style="background-color: lightskyblue ;color: black">{{(100-$total)/5}}</td>
                    <td style="text-align: center"></td>
                    <td></td>

                </tr>

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
            text: "اگر حذف شود تمام دیتای مرتبط با آن حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/discipline/destroy/')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "مورد انضباطی شما با موفقیت حذف گردید!",
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
