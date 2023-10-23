@extends('layouts.admin')
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
            <h3>نتایج {{$row[0]->selection->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/teacher">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نتایج{{$row[0]->selection->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <th>شمارنده</th>
                        <th>عنوان</th>
                        <th>توضیحات</th>
                        <th>تعداد رای</th>
                        <th>تصویر</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $idn=1;
                    ?>
                    @foreach($row as $option)
                        <tr class="form-group" @if($idn<=$row[0]->selection->winner) style="text-align: center;background-color: #0d8d2d;color: black" @else style="text-align: center;background-color: red;color: black" @endif>
                            <td style="text-align: center">{{$idn}}</td>
                            <td>{{$option->name}}</td>
                            <td>{!! $option->description !!}</td>
                            <td>{{$option->value}}</td>
                            <td class="table-inbox-attachment">
                                @if(!empty($option->file) )
                                    <img src="{{url('images/'.$option->file)}}" alt="Cinque Terre" width="80"
                                         height="80">
                                @else
                                    <span>عکسی وجود ندارد</span>
                                @endif
                            </td>


                        </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">

                        <div class="panel-body">
                            <div>
                                <div class="row">
                                    <div class="panel-body">
                                        {!!$chartt->html() !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Charts::scripts() !!}
            {!! $chartt->script() !!}
        </div>
    </div>
@endsection('content')





