@extends('layouts.teacher')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/js/form_multiselect.js"></script>


    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>حضورغیاب</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست {{config('global.students')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">حضورغیاب</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body" style="padding-right: -10px">
            <a href="/teacher/students/rollcall/absentlist/all/{{$id}}">
                <button class="btn btn-warning">لیست غایبین در طول سال</button>
            </a>
            <a rel="nofollow" href="/teacher/students/rollcall/done/{{$id}}">
                <button class="btn btn-primary">حضورغیاب انجام شد.</button>
            </a>
            <div style="text-align: right">
                <br>
                <b> لطفا نام و یا نام خانوادگی {{config('global.student')}} را سرچ کنید...</b></div>
            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>وضعیت</th>
                        <th>لیست حضور غیاب سالانه</th>
                        <th>ثبت غیبت در روز دیگر</th>


                    </tr>
                    </thead>
                    @include('Admin.errors')
                    @foreach($data as $user )
                        <tr style="text-align: center">
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->resizeimage))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->resizeimage)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>
                                </div>
                            </td>
                            <td>{{$user->f_name}}</td>
                            <td>{{$user->l_name}}</td>
                            <td>
                                {{--@dd($user->rollcall[0]->created_at,Carbon\Carbon::now()->toDateString())--}}
                                @if(
    isset($user->rollcalltime[0]))

                                    <a target="_blank" rel="nofollow"
                                       href="/teacher/students/rollcall/absenttopresent/{{$user->rollcalltime[0]->id}}">
                                        <span style="color:red">غایب</span>
                                    </a>

                                @else
                                    <a target="_blank" rel="nofollow"
                                       href="/teacher/students/rollcall/presenttoabsent/{{$user->id}}">
                                        <span style="color: #0d8d2d">حاضر</span>
                                    </a>

                                @endif
                            </td>
                            <td>

                                @if(\App\RollCall::where('user_id', $user->id)->where('author', auth()->user()->id)->first())
                                    <a href="/teacher/student/rollcall/absentlist/{{$user->id}}">
                                        <button class="btn btn-info">کلیک کنید</button>
                                    </a>
                                @else
                                    بدون غیبت
                                @endif
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal{{$user->id}}">
                                    ثبت
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">انتخاب تاریخ و
                                                    ساعت</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/teacher/absent/store/{{$user->id}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label> تاریخ</label>
                                                            <input style="text-align: center" type="text"
                                                                   name="date-picker-shamsi-list"
                                                                   class="form-control text-right"
                                                                   readonly='true'
                                                                   dir="ltr" value="{{old('date1')}}" required
                                                                   autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label> ساعت</label>
                                                            <div class="input-group clockpicker-autoclose-demo">
                                                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-clock-o"></i>
                            </span>
                                                                </div>
                                                                <input style="text-align: center" name="time"
                                                                       type="text" class="form-control" required
                                                                       readonly='true'
                                                                       value="00:00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">بستن
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">ثبت و ذخیره
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>

                        @endforeach

                        </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection('content')
