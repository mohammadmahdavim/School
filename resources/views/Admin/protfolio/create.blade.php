@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ایجاد نمونه کار جدید روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">نمونه کار</li>
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
                    <form method="POST" action="/admin/Portfolio/store" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <input type="hidden" name="_token" value="Ob0fvhdxKQn0bhx5aIC0trdn57bYX9vsIlD4PMsv">
                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="نمونه کارها">
                        </div>
                        <div class="form-group">
                            <label>نام پروژه</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" placeholder="پروژه را وارد کنید" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label>توضیحات کوتاه</label>
                            <input type="text" class="form-control" id="littlebody"
                                   name="littlebody" placeholder="توضیحات کوتاه را وارد کنید" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label><b>انتخاب عکس</b><br>برای انتخاب چند عکس کافیست کلید ctrl کیبورد را نگه دارید</label>
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile[]" multiple>
                        </div>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">شرح پروژه</h5>
                                <textarea name="body" id="editor-demo3"></textarea>
                            </div>
                        </div>
                        <br>


                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><b>دسته بندی مخصوص نمونه کار ها</b><br></label>
                                <br>
                                <select name="tag" id="tag" class="form-control"
                                >
                                    @foreach(\App\CTags::where('place','عمومی')->get() as $tags)
                                        <option value="{{$tags->name}}">{{$tags->name}}</option>
                                    @endforeach
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label><b>وضعیت</b><br></label>
                                <br>
                                <select name="status" id="status" class="form-control"

                                >
                                    <option>شروع نشده</option>
                                    <option>طراحی شده</option>
                                    <option>در حال اجرا</option>
                                    <option>تحویل داده شده</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label><b>تاریخ شروع</b><br></label>
                                <input id="date1" type="text" name="date-picker-shamsi" class="form-control text-right"
                                       dir="ltr">
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>مشتری</b><br></label>
                                <input type="text" id="Customer" name="Customer" class="form-control"
                                       placeholder="نام مشتری را وارد نمایید.">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

    {{--<script src="/js/sweetalert.min.js"></script>--}}
    {{--@include('sweet::alert')--}}
@endsection('content')

