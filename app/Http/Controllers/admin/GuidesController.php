<?php

namespace App\Http\Controllers\admin;

use App\Home;
use App\HomeImage;
use App\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;
class GuidesController extends Controller
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
   صفحه ایجاد راهنمایی جدید  *
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creat()
    {
        return view('Admin.guides.create');
    }


    /*
     ایجاد راهنما در دیتابیس و *
    هدایت به صفحه راهنماهای ایجاد شده*
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'place' => 'required',
            'body' => 'required',
            'subject' => 'required',
        ]);


//        ایجاد ردیف در جدول home
        $jDate = Jalalian::now();
        $place = $request->place;
        $user_id = auth()->user()->id;
        $id = Home::create([
            'title' => request('subject'),
            'body' => request('body'),
            'place' => request('place'),
            'user_id' => auth()->user()->id,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);

        return redirect()->route('admin.Guides.show')->with('status', 'مطلب شما با موفقیت ایجاد شد');
    }

    /*
    نمایش صفحه راهنما های ایجاد شده *
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $rows = Home::where('place', 'پیام مشاوره ای')->orderby('created_at', 'desc')->get();
        return view('Admin.guides.view', compact('rows'));

    }

    /*
 مشاهده صفحه تکی راهنما *
  */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singlepage($id)
    {
        $row = Home::where('id', $id)->first();
        $time = $row->created_at;
        return view('Admin.guides.single', compact('row', 'time'));
    }


    /*
    صفحه ویرایش راهنما*
    */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $row = Home::where('id', $id)->first();
        $tags = Tags::where('matlab_id', $id)->pluck('tag');
        return view('Admin.guides.edit', compact('row', 'tags'));

    }

    /*
      آپدیت راهنما دیتابیس و هدایت به صفحه تکی همان راهنما*
     */
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        //        اعتبار سنجی اطلاعات ارسالی از فرم

        $this->validate(request(), [
            'body' => 'required',
            'subject' => 'required',
            'patchfile' => 'max:5240'
        ]);

//       ویرایش اطلاعات در جدول home
        $row = Home::where('id', $id)->first();
        $row->update([
            'title' => request('subject'),
            'body' => request('body'),
            'little_body' => request('littlebody'),
            'updated_at' => Jalalian::now(),
        ]);

        return redirect()->route('admin.Guides.singlepage', $id)->with('status', 'مطلب شما با موفقیت ویرایش شد');
    }

    public
    function destroy($id)
    {
        dd('d');
//        حذف از جدول home
        $row = Home::where('id', $id)->first();
        $row->delete();

        return back();
    }}
