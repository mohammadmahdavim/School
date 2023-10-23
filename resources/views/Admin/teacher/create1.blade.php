@extends('layouts.admin')
@section('css')
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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد {{config('global.teacher')}}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection('header')

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="panel panel-flat">
                <div class="panel-body">
                    <div style="text-align: center">
                        <h3> ایجاد {{config('global.teacher')}} جدید </h3>
                    </div>
                    <div style="text-align: left;padding-left: 10px">
                        <a href="/admin/teacher">
                            <button class="btn btn-rounded btn-outline-dark">صفحه
                                اطلاعات {{config('global.teachers')}}</button>
                        </a>
                    </div>
                    <form action="/admin/teacher.store" method="POST">
                        {{csrf_field()}}
                        @include('Admin.errors')
                        <input name="type" value="1" hidden>
                        <div class="col-md-6">
                            <div class="center-text">
                                <h6><label>نام</label></h6>
                                <input type="text" id="f_name" class="form-control" name="f_name"
                                       value="{{old('f_name')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="center-text">
                                <br>
                                <h6><label>نام خانوادگی</label></h6>

                                <input type="text" id="l_name" class="form-control" name="l_name"
                                       value="{{old('l_name')}}">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="center-text">
                                <br>
                                <h6><label>کد ملی</label></h6>
                                <input type="text" id="codemeli" class="form-control" name="codemeli"
                                       value="{{old('codemeli')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="center-text">
                                <br>
                                <h6><label>شماره تماس</label></h6>
                                <input type="text" id="phone" class="form-control" name="phone"
                                       value="{{old('phone')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="center-text">
                                <br>
                                <h6><label>ایمیل</label></h6>
                                <input type="text" id="email" class="form-control" name="email"
                                       value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="center-text">
                                <br>
                                <h6><label>رمز</label></h6>
                                <input type="password" id="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <br>
                            <h6><label>کلاس {{config('global.teacher')}}</label></h6>
                            <select name="class" class="form-control" style="text-align: right"
                                    id="class-dropdown"
                                    onchange="classChange(this.value)">
                                @foreach($claas as $cls)
                                    <option style="text-align: right" value="{{$cls->classnamber}}">
                                        پایه {{$cls->paye}}
                                        / کلاس {{$cls->classnamber}} /{{$cls->description}}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <br>
                            <h6><label>درس {{config('global.teacher')}}</label></h6>
                            <select name="dars[]" multiple class="js-example-basic-single" style="text-align: right"
                                    id="dars-dropdown"
                            >
                                <option></option>


                            </select>
                        </div>
                        <br>
                        <div size="400px">
                            <div class="col-md-4 , form-group">
                                <div class="center-text">
                                    <input class="browser-default custom-select" id="role" name="role" value="معلم"
                                           type="hidden">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-left">
                                <div class="form-group , col-md-12">

                                    <br>
                                    <button class="btn btn-info btn-block" type="submit">ذخیره و ارسال
                                    </button>

                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')


@endsection('content')
<script>

    function classChange(value) {

        var class_id = value;

        $.ajax({
            url: "{{url('admin/get-dars-by-class')}}",
            type: "POST",
            data: {
                class_id: class_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#dars-dropdown').html('<option value="">Select dars</option>');

                $.each(result.dars, function (key, value) {
                    $("#dars-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }

</script>
</script>


