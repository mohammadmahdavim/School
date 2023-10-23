@extends('layouts.student')
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <link rel="stylesheet" type="text/css" href="/assets/excel/css/component.css"/>
    <style>
        .fab {
            width: 40px;
            height: 40px;
            background-color: gold;
            border-radius: 50%;
            box-shadow: 0 6px 10px 0 #666;
            transition: all 0.1s ease-in-out;

            font-size: 20px;
            color: white;
            text-align: center;
            line-height: 40px;

            position: fixed;
            right: 2%;
            bottom: 18%;
        }

        .fab:hover {
            box-shadow: 0 6px 14px 0 #666;
            transform: scale(1.15);
        }

        @media screen and (max-width: 1000px) {
            .fab {
                display: none;
            }
        }
    </style>
    <style>

        .checkout-paymethod-title {
            font-size: 1.143rem;
            line-height: 1.375;
            font-weight: 500;
            letter-spacing: -.7px;
            color: #000;
            font-weight: bold;
        }

        .checkout-paymethod-title span {
            font-size: .8em;
            line-height: 1.571;
            font-weight: 500;
            letter-spacing: -.5px;
            display: block;
            margin-top: 5px;
            color: #a0a0a0;
        }

        .checkout-paymethod-options {
            border-top: 1px solid #e2f2f4;
            padding: 18px 20px 24px;
            font-size: 14px;
            font-size: 1rem;
            line-height: 1.571;
            position: relative;
            width: 100%;
        }

        .checkout-paymethod-item.is-select-mode + .checkout-paymethod-options {
            display: block;
            background-color: #fbffff;
        }

        .checkout-paymethod-providers {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin: -16px -16px 0 0;
            position: relative;
        }

        .checkout-paymethod-providers-arrow {
            width: 14px;
            height: 14px;
            transform: rotate(45deg);
            border-left: 1px solid #cbf1f5;
            position: absolute;
            top: -10px;
            right: 100px;
            background-color: #fbffff;
        }

        .checkout-paymethod-item.is-select-mode + .checkout-paymethod-options .checkout-paymethod-providers-arrow {
            background-color: #fbffff;
        }

        .checkout-paymethod-providers label {
            border-radius: 11px;
            background: #fff;
            border: 1px solid #cbf1f5;
            position: relative;
            display: flex;
            height: 64px;
            margin-top: 16px;
            cursor: pointer;
            padding: 10px 57px 10px 20px;
            align-items: center;
            margin-right: 16px;
        }

        .checkout-paymethod-providers label.is-selected {
            border-color: #cbf1f5;
            background-color: #cbfdff;
        }

        .ui-radio {
            width: 14px;
            height: 14px;
            display: inline-block;
            position: relative;
        }

        .checkout-paymethod-providers label .ui-radio {
            position: absolute;
            right: 31px;
            top: 50%;
            transform: translateY(-50%);
        }

        .ui-radio input[type="radio"] {
            visibility: hidden;
            position: absolute;
        }

        .ui-radio-check {
            cursor: pointer;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #ccc;
        }

        .ui-radio-check {
            cursor: pointer;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #ccc;
        }

        .ui-radio input[type="radio"]:checked + .ui-radio-check::before {
            content: "";
            position: absolute;
            left: 1px;
            top: 1px;
            width: 10px;
            height: 10px;
            background: #00bfd6;
            border-radius: inherit;
        }

        .checkout-paymethod-source-title {
            display: block;
            font-size: .9em;
            font-weight: 400;
        }

        .checkout-paymethod-providers label img {
            margin-right: 5px;
            max-height: 37px;
            max-width: 80px;
        }

        .checkout-paymethod-item img {
            margin-right: auto;
        }
    </style>
@endsection('css')
@section('script')

