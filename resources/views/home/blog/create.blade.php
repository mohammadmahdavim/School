@extends('layouts.home')

@section('main')
    <!-- Main Content -->
    <main class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center">ایجاد وبلاگ شما</h4>
                        <form method="POST" action="/blogs/store" enctype="multipart/form-data">
                            @csrf
                            @include('errors')
                            <div class="form-group col-md-5">
                                <label>عنوان</label>
                                <input type="text" class="form-control" id="title"
                                       name="title" placeholder="عنوان را وارد کنید" required>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">متن</h5>
                                <textarea name="body" id="editor-demo3"></textarea>
                            </div>
                            <div class="col-md-12">
                                <h5 class="card-title">آپلود تصویر برای مطلب</h5>
                                <input type="file" name="pic">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <h5 class="card-title"> نام نویسنده</h5>
                                    @if(\Auth::check())
                                        <input name="name" id="name"
                                               value="{{auth()->user()->f_name}}-{{auth()->user()->l_name}}">
                                    @else
                                        <input name="name" id="name" type="text">

                                    @endif

                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <h5 class="card-title">نقش</h5>
                                    <select name="role" id="role">
                                        @if(\Auth::check())
                                            <option>{{auth()->user()->role}}</option>
                                        @else
                                            <option>{{config('global.student')}}</option>
                                            <option>{{config('global.teacher')}}</option>
                                            <option>{{config('global.parent')}}</option>
                                            <option>کادر {{config('global.school')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-rounded btn-block">ثبت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!--// Main Content -->


@endsection('main')
