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
            <h3>لیست آزمون های جامع کلاس {{$id}} </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست آزمون های جامع کلاس {{$id}}</li>
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
                        <th>عنوان آزمون</th>
                        <th>نوع آزمون</th>
                        <th>ایجاد کننده</th>
                        <th>شماره کلاس</th>
                        <th>زمان پاسخدهی</th>
                        <th>تاریخ پایان</th>
                        <th>تاریخ ایجاد</th>
                        <th>دروس</th>
                        <th>ویرایش</th>
                        <th>مشاهده {{config('global.students')}}</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($exams as $exam)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$exam->title}}</td>
                            <td>
                                @if($exam->type==0)
                                    تستی
                                @else
                                    تشریحی
                                @endif
                            </td>
                            <td>{{$exam->users->f_name}} {{$exam->users->l_name}}</td>
                            <td>{{$exam->examclass[0]->class->classnamber}}</td>
                            <td>{{$exam->time}} دقیقه</td>
                            <td>{{$exam->expire}}</td>
                            <td>{{ $exam->created_at->toDateString() }}</td>
                            <td><a href="/admin/exam/doros/{{$exam->id}}">
                                    <button class="btn btn-info">دروس</button>
                                </a></td>
                            <td><a href="/admin/exam/general/edit/{{$exam->id}}">
                                    <button class="btn btn-success">ویرایش</button>
                                </a></td>
                            <td>
                                <a href="/teacher/exam/student/{{$exam->examclass[0]->class->classnamber}}/{{$exam->id}}">
                                    <button class="btn btn-primary">کلیک کنید</button>
                                </a></td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteData({{$exam->id}})"><i
                                        class="icon-trash"></i></button>
                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            {{ $exams->links() }}

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
                        url: "{{  url('/admin/exam/delete/')  }}" + '/' + id,
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
