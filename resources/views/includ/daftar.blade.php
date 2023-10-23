@extends('layouts.teacher')
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
            <form action="/teacher/daftar/select" method="post">
                {{csrf_field()}}
                <input name="class" value="{{$class}}" hidden>
                <input name="dars" value="{{$dars}}" hidden>
                <label> انتخاب روز برای مشاهده دفتر کلاسی</label>

                <div class="row text-center justify-content-md-center">
                    <div class="col-md-3 m-t-b-20">
                        <input style="text-align: center" type="text" name="date" id="date-picker-shamsi"
                               class="form-control text-right"
                               dir="ltr" value="{{$date}}" required autocomplete="off"></div>
                    <div class="col-md-2 m-t-b-20">
                        <button class="btn btn-success">اعمال روز</button>
                    </div>
                </div>
            </form>
            <span>کلاس {{$class}}
                -
                درس
            {{\App\dars::where('id',$dars)->pluck('name')->first()}}
            </span>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <td>شمارنده</td>
                        <td>تصویر</td>
                        <td>نام {{config('global.student')}}</td>
                        <td>حضور غیاب</td>
                        <td>تمرین</td>
                        <td>پرسش</td>
                        <td>مشارکت</td>
                    </tr>
                    </thead>
                    <tbody>

                    <form action="{{url('teacher/daftar/mark')  }}" method="post">

                        {{csrf_field()}}
                        @include('Admin.errors')
                        <input class="form-control" type="hidden"
                               name="date" id="date" value="{{$date}}">
                        <input class="form-control" type="hidden"
                               name="idclass" id="idclass" value="{{$class}}">

                        <input class="form-control" type="hidden" style="text-align: center"
                               name="iddars" id="iddars" value="{{$dars}}" readonly>
                        <?php
                        $id = 1;
                        ?>
                        @foreach($users as $user)

                            <tr style="text-align: center">
                                <td style="text-align: center">{{$id}}</td>
                                <?php
                                $id = $id + 1;
                                ?>
                                <td>


                                    <div class="gallery">
                                        <figure class="avatar avatar-sm avatar-state-success">
                                            @if(!empty($user->filename))
                                                <img class="rounded-circle"
                                                     src="{{url('uploads/'.auth()->user()->filename)}}"
                                                     alt="...">
                                            @else
                                                <img class="rounded-circle" src="/assets/profile/avatar.png"
                                                     alt="...">
                                            @endisset
                                        </figure>

                                    </div>
                                </td>

                                <td>
                                    <li id="user_id" style="list-style-type:none;color:blue"
                                        class="form-group w-40"
                                        value="{{$user->id}}">{{$user->f_name}}<br>{{$user->l_name}}</li>
                                </td>
                                <td>
                                    @if(isset($user->rollcall[0]))
                                        <span style="color:red">غایب</span>

                                    @else
                                        <span style="color: #0d8d2d">حاضر</span>

                                    @endif
                                </td>
                                <td>@foreach($user->studentjtamrin as $studentjtamrin)
                                        {{$studentjtamrin->mark}}
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    <select class="form-group form-control" name="porsesh[{{$user->id}}]"
                                            id="porsesh-{{$user->id}}">
                                        @if(!empty($user->daftar[0]->porsesh))
                                            <option selected>{{$user->daftar[0]->porsesh}}</option>
                                        @endif
                                        <option value="">انتخاب کنید</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-group form-control" name="mosharecat[{{$user->id}}]"
                                            id="mosharekat-{{$user->id}}">
                                        @if(!empty($user->daftar[0]->mosharecat))
                                            <option selected>{{$user->daftar[0]->mosharecat}}</option>
                                        @endif
                                        <option value="">انتخاب کنید</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </td>
                                <?php
                                $id = $id + 1;
                                ?>
                                @endforeach
                            </tr>
                            <div style="text-align: left">


                                <button class="btn btn-info" type="submit">ذخیره و ارسال نمرات
                                </button>

                            </div>
                            <br>


                            <script src="/js/sweetalert.min.js"></script>

                    @include('sweet::alert')
                    </tbody>

                </table>
            </div>
            <br>
            <div class="left" style="text-align: left">
                <button class="btn btn-info" type="submit">ذخیره و ارسال نمرات
                </button>
                </form>
            </div>

        </div>
    </div>
@endsection('content')

