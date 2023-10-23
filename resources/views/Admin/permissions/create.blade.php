@extends('layouts.admin')

@section('script')

@stop

@section('css')

@stop
@section('header')
    <div class="page-header">
        <div>
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اولیا</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3" style="text-align: right">
                    <div class="panel-heading">
                        <h5 class="panel-title">ایجاد مجوز جدید</h5>

                    </div>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3" style="text-align: left">
                    <a href="{{ url('admin/permissions') }}" class="btn bg-blue btn-xs btn-icon">بازگشت به
                        مدیریت مجوز ها<i class="icon-backward"></i></a>
                </div>
            </div>
            <div class="row">

            <form method="POST" action="/admin/permissions">

                    {{csrf_field()}}
                    <div class="col-md-12">
                        <div class="panel panel-flat">

                            <div class="panel-body">
                                <div class="form-group">
                                    <label>نام لاتین مجوز</label>
                                    <input type="text" name="name" class="form-control" placeholder="مثال: manege-user">
                                </div>

                                <div class="form-group">
                                    <label>عنوان مجوز</label>
                                    <input type="text" name="label" class="form-control"
                                           placeholder="مثال: مدیریت کاربران">
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">ثبت مجوز
                                    </button>
                                </div>
                            </div>

                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

