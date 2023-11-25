@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">

@endsection('css')
@section('script')
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script>
        jQuery(document).ready(function () {
            jQuery('#hideshow').on('click', function (event) {
                jQuery('#search').toggle('show');
            });
        });
    </script>
    <script src="/js/num2persian-min.js"></script>
    <script src="/js/number-divider.min.js"></script>
    <script>

        $(document).on('focus', '.price-box-product input', function () {
            var boxPrice = $(this).siblings('.price-box-product-content');
            boxPrice.fadeIn(100);
            boxPrice.find('.price-box-numbers').html($(this).val())
            boxPrice.find('.price-box-numbers').divide({
                delimiter: ',',
                divideThousand: false
            });
            var e = this;
            this.nextSibling.nextElementSibling.children[3].childNodes[1].nextElementSibling.innerHTML = e.value
                .toPersianLetter()
            e.oninput = myHandler;
            e.onpropertychange = e.oninput; // for IE8
            function myHandler() {
                this.nextSibling.nextElementSibling.children[3].childNodes[1].nextElementSibling.innerHTML = e.value
                    .toPersianLetter();
            }
        });

        $(document).on('click', '.price-box-product-content button.close', function () {
            $(this).parents('.price-box-product-content').fadeOut(100);
        })

        $(document).on('blur', '.price-box-product input', function () {
            $(this).siblings('.price-box-product-content').fadeOut(100);
        });

        $(document).on('keyup', '.price-box-product input', function () {
            var boxPrice = $(this).siblings('.price-box-product-content');
            boxPrice.find('.price-box-numbers').html($(this).val());
            boxPrice.find('.price-box-numbers').divide({
                delimiter: ',',
                divideThousand: false
            });
        });
    </script>
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>لیست</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">محصول ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmaterial">
                <i class="fa fa-plus"></i>
                &nbsp;
            </button>
            <div class="modal fade" id="addmaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعریف محصول جدید</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/admin/products" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <label>نام</label>
                                        <input class="form-control" name="title" required>
                                    </div>
                                    <div class="col-md-3" >
                                        <label>قیمت(ریال)</label>
                                        <div class="price-box-product">

                                            <input required type="number" name="price" id="price" class="form-control">
                                            <div class="price-box-product-content">
                                                <div
                                                    class="price-box-header-product d-flex justify-content-between align-items-center">
                                                    <span>وضعیت مبلغ شما</span>
                                                    <button class="close"><i
                                                            class="ion-android-close"></i></button>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-secondary ml-2">به عدد:</span>
                                                    <span class="price-box-numbers ml-2">
                                                                        </span>
                                                    <span class="text-dark">ریال</span>
                                                </div>

                                                <hr>
                                                <div class="d-flex align-items-center">
                                                                        <span class="text-secondary ml-2">به
                                                                            حروف:</span>
                                                    <span class="price-box-letters ml-2">
                                                                        </span>
                                                    <span class="text-dark">ریال</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <label>تصویر</label>
                                        <input class="form-control" name="image" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">ذخیره</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <input type='button' class="btn btn-success" id='hideshow' value='جستجو'>
            <a href="/admin/reserves"><button class="btn btn-success">رزروها</button></a>
            <div id='search' style="display: none">
                <form method="get" action="/admin/products">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <label>نام محصول</label>
                            <input type="text" autocomplete="off" name="name"
                                   value="{{request()->input('name')}}"
                                   class="form-control">
                        </div>


                        <div class="p-2">
                            <br>
                            <button type="submit" class="btn btn-info">جستجوکن</button>
                        </div>
                    </div>

                </form>
            </div>


            <!-- Modal -->
            <div class="">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">
                                @if($row->image)
                                    <img src="/product/{{$row->image}}" width="50" height="50" class="rounded">
                                @endif
                            </td>
                            <td style="text-align: center">{{$row->title}}</td>
                            <td style="text-align: center">{{$row->price}}</td>
                            <td style="text-align: center">

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#edit{{$row->id}}">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <div class="modal fade" id="edit{{$row->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">ویرایش
                                                    {{$row->title}}
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/admin/products/{{$row->id}}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                {{method_field('PATCH')}}

                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>نام</label>
                                                                <input class="form-control" name="title" required
                                                                       value="{{$row->title}}">
                                                            </div>
                                                            <div class="col-md-3" >
                                                                <label>قیمت</label>
                                                                <div class="price-box-product">

                                                                    <input required type="number" name="price" id="price"
                                                                           class="form-control" value="{{$row->price}}">
                                                                    <div class="price-box-product-content">
                                                                        <div
                                                                            class="price-box-header-product d-flex justify-content-between align-items-center">
                                                                            <span>وضعیت مبلغ شما</span>
                                                                            <button class="close"><i
                                                                                    class="ion-android-close"></i></button>
                                                                        </div>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="text-secondary ml-2">به عدد:</span>
                                                                            <span class="price-box-numbers ml-2">
                                                                        </span>
                                                                            <span class="text-dark">ریال</span>
                                                                        </div>

                                                                        <hr>
                                                                        <div class="d-flex align-items-center">
                                                                        <span class="text-secondary ml-2">به
                                                                            حروف:</span>
                                                                            <span class="price-box-letters ml-2">
                                                                        </span>
                                                                            <span class="text-dark">ریال</span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>تصویر</label>
                                                                <input class="form-control" name="image" type="file">
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">ذخیره
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn  btn-danger" onclick="deleteData({{$row->id}})"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                    </tr>
                    <?php $idn = $idn + 1 ?>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')
<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/admin/products/delete/')  }}" + '/' + id,
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


