<?php

namespace App\Http\Controllers\teacher;

use App\Archive;
use App\clas;
use App\dars;
use App\Film;
use App\FilmSection;
use App\Http\Controllers\Controller;
use App\teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class FilmController extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * صفحه آپلود مطلب(فیلم و ...)
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        if (auth()->user()->role == 'معلم') {

            $allclas = teacher::where('user_id', auth()->user()->id)->with('darss')->with('class')->get();
            $dars = dars::all();
            $section = FilmSection::find($id);
            $bakhshs = FilmSection::where('section_id', $id)->get();
            return view('Teacher.film.upload', compact('allclas', 'section', 'bakhshs', 'dars'));
        } else {
            return view('errors.404');
        }
    }

    /*
     * آپلود فایل در دیتابیس
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'معلم') {
            $jDate = Jalalian::now();
            $this->validate(request(),
                [
//                    'rowteacher' => 'required',
                    'auther' => 'required',
                    'file' => 'max:30720',
                    'title' => 'required',
                ]
            );
            if ($request->archive) {
                $archive = 1;
            } else {
                $archive = 0;
            }
            if ($request->file) {
                $cover = $request->file('file');
                $filename = time() . '.' . $cover->getClientOriginalExtension();
                $path = public_path('/images');
                $cover->move($path, $filename);
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();
            }
            if ($archive == 0) {

                foreach ($request->class as $class) {
                    $film = new Film();
                    $film->user_id = auth()->user()->id;
                    $film->description = $request->description;
                    $film->class_id = $class;
                    $film->dars = $request->dars_id;
                    $film->title = $request->title;
                    $film->chapter = $request->chapter;
                    $film->bakhsh = $request->bakhsh;
                    $film->auther = $request->auther;
                    $film->link = $request->link;
                    $film->created_at = $jDate;
                    $film->updated_at = $jDate;
                    if ($request->file) {

                        $film->mime = $mime;
                        $film->original_filename = $original_filename;
                        $film->filename = $filename;
                    }
                    $film->archive = $archive;
                    $film->save();
                }
            } else {
                $film = new Film();
                $film->user_id = auth()->user()->id;
                $film->description = $request->description;
                $film->title = $request->title;
                $film->chapter = $request->chapter;
                $film->bakhsh = $request->bakhsh;
                $film->auther = $request->auther;
                $film->link = $request->link;
                $film->created_at = $jDate;
                $film->updated_at = $jDate;
                if ($request->file) {
                    $film->mime = $mime;
                    $film->original_filename = $original_filename;
                    $film->filename = $filename;
                }
                $film->archive = $archive;
                $film->save();
            }


            alert()->success('مطلب شما با موفقیت ارسال شد', 'بارگذاری مطلب')->autoclose(10000)->persistent('ok');

            return back();
        } else {
            return view('errors.404');
        }
    }

    /*
     * مشهاده مطالب آپلود شده درس محور
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outbox($idc, $id)
    {
        if (auth()->user()->role == 'معلم') {

            $films = Film::where('class_id', $idc)->where('dars', $id)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return view('Teacher.film.outbox', compact('films', 'id'));
        } else {
            return view('errors.404');
        }
    }

    /*
     * صفحه تکی
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        if (auth()->user()->role == 'معلم') {

            $film = Film::where('id', $id)->first();
            $namedars = dars::where('id', $film->dars)->pluck('name')->first();
            return view('Teacher.film.show', compact('film', 'id', 'namedars'));
        } else {
            return view('errors.404');
        }
    }

    /*
     صفحه ویرایش مطلب آپلودشده*
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edite($id)
    {

        if (auth()->user()->role == 'معلم') {
            $film = Film::where('id', $id)->first();
            $allclas = teacher::where('user_id', auth()->user()->id)->with('darss')->with('class')->get();

            $filmdars = dars::where('id', $film->dars)->first();
            return view('Teacher.film.edite', compact('allclas', 'film', 'filmdars'));
        } else {
            return view('errors.404');
        }
    }

    /*
     * ویرایش مطلب آپلود شده در دیتابیس
     */
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role == 'معلم') {
            $rowteacher = teacher::where('id', $request->rowteacher)->first();

            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            $jDate = Jalalian::now();
            $this->validate(request(),
                [
                    'rowteacher' => 'required',
                    'auther' => 'required',
                    'file' => 'max:10240',
                    'chapter' => 'required',
                    'title' => 'required',
                ]
            );
            if ($request->archive) {
                $archive = 1;
            } else {
                $archive = 0;
            }
            if ($request->pfile == 'on') {

                $film = Film::where('id', $id)->first();

                if ($archive == 0) {
                    $film->update([
                        'description' => $request->description,
                        'title' => $request->title,
                        'price' => $request->price,
                        'chapter' => $request->chapter,
                        'bakhsh' => $request->bakhsh,
                        'auther' => $request->auther,
                        'link' => $request->link,
                        'updated_at' => $jDate,
                        'class_id' => $rowteacher->class_id,
                        'dars' => $rowteacher->dars,
                        'archive' => $archive,
                    ]);
                } else {
                    $film->update([
                        'description' => $request->description,
                        'title' => $request->title,
                        'price' => $request->price,
                        'bakhsh' => $request->bakhsh,
                        'chapter' => $request->chapter,
                        'auther' => $request->auther,
                        'link' => $request->link,
                        'updated_at' => $jDate,
                        'archive' => $archive,


                    ]);
                }

            } else {
                $this->validate(request(),
                    [

                        'file' => 'required|max:10240',

                    ]
                );


                $cover = $request->file('file');
                $filename = time() . '.' . $cover->getClientOriginalExtension();
                $path = public_path('/images');
                $cover->move($path, $filename);
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();

                $film = Film::where('id', $id)->first();

                $film->update([
                    'description' => $request->description,
                    'title' => $request->title,
                    'price' => $request->price,
                    'chapter' => $request->chapter,
                    'auther' => $request->auther,
                    'link' => $request->link,
                    'class_id' => $rowteacher->class_id,
                    'dars' => $rowteacher->dars,
                    'updated_at' => $jDate,
                    'mime' => $mime,
                    'original_filename' => $original_filename,
                    'filename' => $filename,
                ]);


            }

            alert()->success('مطلب شما با موفقیت ویرایش شد', ' ویرایش مطلب')->autoclose(10000)->persistent('ok');

            return back();
        } else {
            return view('errors.404');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function Delete($id)
    {
        if (auth()->user()->role == 'معلم') {

            $film = Film::where('id', $id)->first();
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            if ($teacher->dars = $film->dars) {
                $film->delete();
                alert()->success('مطلب شما با موفقیت حذف شد', 'حذف مطلب')->autoclose(2000)->persistent('ok');
            }
            return back();
        } else {
            return view('errors.404');
        }
    }


//    archive
    public function archive()
    {
        if (auth()->user()->role == 'معلم') {

            $rows = Film::where('archive', 1)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

            return view('Teacher.film.archive', compact('rows'));
        } else {
            return view('errors.404');
        }
    }

    public function sync($id)
    {
        $allclass = teacher::where('user_id', auth()->user()->id)->with('class')->get();
        $teacclass = teacher::where('user_id', auth()->user()->id)->pluck('class_id');
        $allstudents = User::where('role', 'دانش آموز')->whereIn('class', $teacclass)->orderBy('class')->get();
        $syncs = Archive::where('model', 'Film')->where('item_id', $id)->get();
        $item = Film::where('id', $id)->first();
        return view('Teacher.film.sync', compact('allclass', 'allstudents', 'syncs', 'item'));
    }

}
