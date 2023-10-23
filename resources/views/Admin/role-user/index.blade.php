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
            <h3>اختصاص سمت</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اختصاص سمت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row text-center justify-content-md-center">
                <div class="col-md-6 m-t-b-20" style="text-align: right">
                    <div>

                      <h4>اختصاص سمت به افراد</h4>
                    </div>
                </div>
                <div class="col-md-6 m-t-b-20" style="text-align: left">
                    <a href="/admin/users/roles/show">  <div class="btn btn-outline-danger " >

                     مشاهده سمت ها
                    </div></a>
                </div>
            </div>
                <form method="POST" action="/admin/users/roles/store">
                    {{csrf_field()}}
                <div class="col-md-4 m-t-b-20">
                    <label>افراد</label>

                    <div>
                        {{--{!! Form::select('permission_id[]',$permissions , null,['class'=>'multiselect','multiple'=>'multiple'] ) !!}--}}
                        {{--@if($errors->has('permission_id'))--}}
                        {{--<span style="color:red;font-size:13px">{{ $errors->first('permission_id') }}</span>--}}
                        {{--@endif--}}
                        <select name="user" id="user" class="select2 form-control">
                            @foreach($users as $user)

                                <option value="{{$user->id}}">{{$user->f_name}}
                                    -{{$user->l_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="col-md-12 m-t-b-20">
                        <label>دسترسی ها</label>

                        <div class="multi-select-full">
                            {{--{!! Form::select('permission_id[]',$permissions , null,['class'=>'multiselect','multiple'=>'multiple'] ) !!}--}}
                            {{--@if($errors->has('permission_id'))--}}
                            {{--<span style="color:red;font-size:13px">{{ $errors->first('permission_id') }}</span>--}}
                            {{--@endif--}}
                            <select name="role[]" class="multiselect-info"
                                    style="text-align: right"
                                    multiple="multiple">
                                @foreach($roles as $role)

                                    <option value="{{$role->id}}">{{$role->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-b-20">
                        <button class="btn btn-primary" type="submit">ثبت نقش
                        </button>
                    </div>
                </form>
            </div>
        </div>






    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')


@endsection
