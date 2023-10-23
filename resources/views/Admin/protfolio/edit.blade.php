@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <div>
            <h3>

                ویرایش نمونه کار روی سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">نمونه کار</li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش</li>
                </ol>
            </nav>
        </div>

    </div>

    <!-- end::page header -->


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <h5 class="card-title">ویرایش</h5>
                        </div>
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-1" style="text-align: left">
                            <a href="/admin/Portfolio/singlepage/{{$row->id}}">
                                <button class="btn btn-dark">برگشت</button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <form method="POST" action="/admin/Portfolio/update/{{$row->id}}" enctype="multipart/form-data">
                        @csrf
                        @include('errors')
                        <input type="hidden" name="_token" value="Ob0fvhdxKQn0bhx5aIC0trdn57bYX9vsIlD4PMsv">
                        <div class="form-group">
                            <input class="form-control" id="place"
                                   name="place" value="نمونه کارها">
                        </div>
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" id="subject"
                                   name="subject" value="{{$row->title}}" required>
                        </div>

                        <br>
                        <div class="form-group">
                            <label>توضیحات کوتاه</label>
                            <input type="text" class="form-control" id="littlebody"
                                   name="littlebody" placeholder="توضیحات کوتاه را وارد کنید" required>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3">{!! $row->body !!}</textarea>
                            </div>
                        </div>
                        <br>
                        <h3>انتخاب عکس</h3>
                        <div class="row">

                            @foreach(\App\HomeImage::where('matlab_id',$row->id)->get() as $image)
                                <div class="custom-control custom-checkbox col-md-3">
                                    <img src="{{url('images/'.$image->resize_image)}}"
                                         class="img-fluid" alt="..." width="150"
                                         height="150">
                                    <input id="info" class="badgebox" type="checkbox" value="{{$image->id}}"
                                           name="image-{{$image->id}}" checked>

                                </div>
                                <br>

                            @endforeach
                        </div>
                        <br>
                        <div class="form-group">
                            <label><b> انتخاب عکس جدید</b><br>برای انتخاب چند عکس کافیست کلید ctrl کیبورد را نگه
                                دارید</label>
                            <br>
                            <input type="file" class="form-control" id="patchfile" name="patchfile[]" multiple>
                        </div>


                        <br>

                        <br>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><b>دسته بندی مخصوص نمونه کار ها</b><br></label>
                                <br>
                                <select name="tag" id="tag" class="form-control"
                                >
                                    <option selected>{{\App\PortfolioDetail::where('home_id',$row->id)->first()['tag']}}</option>

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
                                    <option selected>{{\App\PortfolioDetail::where('home_id',$row->id)->first()['status']}}</option>
                                    <option>شروع نشده</option>
                                    <option>طراحی شده</option>
                                    <option>در حال اجرا</option>
                                    <option>تحویل داده شده</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label><b>تاریخ شروع</b><br></label>
                                <input id="date1" type="text" name="date-picker-shamsi" class="form-control text-right"
                                       dir="ltr" value="{{\App\PortfolioDetail::where('home_id',$row->id)->first()['date']}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>مشتری</b><br></label>
                                <input type="text" id="Customer" name="Customer" class="form-control"
                                      value="{{\App\PortfolioDetail::where('home_id',$row->id)->first()['Customer']}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>

            <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('content')

