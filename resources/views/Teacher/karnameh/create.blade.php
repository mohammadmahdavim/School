@extends('layouts.teacher')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
@endsection('css')
@section('script')

    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        submitformDatekarnameh = function () {
            var data = $('#datek').serialize();
            $.ajaxSetup({

                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#karnamehrender').html('');

            $.ajax({
                url: '{{url('/teacher/karnameh/render')}}',
                type: 'post',
                data: data,
                success: function (data) {
                    $('#karnamehrender').html(data);

                }
            })

        }
    </script>

@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3> تولید کارنامه {{$namekarname}}
                درس
                {{\App\dars::where('id',$idd)->first()['name'] }}
            </h3>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تولید کارنامه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$namekarname}} درس
                        {{\App\dars::where('id',$idd)->first()['name'] }}
                    </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="datek">
                @csrf
                <label> انتخاب تاریخ برای مشاهده آیتم ها</label>
                <input name="idkarnameh" value="{{$idk}}" type="hidden">
                <input name="iddars" value="{{$idd}}" type="hidden">
                <input name="clasid" value="{{$idc}}" type="hidden">
                <div class="row text-center justify-content-md-center">
                    <div class="col-md-5 m-t-b-20">
                        <input type="text" id="date-picker-shamsi" name="dateaval" class="form-control text-right date-picker-shamsi"
                               dir="ltr"
                               placeholder="... از تاریخ">
                    </div>
                    <div class="col-md-5 m-t-b-20">
                        <input type="text"  name="date-picker-shamsi-list" id="date-picker-shamsi-list" class="form-control text-right" dir="ltr"
                               placeholder=" ... تا تاریخ">
                    </div>
                    <div class="col-md-2 m-t-b-20">
                        <a onclick="submitformDatekarnameh()" class="btn btn-danger">اعمال تاریخ</a>
                    </div>
                </div>
            </form>
            <form action="{{url('teacher/karnameh/create') }}" method="post">

                <input class="form-control" type="hidden"
                       name="idkarnameh" id="idkarnameh" value="{{$idk}}">
                <input class="form-control" type="hidden"
                       name="idclass" id="idclass" value="{{$idc}}">

                <input class="form-control" type="hidden"
                       name="iddars" id="iddars" value="{{$idd}}">
                {{csrf_field()}}
                @include('Admin.errors')
                <br>
                <p>دبیر گرامی لطفا میزان تاثیر هر آیتم را از<b style="font-size: larger;color: #0a6aa1"> 100</b> مشخص
                    نمایید.</p>
                <div class="row text-center justify-content-md-right" id="karnamehrender">
                    @foreach($items as $item)
                        <div class="col-md-2 m-t-b-20">
                            <h5>{{$item->name}}</h5>
                        </div>
                        <div class="col-md-9 m-t-b-20" style="text-align: right">
                            <input name="percent-{{$item->id}}" id="percent-{{$item->id}}" style="text-align: center"
                                   class="form-control col-md-3"
                                   required>
                        </div>

                    @endforeach
                </div>
                <div class="form-group ">


                    <button class="btn btn-info" type="submit">ذخیره و ارسال درصد ها
                    </button>

                </div>

            </form>
            <script src="/js/sweetalert.min.js"></script>
            @include('sweet::alert')
        </div>
    </div>

@endsection('content')

