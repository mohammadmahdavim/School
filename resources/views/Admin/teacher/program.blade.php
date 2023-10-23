@extends('layouts.admin')
@section('css')

@endsection('css')
@section('script')

    <!-- end::dataTable -->
@endsection('css')
@section('script')
    <!-- begin::dataTable -->

    <script type="text/javascript" src="/assets/jss/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/jss/js/pages/form_multiselect.js"></script>

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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش برنامه {{config('global.teachers')}}</li>

                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="table-responsive">


                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                            <thead>
                            <tr class="danger" style="text-align: center">
                                <th>نام {{config('global.teacher')}}</th>
                                <th>نام خانوادگی {{config('global.teacher')}}</th>
{{--                                <th>ساعت موظفی</th>--}}
{{--                                <th>ساعت غیر موظفی</th>--}}
                                <th>روزهای حضور</th>


                            </tr>
                            </thead>
                            <tbody>

                            @foreach($programs as $program)
                                <tr style="text-align: center">
                                    <td>
                                        {{\App\User::where('id',$program->teacher_id)->first()['f_name']}}
                                    </td>
                                    <td>
                                        {{\App\User::where('id',$program->teacher_id)->first()['l_name']}}
                                    </td>
                                    <td>
                                        {{\App\teacher::where('user_id',$program->teacher_id)->first()['time1']}}
                                    </td>
                                    <td>
                                        {{\App\teacher::where('user_id',$program->teacher_id)->first()['time2']}}
                                    </td>
                                    <td>
                                        @foreach($programdays as $programday)
                                            @if($program->teacher_id==$programday->teacher_id)
                                                {{$programday->day}} -
                                            @endif
                                        @endforeach

                                    </td>
                                </tr>

                            @endforeach

                            <script src="/js/sweetalert.min.js"></script>
                            @include('sweet::alert')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
