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
            <form action="/admin/tagvim/student/store" method="post">
                @csrf
                @include('Admin.errors')
                <div class="row">
                    <div class="col-md-4">
                        <label>کلاس</label>
                        <select class="js-example-basic-single" name="class_id">
                            @foreach($class as $clas)
                                <option value="{{$clas->classnamber}}">{{$clas->classnamber}}-{{$clas->paye}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>دروس</label>
                        <select class="js-example-basic-single" name="dars_id">
                            @foreach($doros as $dars)
                                <option value="{{$dars->id}}">{{$dars->name}}-{{$dars->paye}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>روز</label>
                        <select class="form-control" name="day">@foreach($days as $day)
                                <option value="{{$day->id}}">{{$day->name}}</option>@endforeach</select>
                    </div>
                    <div class="col-md-4">
                        <label>زمان</label>
                        <select class="form-control" name="time">@foreach($parts as $part)
                                <option title="{{$part->start}}-{{$part->end}}"
                                        value="{{$part->id}}">{{$part->name}}</option>@endforeach
                        </select>
                    </div>


                    <div class="col-md-4">
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
                    <tr>
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
                        <tr>
                            <td>{{$time->class_id}}</td>
                            <td>{{$time->dars->name}}-{{$time->dars->paye}}</td>
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
                                                    <form action="/admin/tagvim/student/edit/{{$time->id}}" >
                                                        @csrf
                                                        @include('Admin.errors')
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>کلاس</label>
                                                                <select class="js-example-basic-single" name="class_id">
                                                                    @foreach($class as $clas)
                                                                        <option
                                                                            @if($time->class_id==$clas->classnamber) selected
                                                                            @endif value="{{$clas->classnamber}}">{{$clas->classnamber}}
                                                                            -{{$clas->paye}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>دروس</label>
                                                                <select class="js-example-basic-single" name="dars_id">
                                                                    @foreach($doros as $dars)
                                                                        <option @if($time->dars_id==$dars->id) selected
                                                                                @endif value="{{$dars->id}}">{{$dars->name}}
                                                                            -{{$dars->paye}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>روز</label>
                                                                <select class="form-control"
                                                                        name="day">@foreach($days as $day)
                                                                        <option @if($time->day==$day->id) selected
                                                                                @endif value="{{$day->id}}">{{$day->name}}</option>@endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>زمان</label>
                                                                <select class="form-control"
                                                                        name="time">@foreach($parts as $part)
                                                                        <option  @if($time->time==$part->id) selected
                                                                                 @endif title="{{$part->start}}-{{$part->end}}"
                                                                                value="{{$part->id}}">{{$part->name}}</option>@endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary">
                                                                    ثبت
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">بستن
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                                </div>
                                            </div>
                                        </form>
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
                        url: "{{  url('/admin/tagvim/student/delete')  }}" + '/' + id,
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



