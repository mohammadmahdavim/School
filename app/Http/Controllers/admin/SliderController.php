<?php


namespace App\Http\Controllers\admin;

use App\Home;
use App\HomeImage;
use App\Http\Controllers\Controller;
use App\Tags;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;

/**
 * Class SliderController
 * @package App\Http\Controllers\admin
 */
class SliderController extends Controller
{

    /**
     * SliderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    صفحه ایجاد اسلایدر جدید  *
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creat()
    {
            return view('Admin.slider.create');
    }


    /*
     ایجاد اسلایدر در دیتابیس و *
    هدایت به صفحه اسلایدر های ایجاد شده*
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
            'patchfile' => 'required|max:5240'
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
            $number=1;
            foreach ($images as $patchfile) {
                $cover = $patchfile;
                $filename = time() . '.' .$number. '.png';
                $path = public_path('/images/' . $filename);
                Image::make($cover->getRealPath())->resize(1280, 478)->save($path);
                $extension = $cover->getClientOriginalExtension();
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();
                $number=$number+1;

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

        return redirect()->route('admin.slider.show')->with('status', 'مطلب شما با موفقیت ایجاد شد');
    }

    /*
    نمایش صفحه اسلایدر های ایجاد شده *
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $rows = Home::where('place', 'اسلایدر')->orderby('created_at', 'desc')->get();
        return view('Admin.slider.view', compact('rows'));

    }

    /*
  مشاهده صفحه تکی اسلایدر *
   */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singlepage($id)
    {
        $row = Home::where('id', $id)->first();
        $time = $row->created_at;
        return view('Admin.slider.single', compact('row', 'time'));
    }

    /*
     صفحه ویرایش اسلایدر*
     */
    /**
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $row = Home::where('id', $id)->first();
        $tags = Tags::where('matlab_id', $id)->pluck('tag');
        alert()->warning('برای نگه داشتن عکس های قبلی تیک کنار عکس رابزنید', 'توجه')->autoclose(2000000);

        return view('Admin.slider.edit', compact('row', 'tags'));

    }

    /*
      آپدیت اسلایدر دیتابیس و هدایت به صفحه تکی همان اسلایدر*
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

//        جداکردن عکس هایی که تیک زده شده است.
        $keys = array_keys($request->all());
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

        return redirect()->route('admin.slider.singlepage', $id)->with('status', 'مطلب شما با موفقیت ویرایش شد');
    }

    /*
     حذف اسلایدر از دیتابیس*
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {

//        حذف از جدول   home
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

}
