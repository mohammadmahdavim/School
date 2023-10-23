<?php

namespace App\Http\Controllers\admin;

use App\Home;
use App\HomeImage;
use App\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;

class VideoController extends Controller
{


    public function index()
    {
        $rows=Home::where('place','ویدیو')->get();
        return view('Admin.video.view',compact('rows'));
    }
    /*
  * صفحه ایجاد گالری تصویر جدید
  */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creat()
    {
        return view('Admin.video.create');
    }

    /*
      ایجاد گالری جدید در دیتابیس و *
     هدایت به صفحه گالری های ایجاد شده*
      */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {

//        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'place' => 'required',
            'subject' => 'required',
            'file' => 'required',
        ]);

        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/videos');
        $cover->move($path, $filename);
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();
//        ایجاد اسلایدر در جدول home
        $jDate = Jalalian::now();
        $place = $request->place;
        $user_id = auth()->user()->id;
        $id = Home::create([
            'title' => request('subject'),
            'body' => request('body'),
            'place' => request('place'),
            'file' => $filename,
            'user_id' => auth()->user()->id,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;

        alert()->warning('ویدیو با موفقیت آلود شد.');
        return redirect('admin/video/index');
    }

    function destroy($id)
    {

//        حذف از جدول home
        $row = Home::where('id', $id)->first();
        $row->delete();


        return back();
    }

    public function download($id)
    {
        $home=Home::find($id);
        $filepath = public_path('videos/'.$home->file);
        return Response::download($filepath);
    }
}
