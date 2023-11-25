@extends('layouts.admin')
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
            <!-- Button trigger modal -->
            <form action="/admin/reserves/export">

                <input type="text" autocomplete="off" name="date-picker-shamsi-list"
                       value="{{request()->input('date-picker-shamsi-list')}}"
                       class="form-control" hidden="hidden">
                <input type="text" autocomplete="off" name="code"
                       value="{{request()->input('code')}}"
                       class="form-control" hidden="hidden">
                <input type="text" autocomplete="off" name="name"
                       value="{{request()->input('name')}}"
                       class="form-control" hidden="hidden">
                <button class="btn btn-warning" type="submit">خروجی اکسل</button>
            </form>
            <br>
            <input type='button' class="btn btn-success" id='hideshow' value='جستجو'>

            <div id='search' style="display: none">
                <form method="get" action="/admin/reserves">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <label>کد رزرو</label>
                            <input type="text" autocomplete="off" name="code"
                                   value="{{request()->input('code')}}"
                                   class="form-control">
                        </div>
                        <div class="p-2">
                            <label>تاریخ</label>
                            <input type="text" autocomplete="off" name="date-picker-shamsi-list"
                                   value="{{request()->input('date-picker-shamsi-list')}}"
                                   class="form-control">
                        </div>
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
                        <th>دانش آموز</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>پرداخت شده</th>
                        <th>دریافت شده</th>
                        <th>رزرو برای تاریخ</th>
                        <th>کد رزرو</th>
                        <th>دریافت کرد؟</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>

                            <td style="text-align: center">{{$row->user->f_name}} {{$row->user->l_name}}</td>
                            <td style="text-align: center">{{$row->product->title}}</td>
                            <td style="text-align: center">{{$row->product->price}}</td>
                            <td>
                                @if($row->payed==1)
                                    بله
                                @else
                                    خیر
                                @endif
                            </td>
                            <td>
                                @if($row->used==1)
                                    بله
                                @else
                                    خیر
                                @endif
                            </td>
                            <td>
                                {{$row->for_date}}
                            </td>
                            <td>
                                {{$row->code}}
                            </td>
                            <td><input class="form-control" type="checkbox" name="used"
                                       onclick="change('{{$row->id}}',this) "
                                       @if($row->used=='1') checked @endif></td>
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
<script>
    function change(id, obj) {
        var $input = $(obj);
        var type = 0;
        if ($input.prop('checked')) {
            var type = 1;
        }

        $.ajaxSetup({

            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: '{{url('/admin/reserves/change_type')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                type: type,
                "id": id
            },
            success: function () {
                swal({
                    title: "عملیات انجام شد.",
                    icon: "success",

                });
                location.reload();

            }
        })


    }
</script>


