@extends('layouts.admin')
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
            <h5 class="card-title">ایجاد برنامه جدید</h5>
            <form action="/admin/tagvim/teacher/store" method="post">
                @csrf
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-3">
                        <label>{{config('global.teacher')}}</label>
                        <select class="form-control" name="user_id">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->f_name}}-{{$teacher->l_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>کلاس و درس</label>
                        <select class="js-example-basic-single" name="class_id">
                            @foreach($class as $clas)
                                @if($clas->darss!='[]')

                                    <option value="{{$clas->id}}">{{$clas->class_id}}-{{$clas->darss[0]->name}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>روز</label>
                        <select class="form-control" name="day">@foreach($days as $day)
                                <option value="{{$day->id}}">{{$day->name}}</option>@endforeach</select>
                    </div>
                    <div class="col-md-3">
                        <label>زمان</label>
                        <select class="form-control" name="time">@foreach($parts as $part)
                                <option title="{{$part->start}}-{{$part->end}}" value="{{$part->id}}">{{$part->name}}</option>@endforeach
                        </select>
                    </div>


                    <div class="col-md-12">
                        <br>

                        <button type="submit" class="btn btn-primary">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="media-body table-responsive">
                <br>
                <table id="example1" class="table  table-striped table-bordered ">
                    <thead>
                    <tr style="text-align: center">
                        <td>{{config('global.teacher')}}</td>
                        <td>کلاس</td>
                        <td>درس</td>
                        <td>روز</td>
                        <td>ساعت</td>
                        <td>ویرایش</td>
                        <td>حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($times as $time)
                        <tr style="text-align: center">
                            <td>{{$time->user->f_name}}-{{$time->user->l_name}}</td>
                            <td>{{$time->class_id}}</td>
                            <td>{{$time->dars->name}}</td>
                            <td>{{$time->days->name}}</td>
                            <td>{{$time->times->start}}-{{$time->times->end}} ({{$time->times->name}})</td>
                            <td>
                                <button type="button" class="btn btn-primary m-l-5 m-t-5" data-toggle="modal"
                                        data-target="#mark-{{$time->id}}">ویرایش
                                </button>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                     id="mark-{{$time->id}}" aria-labelledby="myLargeModalLabel{{$time->id}}"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ویرایش</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/admin/tagvim/teacher/edit/{{$time->id}}" >
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>{{config('global.teacher')}}</label>
                                                            <select class="form-control" name="user_id">
                                                                @foreach($teachers as $teacher)
                                                                    <option @if($teacher->id==$time->user_id) selected @endif value="{{$teacher->id}}">{{$teacher->f_name}}-{{$teacher->l_name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>کلاس و درس</label>
                                                            <select class="js-example-basic-single" name="class_id">
                                                                @foreach($class as $clas)
                                                                    @if($clas->darss!='[]')
                                                                        <option @if($clas->class_id==$time->class_id && $clas->dars==$time->dars_id) selected @endif value="{{$clas->id}}">{{$clas->class_id}}-{{$clas->darss[0]->name}}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>روز</label>
                                                            <select class="form-control" name="day">@foreach($days as $day)
                                                                    <option @if($day->id==$time->day) selected @endif  value="{{$day->id}}">{{$day->name}}</option>@endforeach</select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>زمان</label>
                                                            <select class="form-control" name="time">@foreach($parts as $part)
                                                                    <option @if($part->id==$time->time) selected @endif title="{{$part->start}}-{{$part->end}}" value="{{$part->id}}">{{$part->name}}</option>@endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <br>

                                                            <button type="submit" class="btn btn-primary">
                                                                ثبت
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-danger btn-rounded" onclick="deleteData({{$time->id}})"><i
                                        class="ti-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection('content')
<script>
    function deleteData(id) {

        swal({
            title: "آیا از حذف مطمئن هستید؟",
            text: "اگر حذف شود تمام دیتای مرتبط با آن حذف می گردد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/tagvim/teacher/delete')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "حذف با موفقیت انجام شد!",
                                icon: "success",

                            });
                            window.location.reload(true);
                        },
                        error: function () {
                            swal({
                                title: "خطا...",
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })

                        }
                    });
                } else {
                    swal("عملیات حذف لغو گردید");
                }
            });

    }
</script>



