@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')

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
                    <li class="breadcrumb-item"><a href="#">کلاس</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr class="danger" style="text-align: center">
                            <th>مقطع</th>
                            <th>رشته</th>
                            <th>پایه</th>
                            <th>شماره کلاس</th>
                            <th>توضیحات</th>
                            <th>ویرایش</th>
                            <th>حذف</th>

                        </tr>
                        </thead>
                        <tbody>

                        @include('Admin.errors')
                        @foreach($claas as $clas )
                            <form action="{{url('/admin/class/edite').'/'.$clas->id}}" method="post">
                                {{csrf_field()}}

                                @method('put')

                                {{--<td><a href="{{$article->path}}"> {{$article->title}}</a></td>--}}
                                <tr style="text-align: center">
                                    <td>
                                        <select type="text" id="magta" class="input-group-text " dir="rtl" name="magta">
                                            <option>{{$clas->magta}}</option>

                                            <option>ابتدایی</option>
                                            <option>متوسطه1</option>
                                            <option>متوسطه2</option>
                                            <option>هنرستان</option>
                                            <option>آموزشگاه</option>
                                            <option>دانشگاه</option>
                                            <option>باشگاه</option>
                                        </select>
                                    </td>
                                    <td><select class="form-control" dir="rtl" style="text-align: center"
                                                id="reshte" name="reshte">
                                            <option>{{$clas->reshte}}</option>
                                            <option>بدون رشته</option>
                                            <option>ریاضی</option>
                                            <option>تجربی</option>
                                            <option>انسانی</option>
                                        </select>
                                    </td>
                                    <td><select class="input-group-text " dir="rtl" style="text-align: center" id="paye"
                                                name="paye">
                                            <option>{{$clas->paye}}</option>
                                            @foreach($paye as $p)
                                                <option>{{$p->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><select class="form-control" dir="rtl" style="text-align: center"
                                                id="classnamber" name="classnamber">
                                            <option>{{$clas->classnamber}}</option>
                                            @foreach($claass as $claasss)
                                                <option>{{$claasss}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input class="input-group-text " dir="rtl" style="text-align: center"
                                               value="{{$clas->description}}"
                                               id="description" name="description"></td>

                                    <td>
                                        <div>
                                            <button class="btn btn-info" type="submit">ثبت تغییرات</button>
                                        </div>

                                    </td>
                            </form>
                            <td>
                                <div>
                                    <button class="btn btn-danger" onclick="deleteData({{$clas->id}})">حذف</button>
                                </div>
                            </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
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
                        url: "{{  url('/admin/class/destroy/')  }}" + '/' + id,
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
