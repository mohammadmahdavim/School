@extends('layouts.admin')

@section('script')
    <script type="text/javascript" src="/assets/js/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/js/form_multiselect.js"></script>

@stop

@section('css')

@stop
@section('header')
    <div class="page-header">
        <div>
            <h3>اختصاص آیتم</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آرشیو</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اختصاص آیتم</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row text-center justify-content-md-center">
                <div class="col-md-6 m-t-b-20" style="text-align: center">
                    <div>

                        <h4>اختصاص آیتم به افراد</h4>
                    </div>
                </div>

            </div>
            <form method="POST" action="/admin/archive/sync/{{$item->id}}">
                {{csrf_field()}}
                <input name="model" value="Moshaver" hidden>
                <div class="col-md-4 m-t-b-20">
                    <label>نام آیتم</label>
                    <h3>{{$item->title}}</h3>
                    <div>
                        {{--{!! Form::select('permission_id[]',$permissions , null,['class'=>'multiselect','multiple'=>'multiple'] ) !!}--}}
                        {{--@if($errors->has('permission_id'))--}}
                        {{--<span style="color:red;font-size:13px">{{ $errors->first('permission_id') }}</span>--}}
                        {{--@endif--}}
                        {{--<select name="user" id="user" class="select2 form-control">--}}
                        {{--@foreach($users as $user)--}}

                        {{--<option value="{{$user->id}}">{{$user->f_name}}--}}
                        {{---{{$user->l_name}}</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                    </div>
                </div>
                <div class="col-md-12 m-t-b-20">
                    <label>افراد</label>

                    <div class="multi-select-full">
                        {{--{!! Form::select('permission_id[]',$permissions , null,['class'=>'multiselect','multiple'=>'multiple'] ) !!}--}}
                        {{--@if($errors->has('permission_id'))--}}
                        {{--<span style="color:red;font-size:13px">{{ $errors->first('permission_id') }}</span>--}}
                        {{--@endif--}}
                        <select name="class[]" class="multiselect-warning"
                                style="text-align: right"
                                multiple="multiple">
                            @foreach($allclass as $allclas)
                                <option value="{{$allclas->classnamber}}">{{$allclas->classnamber}}کلاس</option>
                            @endforeach
                        </select>
                        <select name="users[]" class="multiselect-info"
                                style="text-align: right"
                                multiple="multiple">

                            @foreach($allstudents as $allstudent)
                                <option value="{{$allstudent->id}}"
                                        @if(in_array($allstudent->id , $syncs->pluck('user_id')->toArray())) selected @endif>{{$allstudent->f_name}} {{$allstudent->l_name}}- کلاس {{$allstudent->class}}-{{$allstudent->role}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 m-t-b-20">
                    <button class="btn btn-primary" type="submit">ثبت
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')


@endsection
