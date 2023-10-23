@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <style type="text/css">
        @media print {
            #printbtn {
                display: none;
            }
        }
    </style>
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
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
            <h3>
                ثبت جریمه تاخیر
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">کتابخانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ثبت جریمه تاخیر</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <form method="post" action="/admin/library/fines/changestatus">
                    @csrf
                    @include('errors')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-form-label">نام
                                کتاب:</label>
                            <input type="text" class="form-control"
                                   value="{{$fine->Library->name}}" disabled>
                        </div>
                        <div class="col-md-6">

                            <label for="recipient-name" class="col-form-label">شماره
                                کتاب:</label>
                            <input type="text" class="form-control"
                                   value="{{$fine->Library->issue}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                نام:</label>
                            <input type="text" class="form-control"
                                   value="{{$fine->user->f_name}}" disabled>

                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                نام خانوادگی:</label>
                            <input type="text" class="form-control"
                                   value="{{$fine->user->l_name}}" disabled>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                تعداد روز تاخیر:</label>
                            <input type="text" class="form-control"
                                   value="{{$fine->day}}" disabled>

                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                مبلغ جریمه:</label>
                            <input type="text" class="form-control"
                                   value="{{$fine->day*1000}}" disabled>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="recipient-name" class="col-form-label">
                                وضعیت:</label>
                            <select id="status" name="status" class="form-control">
                                <option @if($fine->status=='پرداخت نشده') selected @endif>پرداخت نشده</option>
                                <option @if($fine->status=='پرداخت شده') selected @endif>پرداخت شده</option>
                                <option @if($fine->status=='بخشیده شده') selected @endif>بخشیده شده</option>
                            </select>

                        </div>
                        <div class="col-md-6">

                            <input type="text" class="form-control" name="id"
                                   value="{{$fine->id}}" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <br>
                            <button id="printbtn" type="submit" class="btn btn-primary btn-block"> تغییر وضعیت</button>
                        </div>
                    </div>
                </form>
                <div class="form-group row">
                    <div class="col-md-3">

                        <a href="/admin/library/intrust">
                            <button id="printbtn" type="submit" class="btn btn-danger btn-block">انصراف</button>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            <br>
            <div style="text-align: center">
                <h6>فاکتور های تولید شده قبلی برای این کتاب و این گیرنده</h6>

            </div>
            <table id="example2" class="table  table-striped table-bordered ">
                <thead>
                <tr style="text-align: center">
                    <th>شمارنده</th>
                    <th>شماره کتاب</th>
                    <th>عنوان</th>
                    <th>گیرنده</th>
                    <th>روز تاخیر</th>
                    <th>تاریخ ایجاد فاکتور</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                <?php $idn = 1; ?>

                @foreach($otherfine as $row)
                    <tr class="form-group" STYLE="text-align: center">
                        <td style="text-align: center">{{$idn}}</td>

                        <td>{{$row->library->issue}}</td>
                        <td>{{$row->library->name}}</td>
                        <td>{{$row->user->f_name}}-{{$row->user->l_name}}</td>
                        <td>{{$row->day}}روز</td>
                        <td>{{$row->created_at->ToDateString()}} </td>
                        <td class="text-center">
                            {{$row->status}}
                        </td>
                    </tr>
                    <?php $idn = $idn + 1 ?>
                @endforeach

                </tbody>

            </table>
            <br>

            <div class="form-group">
                <div class="col-md-offset-right-10">
                    <button type="submit" id="printbtn" class="btn btn-danger btn-block" onclick="myFunction()"> پرینت
                    </button>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <div class="p-2"> تاریخ و امضا</div>

            </div>
        </div>
        <script src="/js/sweetalert.min.js"></script>
        @include('sweet::alert')
        @endsection('content')
        <script>
            function myFunction() {
                window.print();


            }

        </script>