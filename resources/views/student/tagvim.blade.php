@extends('layouts.student')
@section('css')
@endsection('css')
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#exampleModal").modal('show');
        });
    </script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')

@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('content')


    <div class="card">
        <div class="card-body">

            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr style="text-align: center">
                        <th>روز هفته</th>
                        <th>تایم و درس</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($udays as $uday)

                        <tr style="text-align: center">

                            <td>{{$uday->days->name}}</td>
                            <td>
                                @foreach($days as $day)
                                    @if($uday->day==$day->day)
                                        <span style="color: #0000cc">
                                                                                    ساعت: {{$day->times->start}}-{{$day->times->end}}

                                        </span>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <span style="color: black">
                                                                               درس: {{$day->dars->name}}

                                    </span>
                                        <br>
                                    @endif
                                @endforeach
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection('content')


