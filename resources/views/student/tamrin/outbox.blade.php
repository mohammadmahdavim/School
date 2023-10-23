@extends('layouts.student')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->

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
            <h3>تکالیف ارسال کرده</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تکالیف</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تکالیف ارسال کرده</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                <tr class="success" style="text-align: center">
                    <th>درس</th>
                    <th>نام {{config('global.teacher')}}</th>
                    <th>عنوان تکلیف</th>
                    <th>درجه سختی سوال از نظر من</th>
                    <th>تاریخ آخرین ارسال</th>
                    <th> فایل ارسالی</th>
                    <th> نمره</th>
                    <th>توضیحات من</th>

                </tr>
                </thead>
                <tbody>
                <tr style="text-align: center">
                    @foreach($jtamrins as $tamri)

                        <td style="text-align: center">
                            <p
                            >{{\App\Tamrin::where('id', $tamri->tamrin_id)->first()['dars']}}</p>
                        </td>
                        <td style="text-align: center">
                            <p> {{\App\User::where('id',$tamri->teacher_id)->first()['f_name']}}
                                - {{\App\User::where('id',$tamri->teacher_id)->first()['l_name']}}
                            </p>
                        </td>
                        <td style="text-align: center">
                            <p>{{\App\Tamrin::where('id', $tamri->tamrin_id)->first()['title']}}
                            </p>
                        </td>
                        <td style="text-align: center">
                            <p style="text-align: center">{{$tamri->daraje}}</p>
                        </td>
                        <td>{{ $tamri->created_at->toDateString() }}</td>

                        <?php
                        $files = \Illuminate\Support\Facades\DB::table('jtamrin_files')->where('jtamrin_id', $tamri->id)->get();
                        ?>
                        <td style="text-align: center">
                            @foreach($files as $file)
                                <div class="row">
                                    <div class="col-6">


                                        @if( $file->mime=='image/jpeg' or
                                               $file->mime=='image/png' or
                                               $file->mime=='image/bmp'  )

                                            <a target="_blank" href="/images/{{$file->filename}}">

                                                <img height="50" width="110" class="image"
                                                     src="{{url('/images/'.$file->filename)}}">

                                            </a>
                                            <br>
                                        @else
                                            <a href="{{ route('jtamrin.download', $file->id) }}"
                                               class="btn btn-outline-warning"> <i
                                                    class="icon-download"></i> {{$file->original_filename}}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-6">

                                        <button class="btn btn-danger btn-sm btn-rounded"
                                                onclick="deleteData({{$file->id}})"><i
                                                class="ti-trash"></i></button>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </td>
                        @if(config('global.type_mark')==1)

                            <td>{!! $tamri->mark !!}</td>
                        @else
                            <td style="color: black">
                                {{--{{getavg($idk,$mykarnameh->dars_id)}}--}}
                                @if ($tamri->mark >3)
                                    خیلی خوب

                                @elseif (($tamri->mark <= 3) && ($tamri->mark > 2))

                                    خوب
                                @elseif (($tamri->mark <= 2) && ($tamri->mark > 1))
                                    قابل قبول
                                @elseif (($tamri->mark <= 1) && ($tamri->mark > 0))
                                    نیاز به تلاش مجدد
                                @else
                                    {{$tamri->mark}}
                                @endif

                                {{--{{getavg($idk,$mykarnameh->dars_id)}}--}}
                            </td>
                        @endif

                        <td>{!! $tamri->description !!}</td>

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
                        url: "{{  url('/student/jtamrin/delete')  }}" + '/' + id,
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

