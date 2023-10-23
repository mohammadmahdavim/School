@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد مورد انظباطی</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">ایجاد مورد انظباطی</a></li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
<a href="/admin/cdiscipline/manage"><button class="btn btn-outline-danger">مدیریت موارد ایجاد شده</button></a>
        <form method="POST" action="/admin/cdiscipline/store">

            {{csrf_field()}}
            @include('Admin.errors')

            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading" style="text-align: center">
                        <h5 class="panel-title">ایجاد مورد انضباطی جدید</h5>
                    </div>


                        <div class="row">
                        <div class="form-group col-md-6">
                            <br>
                            <label>نام </label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="مثال:ریختن زباله در حیاط مدرسه">
                        </div>
                        <div class="form-group col-md-6">
                            <br>
                            <label>مقدار کسر نمره از 20 </label>
                            <input type="number"   name="mark" id="mark" step="0.01" class="form-control">
                        </div>
                        </div>
                        <div class="form-group col-md-12" style="text-align: center">
                            <label>توضیحات</label>
                            <input type="text" name="description" class="form-control" >
                        </div>


                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button class="btn btn-primary btn-block">ثبت</button>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>




@endsection('content')
