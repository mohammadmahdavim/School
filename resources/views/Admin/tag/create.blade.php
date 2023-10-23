@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ایجاد تگ جدید
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">تگ ها</li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ایجاد</h5>
                    <h4> <span style="color: #bd2130">خواهشا تگ های یک کلمه ای ایجاد نمایید.</span></h4>
                    <br>
                    <form method="POST" action="/admin/Tag/store" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <input type="hidden" name="place" id="place" value="عمومی">
                        <h6> <span style="color: black">تگ های عمومی</span></h6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name"
                                   name="name" placeholder="تگ را وارد کنید" >
                        </div>

                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>

                </div>
            </div>


@endsection('content')

