@extends('layouts.student')
@section('css')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>تکالیف دریافت شده</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">پیشخوان کاربری</a></li>
                    <li class="breadcrumb-item"><a href="#">تکالیف</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تکالیف دریافت شده</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="padding-right: 20px">

                <div class="col-md-4">
                    <input id="myInput" type="text" placeholder="جستجو..." class="form-control">
                </div>
                <br>
                <table id="" class="table table-striped table-bordered">
                    <thead>
                    <tr style="text-align: center">
                        <th>درس</th>
                        <th>{{config('global.teacher')}}</th>
                        <th>عنوان تکلیف</th>
                        <th>تاریخ ارسال تکلیف</th>
                        <th>فرصت تحویل</th>
                        <th style="text-align: center">فایل</th>
                        @if(auth()->user()->role=='دانش آموز')

                            <th style="text-align: center">عملیات</th>
                        @endif
                        <th>توضیحات</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tamrin as $tamr)
                        @foreach($tamr as $tamri)

                            @if(empty(getsend($tamri->id)))

                                <tr style="background-color:#DD3549;text-align: center;color: #040000">
                            @else
                                <tr style="background-color: #35A266;text-align: center;color: #040000">
                                    @endif
                                    <td>
                                        <p>{{$tamri->dars}}</p>
                                    </td>
                                    <td>
                                        <p class="js-example-basic-single">{{\App\User::where('id',$tamri->user_id)->first()['f_name']}}
                                            - {{\App\User::where('id',$tamri->user_id)->first()['l_name']}}</p>
                                    </td>
                                    <td>
                                        <p class="js-example-basic-single">{{$tamri->title}}</p>
                                    </td>
                                    <td>
                                        {{ $tamri->created_at->toDateString() }}
                                        @if($tamri->updated_at->toDateString() !==$tamri->created_at->toDateString())
                                            <hr>
                                            <span style="color:#911203">
                                <p>بروز شده در تاریخ:</p>
                                    {{ $tamri->updated_at->toDateString() }}
                                    </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="text" id="mark4" name="mark4"
                                                @if(getexpire($tamri->expire) == 'پایان فرصت') class="btn btn-danger"
                                                @else class="btn btn-success" @endif >{{getexpire($tamri->expire)}}
                                        </button>
                                    </td>
                                    <td>
                                        @if($tamri->mime)
                                            <a href="{{ route('books.download', $tamri->id) }}"
                                               class="btn btn-outline-dark">
                                                <i class="icon-download"></i> دانلود </a>
                                        @endif
                                        @if($tamri->status==1 && !empty($tamri->pmime))

                                            <a href="{{ route('jtamrinteacher.download', $tamri->id) }}"
                                               class="btn btn-outline-warning">
                                                <i class="icon-download"></i> دانلود </a>
                                            <br>
                                            <br>

                                            <label>دانلود پاسخ تمرین
                                            </label>
                                        @endif
                                    </td>

                                    @if(auth()->user()->role=='دانش آموز')
                                        <td>
                                            @if( getexpire($tamri->expire) == 'پایان فرصت' or auth()->user()->role=='اولیا')
                                                <div style="color:#040000"> فرصت تحویل تمرین به پایان رسیده است.</div>



                                            @else
                                                <div>

                                                    @if(empty($row=\App\JTamrin::where('tamrin_id',$tamri->id)->where('user_id', auth()->user()->id)->first()) )
                                                        <a href="/student/jtamrin{{$tamri->id}}">
                                                            <button style="font-family: 'B Koodak'"
                                                                    class="btn btn-success">
                                                                ارسال
                                                                تکلیف
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="/student/jtamrin/edit/{{$tamri->id}}">
                                                            <button class="btn btn-info"
                                                                    style="font-family: 'B Koodak'">
                                                                ویرایش
                                                                تکلیف ارسال کرده
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>

                                            @endif
                                        </td>
                                    @endif
                                    <td> {!! $tamri->description !!}</td>

                                </tr>
                                @endforeach
                                @endforeach
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
    </div>

@endsection('content')

<?php
function getexpire($expire)
{

    $date = explode('/', $expire);
    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
    $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
    $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
    $nowTimestamp = \Morilog\Jalali\Jalalian::forge("now")->getTimestamp();

    if ($dateEx >= $nowTimestamp) {


        $time = $dateEx - time(); // to get the time since that moment

        $tokens = array(
            31536000 => 'سال',
            2592000 => 'ماه',
            604800 => 'هفته',
            86400 => 'روز',
            3600 => 'ساعت',
            60 => 'دقیقه',
            1 => 'ثانیه'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);

            return $numberOfUnits . ' ' . $text . ' مانده';
        }
    } else {

        return 'پایان فرصت';
    }

}

function getexist($id)
{
    $user = auth()->user()->id;
    if ($user > 1000) {
        $user = auth()->user()->id - 1000;
    }
    $row = \App\JTamrin::where('tamrin_id', $id)->where('user_id', $user)->count();

    return $row;
}


function getsend($tamrinid)
{
    $iduser = auth()->user()->id;
    if (auth()->user()->role == 'اولیا') {
        $iduser = auth()->user()->id - 1000;
    }
    $send = \App\JTamrin::where('tamrin_id', $tamrinid)->where('user_id', $iduser)->first();
    return $send;
}
?>
