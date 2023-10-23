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
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اولیا</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3" style="text-align: right">
                    <div class="panel-heading">
                        <h5 class="panel-title">ایجاد نقش جدید</h5>

                    </div>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3" style="text-align: left">
                    <a href="{{ url('admin/roles') }}" class="btn bg-blue btn-xs btn-icon">بازگشت به
                        مدیریت مجوز ها<i class="icon-backward"></i></a>
                </div>
            </div>
            <div class="row">
                <form method="POST" action="/admin/roles">
                    {{csrf_field()}}

                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <br>
                                <div class="form-group">
                                    <label>نام لاتین نقش</label>
                                    <input type="text" name="name" class="form-control" placeholder="مثال: admin">
                                </div>

                                <div class="form-group">
                                    <label>عنوان نقش</label>
                                    <input type="text" name="label" class="form-control" placeholder="مثال: مدیر">
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label>دسترسی ها</label>

                                        <div class="multi-select-full">
                                            {{--{!! Form::select('permission_id[]',$permissions , null,['class'=>'multiselect','multiple'=>'multiple'] ) !!}--}}
                                            {{--@if($errors->has('permission_id'))--}}
                                            {{--<span style="color:red;font-size:13px">{{ $errors->first('permission_id') }}</span>--}}
                                            {{--@endif--}}
                                            <select name="permission[]" class="multiselect-info"
                                                    style="text-align: right"
                                                    multiple="multiple">
                                                @foreach($permissions as $permission)

                                                    <option value="{{$permission->id}}">{{$permission->label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">ثبت نقش
                                    </button>
                                </div>
                            </div>

                        </div>


                    </div>
            </div>
        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')


@endsection
