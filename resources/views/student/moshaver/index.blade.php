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
            <h3>جلسه های شما </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">جلسه مشاور</a></li>
                    <li class="breadcrumb-item active" aria-current="page">جلسه های شما</li>
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
                        <th>مشاور</th>
                        <th>عنوان جلسه</th>
                        <th>تاریخ جلسه</th>
                        <th>ساعت جلسه</th>
                        <th>عملیات</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $idn = 1; ?>
                    @foreach($rows as $row)
                        <tr style="text-align: center">

                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$row->user->f_name}} {{$row->user->l_name}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->date}}</td>
                            <td>{{$row->start}}</td>
                            <td><a href="/student/moshaver/detail/{{$row->id}}"
                                   class="btn btn-primary btn-sm"> جزییات</a>
                                @if($row->online==1)
                                    <a href="/student/moshaver/join/{{$row->id}}" target="_blank">
                                        <button class="btn  btn-info btn-sm">ورود</button>
                                    </a>
                                    @if($row->record==1)
                                        <a href="/student/moshaver/records/{{$row->id}}" target="_blank">
                                            <button class="btn btn-sm btn-warning">فیلم ضبط شده</button>
                                        </a>
                                    @endif
                                @endif
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


