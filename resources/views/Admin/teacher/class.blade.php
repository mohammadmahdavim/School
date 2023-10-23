@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش {{config('global.teachers')}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5>اضافه کردن کلاس و درس جدید</h5>
            <form action="/admin/teacher/addclass" method="POST">
                {{csrf_field()}}
                @include('Admin.errors')

                <input name="teacher" value="{{$id}}" hidden>
                <div class="row">
                    <div class="col-md-5">
                        <br>
                        <h6><label>کلاس {{config('global.teacher')}}</label></h6>
                        <select name="class" class="form-control" style="text-align: right">
                            @foreach($class as $cls)
                                <option style="text-align: right" value="{{$cls->classnamber}}">
                                    دسته {{$cls->paye}}
                                    / کلاس {{$cls->classnamber}} /{{$cls->description}}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-5">
                        <h6><label>درس {{config('global.teacher')}}</label></h6>
                        <a class="btn btn-sm btn-success" href="#" onclick="return selectAll('s1', true)">Select All</a>
                        <a class="btn btn-sm btn-danger" href="#" onclick="return selectAll('s1', false)">DeSelect All</a>

                        <select id="s1" name="dars[]" multiple class="js-example-basic-single" style="text-align: right">
                            @foreach($dars as $darse)
                                <option style="text-align: right" value="{{$darse->id}}">
                                    دسته {{$darse->paye}}
                                    / درس {{$darse->name}}
                                    / رشته {{$darse->reshte}}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6><label></label></h6>
                        <h6><label></label></h6>
                        <br>
                        <button class="btn btn-info btn-block" type="submit">ذخیره و ارسال
                        </button>


                    </div>
                </div>

            </form>
            <br>
            <br>
            <hr>
            <div class="tab-content">
                <div class="table-responsive">

                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <br>
                        <table class="table" id="myTable">
                            <thead>
                            <tr class="info">
                                <th> کلاس</th>
                                <th>درس</th>
                                <th>حذف</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rowclass as $user )

                                <tr>


                                    <td>
                                        {{$user->class[0]->paye}}-{{$user->class[0]->classnamber}}
                                    </td>
                                    <td>
                                        {{$user->darss[0]->paye}}-{{$user->darss[0]->name}}
                                    <td>
                                        <div>

                                            <button class="btn btn-danger" onclick="deleteData({{$user->id}})">حذف
                                            </button>


                                        </div>

                                    </td>


                                </tr>

                            @endforeach
                            <script src="/js/sweetalert.min.js"></script>
                            @include('sweet::alert')
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection('content')

<script>
    function selectAll(id, isSelected) {

        //alert("id="+id+" selected? "+isSelected);
        var selectObj=document.getElementById(id);
        //alert("obj="+selectObj.type);
        var options=selectObj.options;
        //alert("option length="+options.length);
        for(var i=0; i<options.length; i++) {
            options[i].selected=isSelected;
        }
    }
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
                        url: "{{  url('/admin/teacher/destroyclass')  }}" + '/' + id,
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
