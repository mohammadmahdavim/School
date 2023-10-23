@extends('layouts.admin')
@section('css')
    <style>
        .alignleft {
            float: left;
        }
        .alignright {
            float: right;
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
            <h3>پرداخت شده ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">شهریه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پرداخت های شهریه {{$tuitions->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')

    <!-- /attachments -->

    <div class="card">
        <div class="card-body">
            <label>   عنوان شهریه: {{$tuitions->title}} </label>
            <br>
            <label style="color: #b91d19">   مبلغ شهریه: {{$tuitions->price}} ریال</label>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center" class="success">
                        <th>شمارنده</th>
                        <th>پرداخت کننده</th>
                        <th>مبلغ پرداخت کرده</th>
                        <th>مانده</th>
                        <th>تاریخ پرداخت</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>

                    @foreach($tuitions->paytuition as $tuition)

                        <tr style="text-align: center">
                            <td style="text-align: center">{{$idn}}</td>


                            <td>{{$tuition->user->f_name}}-{{$tuition->user->l_name}}</td>
                            <td>{{$tuition->price}} ریال</td>
                            <td>
                           {{$tuitions->price-$tuition->price}}
                            </td>
                            <td>{{ $tuition->created_at }}</td>


                        </tr>
                        <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- /single mail -->
@endsection('content')


