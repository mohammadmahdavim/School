@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>غایبین امروز</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست {{config('global.students')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">غایبین امروز</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body" style="padding-right: -10px">

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <br>
                    <tr style="text-align: center">
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>کلاس</th>
                        <th>تاریخ</th>
                        <th>جزییات</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @include('Admin.errors')
                    @foreach($data as $user )
                        <tr style="text-align: center">
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->user->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->user->filename)}}"
                                                 alt="...">
                                        @else
                                            <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                 alt="...">
                                        @endisset
                                    </figure>
                                </div>
                            </td>
                            <td>{{$user->user->f_name}}</td>
                            <td>{{$user->user->l_name}}</td>
                            <td>{{$user->class_id}}</td>
                            <td>{{$user->updated_at->toDateString()}}</td>
                            <td>
                                <a class="btn btn-info" data-toggle="collapse" href="#collapseExample{{$user->id}}"
                                   role="button" aria-expanded="false" aria-controls="collapseExample">
                                    جزییات
                                </a>

                            </td>
                        </tr>
                        <tr class="collapse" id="collapseExample{{$user->id}}" style="text-align: right">
                            <td colspan="4" style="text-align: right">
                                <?php
                                $i = 1;
                                ?>
                                @foreach($details->where('user_id',$user->user_id) as $detail)
                                    {{$i}}. &nbsp;
                                        دبیر:
                                    <span class="btn btn-sm btn-success">
                                    {{$detail->teacher ? $detail->teacher->f_name : ''}}
                                    {{$detail->teacher ? $detail->teacher->l_name : ''}}
                                        </span>
                                    &nbsp;
                                        ساعت:
                                    <span class="btn btn-sm btn-info">
                                    {{$detail->created_at->toTimeString()}}
                                                                      </span>
                                        @if($detail->ok==1)
                                            <a href="/admin/student/rollcall/ok/{{$detail->id}}">
                                                <span style="color:red">موجه</span>
                                            </a>
                                        @else
                                            <a href="/admin/student/rollcall/ok/{{$detail->id}}">
                                                <span style="color: #0d8d2d">غیر موجه</span>
                                            </a>

                                        @endif
                                    <br>
                                    <br>
                                        <?php
                                        $i = $i+1;
                                        ?>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>




@endsection('content')
