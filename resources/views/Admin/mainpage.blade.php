@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <div>
            <h3>

                مدیریت صفحه اول سایت
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item">مدیریت صفحه اول سایت</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                             <span style="text-align: center">
                                        <h4>اطلاعات بالایی صفحه اول</h4>
</span>
                    <!-- Header Top Area -->
                    <div class="header-toparea">
                        <div class="container">
                            <form method="post" action="/admin/mainpage/store">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="header-topinfo">
                                            <ul>
                                                <li><i class="fa fa-phone"></i><input name="phone" id="phone"
                                                                                      class="form-control"
                                                                                      placeholder="شماره تلفن را وراد نمایید."
                                                                                      value="{{$rows->phone}}">
                                                </li>
                                                <br>
                                                <li><i class="fa fa-envelope-o"></i><input id="email" name="email"
                                                                                           class="form-control"
                                                                                           placeholder="ایمیل را وارد نمایید"
                                                                                           value="{{$rows->email}}">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="header-topinfo text-right">
                                            <ul>
                                                <li><i class="fa fa-clock-o"> </i><input class="form-control" id="day"
                                                                                         name="day"
                                                                                         placeholder="روزهای کاری-مثال:شنبه تا پنجشنبه"
                                                                                         value="{{$rows->day}}">
                                                </li>
                                                <br>
                                                <li><i class="fa fa-clock-o"> </i><input class="form-control" id="time"
                                                                                         name="time"
                                                                                         placeholder="ساعت کاری- مثال: 9 تا 18"
                                                                                         value="{{$rows->time}}">
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <br>
                                        <button class="btn btn-primary btn-block">ثبت و ارسال اطلاعات</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--// Header Top Area -->

                </div>
                <hr>
                <br>
                <br>
                <br>
                <br>
                <span style="text-align: center">
                                        <h4>اطلاعات اصلی صفحه اول</h4>
</span>
                <div></div>
                <br>
                <br>
                <br>
                <br>

                <hr>
                <span style="text-align: center">
                                        <h4>اطلاعات پایینی صفحه اول</h4>
</span>
                <!-- Footer Widgets Area -->
                <div class="footer-toparea tm-padding-section" data-bgimage="/assets/images/bg/footer-bg.jpg"
                     data-overlay="2">
                    <div class="container">
                        {{--<div class="row widgets footer-widgets">--}}
                        <div class="col-md-12">
                            <div style="text-align: center">
                                <label style="text-align: center;color: red;font-size: large">لینک های سریع</label>

                            </div>
                            <div class="media-body table-responsive">
                                <table id="example2" class="table  table-striped table-bordered ">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>شمارنده</th>
                                        <th>نام سایت</th>
                                        <th>آدرس سایت</th>
                                        <th>حذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rowss as $rows)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$rows->name}}</td>
                                            <td>{{$rows->site}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-rounded"
                                                        onclick="deleteData({{$rows->id}})"><i
                                                        class="ti-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>

                            <!--// Single Widget (Widget Info) -->
                        </div>
                        <!-- Single Widget (Widget Info) -->
                        <form method="post" action="/admin/mainpage/storee">

                            @csrf
                            <br>
                            <h5 style="font-max-size: x-large;color: red">ایجاد لینک جدید</h5>


                            <div class="row">

                                <div class=" col-md-12">
                                    <label>نام فارسی </label>

                                    <input required name="name" class="col-md-6 form-control"
                                           placeholder="نام فارسی را وارد نمایید">

                                </div>


                                <div class=" col-md-12">
                                    <label>آدرس سایت</label>

                                    <input required name="site" class="col-md-6 form-control"
                                           placeholder="آدرس را وارد نمایید">


                                </div>


                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <button class="btn btn-primary btn-block">ثبت و ارسال اطلاعات</button>
                                </div>
                            </div>
                        </form>

                        <form method="post" action="/admin/mainpage/storeefooter">
                            <div class="row">
                                {{csrf_field()}}
                                <div class="single-widget widget-info col-md-12 table-responsive">
                                    <div>
                                        <label style="text-align: center;color: red;font-size: large">متن پایین
                                            صفحه</label>

                                    </div>
                                    <input class="form-control" value="{!! $rowsss->body !!}" name="body"
                                           onkeyup="countChars(this);" placeholder="لطفا متن خود را وارد نمایید.">

                                    <p id="charNum">لطفا تا 300 حرف وارد کنید</p>


                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <button class="btn btn-primary btn-block">ثبت و ارسال اطلاعات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--</div>--}}
@endsection('content')
<script>
    function countChars(obj) {
        var maxLength = 300;
        var strLength = obj.value.length;
        var charRemain = (maxLength - strLength);

        if (charRemain < 0) {
            document.getElementById("charNum").innerHTML = '<span style="color: red;">شما بیشتر از  ' + maxLength + ' حرف وارد کردید </span>';
        } else {
            document.getElementById("charNum").innerHTML = charRemain + ' حرف مانده';
        }
    }
</script>
<script>
    function deleteData(id) {

        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام دیتای مرتبط با آن حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/mainpage/delete')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "حذف با موفقیت انجام شد!",
                                icon: "success",

                            });
                            window.location.reload(true);
                        },
                        error: function () {
                            swal({
                                title: "خطا...",
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })

                        }
                    });
                } else {
                    swal("عملیات حذف لغو گردید");
                }
            });

    }
</script>
