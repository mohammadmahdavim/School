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

            <form action="/admin/discipline/all">
                <div class="row">
                    <div class="col-md-3">
                        <label>دانش آموز</label>

                        <select name="user_id" class="js-example-basic-single">
                            <option></option>
                            @foreach($users as $user)
                                <option @if($user->id==request()->user_id) selected
                                        @endif value="{{$user->id}}">{{$user->f_name}} {{$user->l_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <button class="btn btn-info" type="submit">جستجو</button>
                    </div>
                </div>
            </form>            <br>
            <div class="table-responsive">
                <table class="table  table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>عکس</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نمره انضباط</th>
                        <th>مشاهده جزيیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $user )

                        <tr style="text-align: center">
                            <td>

                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->user->resizeimage))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->user->resizeimage)}}"
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
                            <td style="background-color: #b91d19;color: black">{{(20-($user->sum))}}</td>
                            <td style="text-align: center"><a href="/admin/discipline/single/{{$user->user_id}}">
                                    <button class="btn btn-outline-dark">کلیک کنید</button>
                                </a></td>
                        </tr>
                    @endforeach
                    @foreach($other as $user )

                        <tr style="text-align: center">
                            <td>
                                <div class="gallery">
                                    <figure class="avatar avatar-sm avatar-state-success">
                                        @if(!empty($user->filename))
                                            <img class="rounded-circle"
                                                 src="{{url('uploads/'.$user->filename)}}"
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
                            <td style="background-color: #0d8d2d;color: black">20</td>
                            <td style="text-align: center">
                                جزییات ندارد
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
            </div>
        </div>



@endsection('content')

