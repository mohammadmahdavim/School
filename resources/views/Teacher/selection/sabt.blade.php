@extends('layouts.teacher')
@section('css')

    <style>
        hr {
            border-top: 2px dashed red;
        }
    </style>
@endsection('css')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3> {{$selection->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">انتخابات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$selection->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
          <div class="row">
              <div class="col-md-6">
                  <h5> عنوان: {{$selection->title}}</h5>
                  <p>توضیحات:  {!! $selection->description !!}</p>
              </div>
              <div class="col-md-6">
                  @if(!empty($selection->file) )
                      <img src="{{url('images/'.$selection->file)}}" alt="Cinque Terre" width="500"
                           height="200">
                  @else
                      <span>عکسی وجود ندارد</span>
                  @endif
              </div>
          </div>

            <form action="/student/selection/store" method="post">

                {{csrf_field()}}
                @include('Admin.errors')
                <input name="selection_id" value="{{$selection->id}}" hidden>
                <div class="media-body table-responsive">
                    <br>
                    <hr>
                    <label> گزینه ها</label>
                    <table id="example1" class="table  table-striped table-bordered ">
                        <thead>
                        <tr style="text-align: center">
                            <th>شمارنده</th>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>تصویر</th>
                            <th>انتخاب</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $idn = 1;
                        ?>
                        @foreach($selection->option as $option)
                            <tr class="form-group" style="text-align: center">
                                <td style="text-align: center">{{$idn}}</td>
                                <td>{{$option->name}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary m-l-5 m-t-5" data-toggle="modal"
                                            data-target="#description{{$option->id}}">مودال خیلی بزرگ
                                    </button>
                                    <div class="modal fade text-right" tabindex="-1" role="dialog"
                                         id="description{{$option->id}}" aria-labelledby="myLargeModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">توضیحات</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $option->description !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">بستن
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td class="table-inbox-attachment">
                                    @if(!empty($option->file) )
                                        <img src="{{url('images/'.$option->file)}}" alt="Cinque Terre" width="80"
                                             height="80">
                                    @else
                                        <span>عکسی وجود ندارد</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" name="option[]" value="{{$option->id}}">
                                </td>


                            </tr>
                            <?php $idn = $idn + 1 ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group , col-md-12">

                    <br>
                    <button class="btn btn-info" type="submit">ثبت و ذخیره
                    </button>

                </div>

            </form>
        </div>
    </div>
    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('content')
@section('script')


@endsection('script')



