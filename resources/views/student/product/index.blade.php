@extends('layouts.student')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/datepicker/daterangepicker.css">
@endsection('css')
@section('script')
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/vendors/datepicker/daterangepicker.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    @include('sweet::alert')
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
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="/student/reserves"><button class="btn btn-success">رزرو های من</button></a>
            <!-- Button trigger modal -->
            <input type='button' class="btn btn-warning" id='hideshow' value='جستجو'>
            <div id='search' style="display: none">
                <form method="get" action="/student/products">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <label>نام محصول</label>
                            <input type="text" autocomplete="off" name="name"
                                   value="{{request()->input('name')}}"
                                   class="form-control">
                        </div>


                        <div class="p-2">
                            <br>
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>


            <!-- Modal -->
            <div class="">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">
                                @if($row->image)
                                    <img src="/product/{{$row->image}}" width="50" height="50" class="rounded">
                                @endif
                            </td>
                            <td style="text-align: center">{{$row->title}}</td>
                            <td style="text-align: center">{{$row->price}}</td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#pay">
                                    <i class="fa fa-dollar"></i>
                                    &nbsp;
                                    پرداخت
                                </button>
                                <div class="modal fade" id="pay" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">پرداخت و رزرو
                                                    {{$row->title}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/student/products/pay" method="post">
                                                @csrf
                                                <input name="product" value="{{$row->id}}" hidden="hidden">
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>قیمت</label>
                                                            <input class="form-control" disabled
                                                                   value="{{number_format($row->price)}}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>برای تاریخ</label>
                                                            <input class="form-control" autocomplete="off"
                                                                   name="date-picker-shamsi-list" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">ذخیره
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#reserve">
                                    رزرو
                                </button>
                                <div class="modal fade" id="reserve" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">پرداخت و رزرو
                                                    {{$row->title}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/student/products/reserve" method="post">
                                                @csrf
                                                <input name="product" value="{{$row->id}}" hidden="hidden">

                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>برای تاریخ</label>
                                                            <input class="form-control" autocomplete="off"
                                                                   name="date-picker-shamsi-list" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">ذخیره
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                    </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')


