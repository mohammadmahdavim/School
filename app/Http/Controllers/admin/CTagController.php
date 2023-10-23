<?php

namespace App\Http\Controllers\admin;

use App\CTags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class CTagController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /*
     * صفحه ایجاد تگ
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creat()
    {

            return view('Admin.tag.create');
    }

    /*
     * ایجاد تگ جدید در دیتابیس
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {


//        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'name' => 'required',
        ]);


//        ایجاد تگ در جدول CTag
        $jDate = Jalalian::now();

        $id = CTags::create([
            'name' => request('name'),
            'place' => request('place'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;
        return redirect()->route('admin.Tag.show')->with('status', 'تگ شما با موفقیت ایجاد شد');
    }

    /*
     * مشاهده تگ های ایجاد شده
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $rows = CTags::all()->sortBy('created_at');
        return view('Admin.tag.view', compact('rows'));

    }

    /*
     * حذف تگ
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {
//        حذف از جدول Ctag
        $row = CTags::where('id', $id)->first();
        $row->delete();
        return back();
    }
}
