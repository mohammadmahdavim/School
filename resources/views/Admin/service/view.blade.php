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
                نمایش مطالب سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت صفحه اول سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
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
                        <th>دسته بندی</th>
                        <th>عنوان</th>
                        <th>عکس</th>
                        <th>نمایش</th>
                        <th>حذف</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($rows as $row)
                        <tr class="form-group">
                            <td style="text-align: center">{{$idn}}</td>

                            <td>{{$row->place}}</td>
                            <td>{{$row->title}}</td>
                            <td class="table-inbox-attachment">
                                @if(!empty(\App\HomeImage::where('matlab_id',$row->id)->orderby('created_at', 'desc')->first()['resize_image']) )
                                    <?php
                                    $img = \App\HomeImage::where('matlab_id', $row->id)->orderby('created_at', 'desc')->first();
                                    ?>
                                    <img src="{{url('images/'.$img->resize_image)}}" alt="Cinque Terre" width="80"
                                         height="80">

                                @else
                                    <span>عکسی وجود ندارد</span>
                                @endif
                            </td>
                            <td style="text-align: center"><a href="/admin/Services/singlepage/{{$row->id}}">
                                    <button class="btn btn-outline-dark">کلیک کنید</button>
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


    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
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
                        url: "{{  url('/admin/Services/delete')  }}" + '/' + id,
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
