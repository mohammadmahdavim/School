@php($user=auth()->user()->role)
@extends($user=='معلم' ?  'layouts.teacher': 'layouts.admin')@section('css')

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
            <h3>آزمون های شما </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">آزمون های شما</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <br>
            <div class="row">
                <div class="col-md-10">
                    <label>وضعیت آزمون</label>
                    &nbsp;
                    &nbsp;
                    &nbsp;@if(count($marks)>0)
                        <input style="text-align: center" type="checkbox" class="form-check-input"
                               id="materialUnchecked"
                               {{ $marks[0]->exam->status ? 'checked' : '' }} onclick="toggless('{{$marks[0]->exam->id}}',this) ">
                    @endif

                </div>
                @if(count($marks)>0)
                    <div class="col-md-2" style="text-align: center">
                        <a href="/teacher/exam/karname/{{$marks[0]->exam->id}}">
                            <button class="btn btn-info">جزییات</button>
                        </a>
                    </div>
                @endif
            </div>


            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>کلاس</th>
                        <th>نمره</th>
                        <th>مشاهده جزییات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($marks as $mark)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$mark->user->f_name}}</td>
                            <td>{{$mark->user->l_name}}</td>
                            <td>
                                {{$mark->user->student_class->classnamber}}</td>
                            <td>

                                @if(config('global.type_mark')==1)

                                    {{round($mark->mark,2)}}
                                @else
                                    @if ($mark->mark >3)
                                        خیلی خوب

                                    @elseif (($mark->mark <= 3) && ($mark->mark > 2))

                                        خوب
                                    @elseif (($mark->mark <= 2) && ($mark->mark > 1))
                                        قابل قبول
                                    @elseif (($mark->mark <= 1) && ($mark->mark > 0))
                                        نیاز به تلاش مجدد
                                    @endif
                                @endif
                            </td>
                            <td><a href="/teacher/exam/student/single/{{$mark->user->id}}/{{$mark->exam_id}}">
                                    <button class="btn btn-primary">کلیک کنید</button>
                                </a></td>

                        </tr>
                        <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('content')

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
            url: '{{url('/teacher/exam/changeStatus')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "نمایش پاسخ آزمون برای {{config('global.students')}} فعال شد",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "نمایش پاسخ آزمون برای {{config('global.students')}} غیر فعال شد",
                        icon: "success",

                    });
                }
            }
        })


    }
</script>
