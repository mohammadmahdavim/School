@extends('layouts.student')
@section('css')

@endsection('css')
@section('script')

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
            <h3>برنامه های شما </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">برنامه مشاور</a></li>
                    <li class="breadcrumb-item active" aria-current="page">برنامه های شما</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')

    <div class="card">
        <div class="card-body">


            <br>

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 table-fixed">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان برنامه</th>
                        <th>تاریخ ارسال</th>
                        <th>دانلود فایل</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($rows as $row)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->created_at->ToDateString()}}</td>
                            <td><a href="{{ route('barname.moshaver.download', $row->id) }}"
                                   class="btn btn-outline-warning"> <i class="icon-download"></i> Download </a>

                            </td>
                        </tr>
                        <?php $idn = $idn + 1 ?>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

@endsection('content')


<script>

</script>


