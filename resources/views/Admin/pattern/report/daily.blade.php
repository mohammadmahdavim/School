@extends('layouts.admin')
@section('css')
    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <!-- end::datepicker -->

@endsection('css')
@section('script')
    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->

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
            <form action="/admin/pattern/report/daily" method="post">
                {{csrf_field()}}
                <label> انتخاب تاریخ</label>

                <div class="row ">
                    <div class="col-md-3 ">
                        <input style="text-align: center" type="text" name="date_from" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{$date_from}}" required autocomplete="off">
                    </div>

                    <div class="col-md-3 ">

                        <input style="text-align: center" type="text" name="date_to" id="date-picker-shamsi-new"
                               class="form-control text-right"
                               dir="ltr" value="{{$date_to}}" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2 m-t-b-20">
                    <button class="btn btn-success">اعمال تاریخ</button>
                </div>

        </form>

    </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table  table-bordered table-striped mb-0 table-fixed" id="myTable">
                <thead>
                <tr class="success" style="text-align: center">
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th>نام</th>
                    <th>مطالعه</th>
{{--                    <th>مقایسه با الگو</th>--}}
                    <th>جزییات</th>

                </tr>
                </thead>

                <tbody>
                <?php
                $number = 0;
                ?>
                @foreach($answers as $key=>$answer)
                    <?php
                    $user = \App\User::where('id', $key)->first();
                    $number += 1;
                    ?>
                    <tr style="text-align: center">
                        <td>{{$number}}</td>
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
                        <td>{{$user->f_name}}-{{$user->l_name}}</td>
                        <td>
                            {{$answer->sum('time')}}
                        </td>
{{--                        <td></td>--}}
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalLong{{$user->id}}">
                                مشاهده
                            </button>
                            <div class="modal fade" id="exampleModalLong{{$user->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">  {{$user->f_name}}
                                                -{{$user->l_name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">درس</th>
                                                    <th scope="col">زمان</th>
                                                    <th scope="col">وضعیت</th>
                                                    <th scope="col">توضیحات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($answer as $a)
                                                    <tr>
                                                        <th scope="row">{{$a->dars->name}}</th>
                                                        <td>{{$a->time}}</td>
                                                        <td>{{$a->statuss->name}}</td>
                                                        <td>{{$a->description}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                                            </button>

                                        </div>
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
@endsection('content')


