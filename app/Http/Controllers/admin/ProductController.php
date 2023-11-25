<?php

namespace App\Http\Controllers\admin;

use App\Models\Member;
use App\Product;
use App\Reserve;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $rows = Product::when($request->get('name'), function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->name . '%');
        })
            ->paginate(30);
        return view('Admin.product.index', compact('rows'));
    }

    public function store(Request $request)
    {

        $row = Product::create([
            'title' => $request->title,
            'price' => $request->price
        ]);
        $this->getUploadImage($request, $row, 'product');
        alert()->success('محصول با موفقت ایجاد شد.', 'عملیات موفق');

        return back();
    }


    public function update(Request $request, $id)
    {
        $row = Product::where('id', $id)->first();
        $row->update([
            'title' => $request->title,
            'price' => $request->price,
        ]);
        $this->getUploadImage($request, $row, 'product');
        alert()->success('محصول با موفقت ویرایش شد.', 'عملیات موفق');

        return back();
    }


    public function destroy($id)
    {
        $row = Product::where('id', $id)->first();
        $row->delete();
    }

    public function getUploadImage(Request $request, $row, $path): void
    {
        $file = $request->file('image');
        if ($file) {
            $filename = time() . '.png';
            $path = public_path($path . '/' . $filename);
            Image::make($file->getRealPath())->save($path);
            $row->update([
                'image' => $filename
            ]);
        }
    }

    public function reserves(Request $request)
    {
        $rows = Reserve::
        wherehas('product', function ($q) use ($request) {
            if ($request->name) {
                $q->where('title', 'like', '%' . $request->name . '%');
            }

        })
            ->when($request->get('code'), function ($query) use ($request) {
                $query->where('code', 'like', '%' . $request->code . '%');
            })
            ->when($request->input('date-picker-shamsi-list'), function ($query) use ($request) {
                $query->where('for_date', $request->input('date-picker-shamsi-list'));
            })
            ->paginate(50);
        return view('Admin.product.reserves', compact('rows'));
    }

    public function change_type(Request $request)
    {
        $row = Reserve::where('id', $request->id)->first();
        if ($request->type == 0) {
            $row->update([
                'used' => 0
            ]);
        } else {
            $row->update([
                'used' => 1
            ]);
        }
    }

    public function excel_reserve(Request $request)
    {
        $data = Reserve::
        wherehas('product', function ($q) use ($request) {
            if ($request->name) {
                $q->where('title', 'like', '%' . $request->name . '%');
            }

        })
            ->when($request->get('code'), function ($query) use ($request) {
                $query->where('code', 'like', '%' . $request->code . '%');
            })
            ->when($request->input('date-picker-shamsi-list'), function ($query) use ($request) {
                $query->where('for_date', $request->input('date-picker-shamsi-list'));
            })
            ->select('*')
            ->get();
        $list=[];
        foreach ($data as $d)
        {
            $list[]=[
                'دانش آموز'=>$d->user->f_name.' '.$d->user->l_name,
                'محصول'=>$d->product->title,
                'قیمت'=>$d->product->price,
                'پرداخت شده'=>$d->payed??0,
                'دریافت شده'=>$d->used??0,
                'رزرو برای تاریخ'=>$d->for_date,
                'کد'=>$d->code,
            ];
        }
//dd($list);
        return Excel::create('reserves', function ($excel) use ($list) {
            $excel->sheet('reserves', function ($sheet) use ($list) {
                $sheet->fromArray($list);
            });
        })->download('xlsx');
    }
}
