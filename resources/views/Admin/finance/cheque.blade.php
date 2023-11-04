@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/js/num2persian-min.js"></script>
    <script src="/js/number-divider.min.js"></script>
    <script>

        $(document).on('focus', '.price-box-product input', function () {
            var boxPrice = $(this).siblings('.price-box-product-content');
            boxPrice.fadeIn(100);
            boxPrice.find('.price-box-numbers').html($(this).val())
            boxPrice.find('.price-box-numbers').divide({
                delimiter: ',',
                divideThousand: false
            });
            var e = this;
            this.nextSibling.nextElementSibling.children[3].childNodes[1].nextElementSibling.innerHTML = e.value
                .toPersianLetter()
            e.oninput = myHandler;
            e.onpropertychange = e.oninput; // for IE8
            function myHandler() {
                this.nextSibling.nextElementSibling.children[3].childNodes[1].nextElementSibling.innerHTML = e.value
                    .toPersianLetter();
            }
        });

        $(document).on('click', '.price-box-product-content button.close', function () {
            $(this).parents('.price-box-product-content').fadeOut(100);
        })

        $(document).on('blur', '.price-box-product input', function () {
            $(this).siblings('.price-box-product-content').fadeOut(100);
        });

        $(document).on('keyup', '.price-box-product input', function () {
            var boxPrice = $(this).siblings('.price-box-product-content');
            boxPrice.find('.price-box-numbers').html($(this).val());
            boxPrice.find('.price-box-numbers').divide({
                delimiter: ',',
                divideThousand: false
            });
        });
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#hideshow').on('click', function (event) {
                jQuery('#search').toggle('show');
            });
        });
    </script>
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>مدیریت مالی</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت مالی</a></li>
                    <li class="breadcrumb-item active" aria-current="page">چک ها / نقدها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->
{{--            @can('cheque-create')--}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCheque">
                    ثبت چک جدید
                </button>

                <!-- Modal -->
                <div class="modal fade " id="createCheque" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">ثبت چک جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/admin/store/cheque_cash">
                                @csrf
                                <input type="hidden" name="type" value="cheque">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>دانش آموز</label>
                                            <select class="js-example-basic-single" name="user_id">
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}">{{$student->f_name}}
                                                        &nbsp;{{$student->l_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>مبلغ(ریال)</label>

                                            <div class="price-box-product">

                                                <input required type="number" name="price" id="price"
                                                       class="form-control">
                                                <div class="price-box-product-content">
                                                    <div
                                                        class="price-box-header-product d-flex justify-content-between align-items-center">
                                                        <span>وضعیت مبلغ شما</span>
                                                        <button class="close"><i
                                                                class="ion-android-close"></i></button>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-secondary ml-2">به عدد:</span>
                                                        <span class="price-box-numbers ml-2">
                                                                        </span>
                                                        <span class="text-dark">ریال</span>
                                                    </div>

                                                    <hr>
                                                    <div class="d-flex align-items-center">
                                                                        <span class="text-secondary ml-2">به
                                                                            حروف:</span>
                                                        <span class="price-box-letters ml-2">
                                                                        </span>
                                                        <span class="text-dark">ریال</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>سررسید</label>

                                            <input required type="text" autocomplete="off"
                                                   name="date-picker-shamsi-list"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label>شماره چک</label>

                                            <input required type="number" name="cheque_number" class="form-control">
                                        </div>
                                        <div class="col-md-1">
                                            <label>پرداخت </label>

                                            <input type="checkbox" name="verify" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-block">ذخیره</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createCache">
                    ثبت مبلغ نقدی
                </button>

                <!-- Modal -->
                <div class="modal fade " id="createCache" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">ثبت چک جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/admin/store/cheque_cash">
                                @csrf
                                <input required type="hidden" name="type" value="cache">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>دانش آموز</label>
                                            <select class="js-example-basic-single" name="user_id">
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}">{{$student->f_name}}
                                                        &nbsp;{{$student->l_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>مبلغ(ریال)</label>
                                            <div class="price-box-product">

                                                <input required type="number" name="price" id="price"
                                                       class="form-control">
                                                <div class="price-box-product-content">
                                                    <div
                                                        class="price-box-header-product d-flex justify-content-between align-items-center">
                                                        <span>وضعیت مبلغ شما</span>
                                                        <button class="close"><i
                                                                class="ion-android-close"></i></button>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-secondary ml-2">به عدد:</span>
                                                        <span class="price-box-numbers ml-2">
                                                                        </span>
                                                        <span class="text-dark">ریال</span>
                                                    </div>

                                                    <hr>
                                                    <div class="d-flex align-items-center">
                                                                        <span class="text-secondary ml-2">به
                                                                            حروف:</span>
                                                        <span class="price-box-letters ml-2">
                                                                        </span>
                                                        <span class="text-dark">ریال</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>سررسید</label>

                                            <input required type="text" autocomplete="off"
                                                   name="date-picker-shamsi-list"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label>پرداخت </label>

                                            <input type="checkbox" name="verify" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-block">ذخیره</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
{{--            @endcan--}}
            <button type="button" class="btn btn-success">
                جمع مبالغ:
                {{number_format($sum)}}
            </button>
            <br>
            <br>
            <input type='button' class="btn btn-warning" id='hideshow' value='جستجوی پیشرفته'>
            <div id='search' style="display: none">
                <form method="get" action="/admin/cheque">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <label>نام دانش آموز</label>
                            <select class="js-example-basic-single" name="user_id">
                                <option></option>
                                @foreach($students as $student)
                                    <option @if(request()->user_id==$student->id) selected
                                            @endif value="{{$student->id}}">{{$student->f_name}}
                                        &nbsp;{{$student->l_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-2">
                            <label>کلاس دانش آموز</label>
                            <select class="js-example-basic-single" name="class">
                                <option></option>
                                @foreach($students->unique('class') as $student)
                                    <option @if(request()->class==$student->class) selected
                                            @endif value="{{$student->class}}">{{$student->class}}
                                        &nbsp;
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-2">
                            <label>تاریخ سررسید از</label>
                            <input type="text" autocomplete="off" name="date-picker-shamsi-list"
                                   value="{{request()->input('date-picker-shamsi-list')}}"
                                   class="form-control">
                        </div>
                        <div class="p-2">
                            <label>تاریخ سررسید تا</label>
                            <input type="text" autocomplete="off" name="date-picker-shamsi-list-1"
                                   value="{{request()->input('date-picker-shamsi-list-1')}}"
                                   class="form-control">
                        </div>
                        <div class="p-2">
                            <label>تایید شده؟</label>
                            <select class="js-example-basic-single" name="verify[]" multiple>
                                <option @if(request()->verify  and in_array(1,request()->verify)) selected
                                        @endif value="1">بله
                                </option>
                                <option @if(request()->verify and in_array(0,request()->verify)) selected
                                        @endif value="0">خیر
                                </option>
                            </select>
                        </div>
                        <div class="p-2">
                            <label>نوع پرداخت</label>
                            <select class="js-example-basic-single" name="type[]" multiple>
                                <option @if(request()->type  and in_array('cheque',request()->type)) selected
                                        @endif value="cheque">چکی
                                </option>
                                <option @if(request()->type and in_array('cache',request()->type)) selected
                                        @endif value="cache">نقدی
                                </option>
                            </select>
                        </div>


                        <div class="p-2">
                            <br>
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>
            <br>
            <div class="media-body table-responsive">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">

                        <th>شمارنده</th>
                        <th>دانش آموز</th>
                        <th>کلاس</th>
                        <th>نوع پرداخت</th>
                        <th>شماره چک</th>
                        <th>سررسید</th>
                        <th>تاریخ ثبت</th>
                        <th>وضعیت</th>
                        <th>مبلغ(ریال)</th>
{{--                        @can('cheque-create')--}}

                            <th>تایید</th>
                            <th>حذف</th>
{{--                        @endcan--}}
                    </tr>
                    </thead>
                    <tbody id="myTable">

                        <?php $idn = 1; ?>
                    @foreach($cheques as $log)
                        <form action="{{url('/admin/finance/fish/edit').'/'.$log->id}}" method="post">
                            {{csrf_field()}}
                            @method('put')
                            @if($log->verify==1)
                                <tr style="text-align: center;background-color: #00b179">

                            @else
                                <tr style="text-align: center;background-color: firebrick;color: black">
                                    @endif
                                    <td>{{$idn}}</td>
                                    <td>{{$log->user->f_name}}
                                        {{$log->user->l_name}}
                                    </td>
                                    <td>{{$log->user->class}}
                                    </td>
                                    <td>
                                        @if($log->type=='cheque')
                                            چک
                                        @else
                                            نقدی
                                        @endif
                                    </td>
                                    <td>{{$log->cheque_number}}</td>
                                    <td>
                                        <input required type="text" value="{{$log->cheque_date}}" autocomplete="off"
                                               name="date-picker-shamsi-list"
                                               class="form-control">
                                    </td>
                                    <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($log->created_at->toDateString()))}}</td>
                                    <td>
                                        @if($log->verify==0)
                                            تاییده نشده
                                        @else
                                            تایید شده
                                        @endif
                                    </td>
{{--                                    @can('cheque-create')--}}

                                        <td>
                                            <div class="price-box-product">

                                                <input style="text-align: center" name="price" class="form-control"
                                                       value="{{$log->price}}" required>
                                                <div class="price-box-product-content">
                                                    <div
                                                        class="price-box-header-product d-flex justify-content-between align-items-center">
                                                        <span>وضعیت مبلغ شما</span>
                                                        <button class="close"><i
                                                                class="ion-android-close"></i></button>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-secondary ml-2">به عدد:</span>
                                                        <span class="price-box-numbers ml-2">
                                                                        </span>
                                                        <span class="text-dark">ریال</span>
                                                    </div>

                                                    <hr>
                                                    <div class="d-flex align-items-center">
                                                                        <span class="text-secondary ml-2">به
                                                                            حروف:</span>
                                                        <span class="price-box-letters ml-2">
                                                                        </span>
                                                        <span class="text-dark">ریال</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-info">تغیر وضعیت و مبلغ</button>
                                        </td>
{{--                            @endcan--}}
                        </form>
                        <td>
                            <button type="button" class="btn btn-danger btn-rounded" onclick="deleteData({{$log->id}})">
                                <i
                                    class="ti-trash"></i></button>
                        </td>

                        </tr>

                            <?php
                            $idn = $idn + 1;
                            ?>
                    @endforeach

                    </tbody>

                </table>
            </div>
            {{ $cheques->links() }}
        </div>
    </div>
    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('content')

<script>
    function toggless(id, obj) {
        var $input = $(obj);
        var status = 0;
        if ($input.prop('checked')) {
            var status = 1;
        }

        $.ajaxSetup({

            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: '{{url('/admin/changeStatus/finance')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                "id": id
            },
            success: function (data) {
                if (status == 1) {
                    swal({
                        title: "{{config('global.student')}} تایید مالی شد.",
                        icon: "success",

                    });
                }
                if (status == 0) {
                    swal({
                        title: "{{config('global.student')}} عدم تایید مالی شد.",
                        icon: "success",

                    });
                }
                location.reload();

            }
        })


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
                        url: "{{  url('/admin/delete/cheque_cash')  }}" + '/' + id,
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

