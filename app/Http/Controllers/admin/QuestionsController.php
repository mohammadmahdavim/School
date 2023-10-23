<?php

namespace App\Http\Controllers\admin;

use App\dars;
use App\Http\Controllers\Controller;
use App\paye;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class QuestionsController extends Controller
{

    /**
     * SliderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    صفحه ایجاد نمونه سوال جدید  *
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paye = paye::all();
        $darses = dars::all()->unique('name');
        return view('Admin.questions.upload', compact('paye', 'darses'));
    }

    /*
   ایجاد نمونه سوال در دیتابیس و *
  هدایت به صفحه نمونه سوال های ایجاد شده*
   */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $jDate = Jalalian::now();
        $this->validate(request(),
            [
                'auther' => 'required',
                'price' => 'required',
                'file' => 'required|max:30720',
                'chapter' => 'required',
                'dars' => 'required',
                'paye' => 'required',
            ]
        );
        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();

        $film = new Question();
        $film->user_id = auth()->user()->id;
        $film->description = $request->description;
        $film->paye = $request->paye;
        $film->dars = $request->dars;
        $film->chapter = $request->chapter;
        $film->price = $request->price;
        $film->auther = $request->auther;
        $film->created_at = $jDate;
        $film->updated_at = $jDate;
        $film->mime = $mime;
        $film->original_filename = $original_filename;
        $film->filename = $filename;
        $film->created_at = Jalalian::now();
        $film->save();

        alert()->success('نمونه سوال شما با موفقیت ارسال شد', 'بارگذاری نمونه سوال')->autoclose(10000)->persistent('ok');
        return back();
    }

    /*
    نمایش صفحه نمونه سوال های ایجاد شده *
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $questions = DB::table('questions')->orderBy('created_at')->get();
        return view('Admin.questions.show', compact('questions'));
    }

    /*
     حذف نمونه سوال از دیتابیس*
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Delete($id)
    {
        $film = Question::where('id', $id)->first();
        $film->delete();
        alert()->success('نمونه سوال شما با موفقیت حذف شد', 'حذف نمونه سوال')->autoclose(2000)->persistent('ok');

        return back();
    }

}
