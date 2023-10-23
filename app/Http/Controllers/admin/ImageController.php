<?php

namespace App\Http\Controllers\admin;

use App\Home;
use App\HomeImage;
use App\Http\Controllers\Controller;
use App\Tags;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;

class ImageController extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * صفحه ایجاد گالری تصویر جدید
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creat()
    {
        return view('Admin.image.create');
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
        ]);


//        ایجاد اسلایدر در جدول home
        $jDate = Jalalian::now();
        $place = $request->place;
        $user_id = auth()->user()->id;
        $id = Home::create([
            'title' => request('subject'),
            'body' => request('body'),
            'place' => request('place'),
            'little_body' => request('littlebody'),
            'user_id' => auth()->user()->id,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;


//        ایجاد فایل مناسب برای عکس ها
        $images = $request->file('patchfile');
        if (!empty($request->patchfile)) {
            foreach ($images as $patchfile) {
                $cover = $patchfile;
                $filename = time() . '.' . '.png';
                $path = public_path('/images/' . $filename);
                Image::make($cover->getRealPath())->resize(800, 550)->save($path);
                $extension = $cover->getClientOriginalExtension();
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();


//  ایجاد یک ردیف برای ذخیره عکس در جدول imagehome
                $imag = HomeImage::create([
                    'matlab_id' => $id,
                    'mime' => $mime,
                    'original_filename' => $original_filename,
                    'filename' => $filename,
                    'resize_image' => $filename,
                ]);
            }
        }


// ذخیره تگ های مربوط به این پست در جدول tags
        $tags = $request->tag;
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $matlabtags = Tags::create([
                    'matlab_id' => $id,
                    'place' => $place,
                    'tag' => $tag,
                ]);
            }
        }
        alert()->warning('لطفا تصاویر مربوطه را آپلود کنید');
        return view('Admin.image.img', compact('id'));
    }

    /*
  نمایش صفحه گالری های ایجاد شده *
   */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $rows = Home::where('place', 'گالری تصویر')->orderby('created_at', 'desc')->get();
        return view('Admin.image.view', compact('rows'));

    }

    /*
  مشاهده صفحه تکی گالری ها *
   */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singlepage($id)
    {
        $row = Home::where('id', $id)->first();
        $time = $row->created_at;
        return view('Admin.image.single', compact('row', 'time'));
    }


    /*
  صفحه ویرایش گالری *
   */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $row = Home::where('id', $id)->first();
        $tags = Tags::where('matlab_id', $id)->pluck('tag');
        alert()->warning('برای نگه داشتن عکس های قبلی تیک کنار عکس رابزنید', 'توجه')->autoclose(2000000);

        return view('Admin.image.edit', compact('row', 'tags'));

    }


    /*
      آپدیت گالری در دیتابیس و هدایت به صفحه تکی همان گالری*
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
            'subject' => 'required',
            'patchfile' => 'max:5240'
        ]);


//        جداکردن عکس هایی که تیک زده شده است.
        $keys = array_keys($request->all());
//        return $keys;
        $k = 0;
        $imageid = [];

        foreach ($keys as $key) {
            $part = explode('-', $key);
            $name = $part[0];
            if ($name == 'image') {
                $imageid[] = $part[1];

            }
            $k += 1;
        }

//        return $imageid;

//        حذف عکس هایی که تیک ندارند از جدول tags
            $images = HomeImage::where('matlab_id', $id)->whereNotin('id', $imageid)->get();
        if (count($images) > 0) {
            foreach ($images as $image) {
                $image->delete();
            }

        }
//        حذف تگ های قبلی از جدول tags
        $tags = Tags::where('matlab_id', $id)->get();
        foreach ($tags as $tag) {
            $tag->delete();
        }


//       ویرایش اطلاعات در جدول home
        $row = Home::where('id', $id)->first();
        $row->update([
            'title' => request('subject'),
            'body' => request('body'),
            'little_body' => request('littlebody'),
            'updated_at' => Jalalian::now(),
        ]);


        //        ایجاد فایل مناسب برای عکس ها
        $images = $request->file('patchfile');
        if (!empty($request->patchfile)) {
            foreach ($images as $patchfile) {
                $cover = $patchfile;
                $filename = time() . '.' . '.png';
                $path = public_path('/images/' . $filename);
                Image::make($cover->getRealPath())->resize(800, 550)->save($path);
                $extension = $cover->getClientOriginalExtension();
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();


//  ایجاد یک ردیف برای ذخیره عکس در جدول imagehome
                $imag = HomeImage::create([
                    'matlab_id' => $id,
                    'mime' => $mime,
                    'original_filename' => $original_filename,
                    'filename' => $filename,
                    'resize_image' => $filename,
                ]);
            }
        }


        // ذخیره تگ های جدید مربوط به این پست در جدول tags

        $tags = $request->tag;
        $place = Home::where('id', $id)->first();
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $matlabtags = Tags::create([
                    'matlab_id' => $id,
                    'place' => $place->place,
                    'tag' => $tag,
                ]);
            }
        }

        return redirect()->route('admin.Image.singlepage', $id)->with('status', 'مطلب شما با موفقیت ویرایش شد');

    }


    /*
     حذف گالری در دیتابیس و برگشت به صفحه قبل     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {

//        حذف از جدول home
        $row = Home::where('id', $id)->first();
        $row->delete();


//        حذف از جدول imagehome
        $images = HomeImage::where('matlab_id', $id)->get();
        foreach ($images as $image) {
            $image->delete();
        }


//        حذف از جدول tags
        $tags = Tags::where('matlab_id', $id)->get();
        foreach ($tags as $tag) {
            $tag->delete();
        }


        return back();
    }

    /*
     * هدایت به صفحه آپلود تصاویر (dropbox)
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeimg(Request $request)
    {
        $patchfile = $request->file('file');
        $cover = $patchfile;
        $filename = time() . '.' . '.png';
        $path = public_path('/images/' . $filename);
        Image::make($cover->getRealPath())->resize(800, 550)->save($path);
        $extension = $cover->getClientOriginalExtension();
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();


//  ایجاد یک ردیف برای ذخیره عکس در جدول imagehome
        $imag = HomeImage::create([
            'matlab_id' => $request->id,
            'mime' => $mime,
            'original_filename' => $original_filename,
            'filename' => $filename,
            'resize_image' => $filename,
        ]);


        return response()->json([
            'id' => $imag->id
        ]);
    }

    public function destroyimg(Request $request)
    {
//        dd($request->filename);
        $filename = $request->get('filename');

        $row = HomeImage::where('original_filename', $filename)->first();;
        dd($request);
        $path = public_path('/profile_images/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
