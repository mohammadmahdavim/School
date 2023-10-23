@extends('layouts.teacher')
@section('css')

@endsection('css')
@section('script')
    <script src="/assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
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
            <h3>تکالیف دریافت شده </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">تکالیف</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تکالیف دریافت شده کلاس {{$idc}} </li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <br>
            <input id="myInput" type="text" placeholder="Search.." class="form-control col-md-4">
            <br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>شماره کلاس</th>
                        <th>عنوان تمرین</th>
                        <th>نام {{config('global.student')}}</th>
                        <th>توضیحات {{config('global.student')}}</th>
                        <th>درجه سختی سوال</th>
                        <th>تاریخ ارسال</th>
                        <th> فایل ارسالی</th>
                        <th title="برای تغییر روی دکمه کلیک کنید.">نمره</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($jtamrins as $tamri)
                            <td style="text-align: center">{{$idn}}</td>

                            <td style="text-align: center">
                                <button class="btn btn-rounded" id="mark2" name="mark2">{{$tamri->class_id}}</button>
                            </td>
                            <td style="text-align: center">{{\App\Tamrin::where('id',$tamri->tamrin_id)->first()['title']}}</td>
                            <td style="text-align: center">{{\App\User::where('id',$tamri->user_id)->first()['f_name']}}
                                - {{\App\User::where('id',$tamri->user_id)->first()['l_name']}}</td>
                            {{--<td>{{$tamri::find($tamri->user_id)->users()->first()->id}}</td>--}}
                            {{--                        <td>{{\App\JTamrin::find($tamri->tamrin_id)->tamrin()->pluck('id')->first()}}</td>--}}


                            <td style="text-align: center"> {!! $tamri->description !!}</td>
                            <td style="text-align: center">
                                <button type="text" id="mark4" name="mark4"
                                        class="btn btn-primary">{{$tamri->daraje}}</button>
                            </td>
                            <td style="text-align: center">{{ $tamri->created_at->toDateString() }}</td>
                            <?php
                            $files = \Illuminate\Support\Facades\DB::table('jtamrin_files')->where('jtamrin_id', $tamri->id)->get();
                            ?>
                            <td style="text-align: center">
                                @foreach($files as $file)
                                    @if( $file->mime=='image/jpeg' or
                                                 $file->mime=='image/png' or
                                                 $file->mime=='image/bmp'  )

                                        <a target="_blank" href="/images/{{$file->filename}}">

                                            <img height="50" width="110" class="image"
                                                 src="{{url('/images/'.$file->filename)}}">
                                        </a>
                                        <br>
                                    @else
                                        <a href="{{ route('jtamrin.download', $file->id) }}"
                                           class="btn btn-outline-warning"> <i
                                                class="icon-download"></i> {{$file->original_filename}}
                                        </a>
                                    @endif
                                    <br>
                                @endforeach

                            </td>
                            <td style="text-align: center">
                                <div class="col-md-4">

                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#mark-{{$tamri->id}}">
                                            @if(config('global.type_mark')==1)

                                                {{$tamri->mark}}
                                            @else
                                                @if ($tamri->mark >3)
                                                    خیلی خوب

                                                @elseif (($tamri->mark <= 3) && ($tamri->mark > 2))

                                                    خوب
                                                @elseif (($tamri->mark <= 2) && ($tamri->mark > 1))
                                                    قابل قبول
                                                @elseif (($tamri->mark <= 1) && ($tamri->mark > 0))
                                                    نیاز به تلاش مجدد
                                                @endif
                                            @endif
                                        </button>
                                        <div class="modal fade" id="mark-{{$tamri->id}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="/teacher/tamrin/mark" method="post">
                                                        @csrf


                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalCenterTitle">
                                                                نام {{config('global.student')}}:
                                                                {{\App\User::where('id',$tamri->user_id)->first()['f_name']}}
                                                                - {{\App\User::where('id',$tamri->user_id)->first()['l_name']}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input name="id" value="{{$tamri->id}}" hidden>
                                                            <label>نمره</label>
                                                            @if(config('global.type_mark')==1)

                                                                <input style="text-align: center" type="number"
                                                                       name="mark" class="form-control"
                                                                       value="{{$tamri->mark}}">
                                                            @else
                                                                <select class="form-control" name="mark">
                                                                    <option @if($tamri->mark==4) selected
                                                                            @endif value="4">خیلی خوب
                                                                    </option>
                                                                    <option @if($tamri->mark==3) selected
                                                                            @endif value="3">خوب
                                                                    </option>
                                                                    <option @if($tamri->mark==2) selected
                                                                            @endif value="2">قابل قبول
                                                                    </option>
                                                                    <option @if($tamri->mark==1) selected
                                                                            @endif value="1">نیاز به تلاش مجدد
                                                                    </option>
                                                                    <option value=""></option>
                                                                </select>
                                                            @endif

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">بستن
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">ذخیره
                                                                تغییرات
                                                            </button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
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
            {{ $jtamrins->links() }}

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')


