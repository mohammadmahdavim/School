@extends('layouts.student')
@section('css')
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
            <div style="text-align: right">
                <div class="table-responsive">
                    <table class="overflow-y" id="myTable">
                        <thead>
                        <tr style="text-align: center">

                            <th>شمارنده</th>
                            <th>عنوان شهریه</th>
                            <th>هزینه شهریه</th>
                            <th>تاریخ درخواست مدرسه</th>
                            <th>مهلت پرداخت</th>
                            <th>پرداختی</th>
                            <th>مانده</th>
                            <th>پرداخت هزینه</th>


                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @include('Admin.errors')
                        <?php $idn = 1; ?>

                        @foreach($data->student_class->tuition as $user )
                            <tr style="text-align: center">
                                <td style="text-align: center">{{$idn}}</td>
                                <td>{{$user->title}}</td>
                                <td>{{$user->price}} ریال</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->expire}}</td>
                                @if(count($user->student_pay_tuition)>0)
                                    <td>{{$user->student_pay_tuition[0]->price}} ریال</td>
                                    <td>{{$user->price - $user->student_pay_tuition[0]->price}} ریال</td>
                                @else
                                    <td>0 ریال</td>
                                    <td>{{$user->price}} ریال</td>
                                    <td>
                                        <button onclick="formdata({{$user->price}})" type="button"
                                                class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                            پرداخت کنید
                                        </button>
                                    </td>
                                @endif
                                @if(count($user->student_pay_tuition)>0 && $user->price> $user->student_pay_tuition[0]->price)
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button onclick="formdata({{$user->price - $user->student_pay_tuition[0]->price}})"
                                                type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                            پرداخت کنید
                                        </button>
                                    </td>
                                @endif
                            </tr>
                            <?php $idn = $idn + 1 ?>


                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="tuition" method="post">
                    @csrf
                    @include('errors')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">پرداخت شهریه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <label>مبلغ را به ریال وارد کنید</label>
                        <input type="number" name="price" id="price" class="form-control"
                               value=""
                               placeholder="مبلغ را وارد کنید">
                        <input name="user_id" value="{{$iduser}}" hidden>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف
                        </button>
                        <button type="submit" class="btn btn-primary">پرداخت</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

@endsection('content')
<script>
    function formdata(price) {
        document.getElementById('price').value = price;
    }

</script>