@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>شهریه ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">شهریه ها</a></li>

                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body" style="padding-right: -10px">
            <span style="color: black">وضعیت دانش آموز</span>
            <div class="d-flex flex-row">
                <div class="p-2">


                    <span style="color: black">کل شهریه:</span>
                    @if(!empty($finance))
                        {{number_format($finance->total)}}
                    @endif

                </div>
                <div class="p-2">


                    <span style="color: #00b179">پرداختی:</span>
                    @if(!empty($finance))

                        {{number_format($finance->paid)}}
                    @endif
                </div>
                <div class="p-2">


                    <span style="color: darkred">مانده:</span>
                    @if(!empty($finance))

                        {{number_format($finance->remaining)}}
                    @endif
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-outline-primary block btn-sm" data-toggle="modal"
                            data-target="#default">
                        پرداخت آنلاین
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-right" id="default" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">

                            <div class="modal-dialog" role="document">
                                <form onsubmit="return false" id="paymentForm">

                                    @include('errors')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">پرداخت شهریه</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>مبلغ را به ریال وارد کنید</label>
                                                <input type="number" name="price" id="price" class="form-control"
                                                       value=""
                                                       placeholder="مبلغ را وارد کنید" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <div class="checkout-paymethod-options">
                                                    <div class="checkout-paymethod-providers">
                                                        <div class="checkout-paymethod-providers-arrow"></div>
                                                        <label class="">
                                                            @foreach($gateways as $gateway)
                                                                <span class="ui-radio">
                                                            <input type="radio" name="gateway_id" value="{{$gateway->id}}"
                                                                   @if($gateway->default == 1) checked @endif>
                                                            <span class="ui-radio-check"></span>
                                                        </span>
                                                                <span
                                                                        class="checkout-paymethod-source-title">{{$gateway->name}}</span>
                                                                <img src="{{url('assets/images/'.$gateway->image)}}"
                                                                     alt="">
                                                        </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف
                                            </button>
                                            <button onclick="payment();" id="paymentBtn" class="btn btn-primary payment-btn-form">پرداخت</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <form method="POST" action="/student/finance/upload" enctype="multipart/form-data">
                {{csrf_field()}}
                @include('Admin.errors')
                <div class="row">


                    <div class="col-md-5">
                    <span>
                                             آپلود تصویر فیش
                    </span>


                        <input type="file" name="file" class="form-control" required>

                    </div>
                    <div class="col-md-5">
                    <span>
                                             مبلغ به ریال
                    </span>


                        <input type="number" name="price" class="form-control" autocomplete="off" required>

                    </div>
                    <div class="col-md-2">
                        <br>
                        <button type="submit" class="btn btn-info"> ارسال</button>

                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body" style="padding-right: -10px">
              <span>
                                            لیست پرداختی ها
                    </span>
            <br>
            <div style="text-align: right">


                <div class="table-responsive">
                    <br>

                    <table class="overflow-y" id="myTable">
                        <thead>
                        <tr style="text-align: center">

                            <th>شمارنده</th>
                            <th>هزینه شهریه</th>
                            <th>نوع پرداخت</th>
                            <th>تاریخ پرداخت</th>
                            <th>وضعیت</th>
                            <th>دانلود فایل</th>


                        </tr>
                        </thead>
                        <tbody id="myTable">

                        <?php $idn = 1; ?>
                        @foreach($log_finance as $log)
                            <tr style="text-align: center">
                                <td>{{$idn}}</td>
                                <td>{{$log->price}}</td>
                                <td>{{$log->type}}</td>
                                <td>{{$log->created_at}}</td>
                                <td>
                                    @if($log->verify==0)
                                        <span style="color: orangered">
                                                                                    تاییده نشده

                                        </span>
                                    @else
                                        <span style="color: #00b179">
                                                                                   تایید شده

                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($log->filename)
                                        <a href="{{ route('finance.download', $log->id) }}"><i
                                                    class="icon-download"></i>&nbsp
                                            &nbsp<span>دانلود فیش</span> </a>
                                    @else
                                        بدون فایل
                                    @endif
                                </td>
                            </tr>
                            <?php
                            $idn = $idn + 1;
                            ?>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->


    <script src="/js/sweetalert.min.js"></script>
    <script>
        payment = function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $('#paymentBtn').attr('disable');

            var data = $('#paymentForm').serialize();

            $.ajax({
                url: '/student/finance/finance/online',
                type: 'POST',
                data: data,
                success: function (response) {
                    $('#paymentBtn').attr('enable');
                    window.location.replace(response.url);
                },
                error: function (xhr) {
                    $('#paymentBtn').attr('enable');
                    if (xhr.status === 422) {
                        jQuery.each(xhr.responseJSON.errors, function (key, value) {
                            toastr.error(value);
                        });
                    }
                    if (xhr.status !== 422) {
                        toastr.warning(xhr.responseJSON.message);
                    }
                }
            });
        }

    </script>
    @include('sweet::alert')
@endsection('content')
