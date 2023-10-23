@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <div>
            <h3>ارسال مطلب</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مطلب ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ارسال مطلب</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form action="/admin/uploadquestion.store" method="post" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('Admin.errors')
                @method('put')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">آپلود
                        نمونه سوال</h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class=" col-md-6">
                        <br>
                        <label>پایه </label>

                        <select id="paye" name="paye"
                                class="form-control">

                            @foreach($paye as $p)
                                <option style="text-align: right" value="{{$p->name}}"> پایه {{$p->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-md-6">
                        <br>
                        <label>درس </label>
                        <select id="dars" name="dars"
                                class="form-control">

                            @foreach($darses as $dars)
                                <option style="text-align: right" value="{{$dars->name}}"> درس {{$dars->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-md-6">
                        <br>
                        <label>فصل </label>
                        <input type="number" name="chapter" id="chapter" class="form-control text-right"
                               dir="ltr" value="{{old('chapter')}}" placeholder="لطفا شماره فصل را وارد نمایید"
                               required>
                    </div>

                    <div class="form-group , col-md-6">
                        <br>

                        <label>مبلغ پیشنهادی </label>
                        <br>
                        <input type="text" id="price" name="price"
                               class="form-control" value="رایگان" placeholder="رایگان" readonly>
                    </div>
                </div>
                <div class="form-group , col-md-10">
                    <br>
                    <br>
                    <h4 style="color: darkred">آیا مطلب توسط خود دبیر تهیه گردیده است؟ </h4>
                    <input type="radio" id="auther" name="auther"
                           class="checkbox" value="1">
                    <span class="ui-radio-check">بله مطلب را خودم تهیه کردم.</span>
                    <br>
                    <input type="radio" id="auther" name="auther"
                           class="checkbox" value="0" checked>
                    <span class="ui-radio-check">خیر، ولی از سایت معتبر یا دبیر  تایید شده بنده تهیه شده است.</span>

                </div>
                <div class="form-group col-md-10 responsive">
                    <br>
                    <label>توضیحات (درصورت نیاز) </label>
                    <br>
                    <textarea id="editor-demo1" name="description"
                    >{{old('description')}}</textarea>
                </div>

                <div class="form-group , col-md-10">
                    <br>
                    <label>آپلود فایل </label>
                    <input type="file" id="file" name="file" class="form-control" value="{{old('file')}}"
                    >
                </div>
                <div class="form-group , col-md-12">
                    <br>
                    <button class="btn btn-info" type="submit">ارسال مطلب
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script type="text/javascript">
        $(".chosen").chosen();
    </script>
@endsection('content')


