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

            <input id="myInput" type="text" placeholder="نام دانش آموز را وارد کنید" class="form-control col-md-4">
            <br>
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
                            <td style="background-color: #b91d19;color: black">{{(100-($user->sum))/5}}</td>
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

