<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class EducationalController extends Controller
{
    public function index()
    {

        return view('Admin.educational.upload');
    }

    public function store(Request $request)
    {

        $jDate = Jalalian::now();
        $this->validate(request(),
            [
                'file' => 'required|max:30720',
                'title' => 'required',
            ]
        );

        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();

        $film = new Film();
        $film->class_id = clas::pluck('id')->first();
        $film->user_id = auth()->user()->id;
        $film->description = $request->description;
        $film->dars = 0;
        $film->title = $request->title;
        $film->chapter = 0;
        $film->price = 0;
        $film->auther = auth()->user()->id;
        $film->created_at = $jDate;
        $film->updated_at = $jDate;
        $film->mime = $mime;
        $film->original_filename = $original_filename;
        $film->filename = $filename;
        $film->save();

        alert()->success('مطلب شما با موفقیت ارسال شد', 'بارگذاری مطلب')->autoclose(10000)->persistent('ok');

        return back();

    }

    public function outbox()
    {
        $films = Film::where('dars', 0)->orderBy('created_at', 'desc')->get();

        return view('Admin.educational.outbox', compact('films'));
    }

    public function show($id)
    {
        $film = Film::where('id', $id)->first();
        return view('Admin.educational.show', compact('film'));
    }

    public
    function Delete($id)
    {
        $film = Film::where('id', $id)->first();
        $film->delete();
        alert()->success('مطلب شما با موفقیت حذف شد', 'حذف مطلب')->autoclose(2000)->persistent('ok');
        return back();
    }


}
