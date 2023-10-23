<?php

namespace App\Http\Controllers\teacher;

use App\CKarnameh;
use App\CMark;
use App\Http\Controllers\Controller;
use App\KarnamehAdmin;
use App\MarkItem;
use App\RKarnameh;
use App\SKarnameh;
use App\SMkarnameh;
use App\teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CKarnamehController extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * صفحه تولید کارنامه
     */
    /**
     * @param $idk
     * @param $idd
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($idk, $idc, $idd)
    {
        if (auth()->user()->role == 'معلم') {

            $id = auth()->user()->id;
            $items = DB::table('c_marks')->orderBy('created_at')->where('classid', $idc)->where('dars', $idd)->where('user_id', $id)->get();
            $namekarname = RKarnameh::where('id', $idk)->first()['name'];

            return view('Teacher.karnameh.create', compact('idc', 'namekarname', 'idd', 'items', 'idk', 'idc'));
        } else {
            return view('errors.404');
        }
    }

    /*
     * تولید کار نامه به همراه اعتبار سنجی های لازم و هدایت بهصفحه پیش نمایش کارنامه
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $idc = $request->idclass;
        $idk = $request->idkarnameh;
        $darsid = $request->iddars;

        $name = RKarnameh::where('id', $request->idkarnameh)->first()['name'];
        if (auth()->user()->role == 'معلم') {

//            validate 100%
            $i = 0;
            $percent = 0;
            $keys = array_keys($request->all());
            foreach ($keys as $key) {

                if ($i != 0 && $i != 1 && $i != 2 && $i != 3) {

                    $part = explode('-', $key);

                    $item = $part[1];
                    $column = 'percent-' . $item;
                    $percent = $percent + $request->$column;
                }
                $i = $i + 1;

            }
//            end validate 100%
            if ($percent !== 100) {
                alert()->error('باید مجموع درصدهای وارد شده 100 باشد.', 'خطا')->autoclose(3000);
                return back();

            }

            // delet pervis items
            $pitems = CKarnameh::where('dars_id', $darsid)->where('id_karnameh', $idk)->get();

            foreach ($pitems as $pitem) {
                $pitem->delete();

            }
// CREATE cKARNAMEH
            $k = 0;
            $keys = array_keys($request->all());
            $items = [];

            foreach ($keys as $key) {

                if ($k != 0 && $k != 1 && $k != 2 && $k != 3) {

                    $part = explode('-', $key);

                    $item = $part[1];
                    $items[] = $part[1];
                    $column = 'percent-' . $item;
                    $ckarnameh = CKarnameh::where('item_id', $item)->where('id_karnameh', $request->idkarnameh)->get();
                    if (count($ckarnameh) > 0) {
                        $ckarnameh = CKarnameh::where('item_id', $item)->where('id_karnameh', $request->idkarnameh)->first();
                        $ckarnameh->update([
                            'percent' => ($request->$column) / 100,
                            'updated_at' => Carbon::now(),
                        ]);
                    } else {
                        CKarnameh::create([
                            'name' => $name,
                            'id_karnameh' => $request->idkarnameh,
                            'class_id' => $request->idclass,
                            'dars_id' => $darsid,
                            'item_id' => $item,
                            'percent' => ($request->$column) / 100,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now(),


                        ]);

                    }
                }
                $k += 1;

            }
// END CREATE cKARNAMEH
// FOR SHOW STUDENT KARNAMEH
            $cmarks = CMark::wherein('id', $items)->orderBy('id')->get();
            $markitems = MarkItem::wherein('item_id', $items)->orderBy('user_id')->get();
            $marks = $markitems->unique('user_id');
            $allmark = [];
            foreach ($marks as $mark) {
                $user_id = $mark->user_id;
                $markitemsuser = DB::table('mark_items')->wherein('item_id', $items)->where('user_id', $user_id)->orderBy('id')->get();
                $finalmark = 0;
                $Tpercent = 0;
                foreach ($markitemsuser as $markitemsuse) {
                    $percent = CKarnameh::where('item_id', $markitemsuse->item_id)->where('id_karnameh', $idk)->first()['percent'];
                    $mark = ($markitemsuse->mark) * $percent;
                    if (!empty($markitemsuse->mark)) {
                        $Tpercent = $Tpercent + $percent;
                    }
                    $finalmark = $finalmark + $mark;

                }
                if ($Tpercent == 0) {
                    $allmark[$user_id] = 0;

                } else {
                    $efinalmark = $finalmark / $Tpercent;
                    $allmark[$user_id] = $efinalmark;
                }
            }
            $namekarname = RKarnameh::where('id', $idk)->first()['name'];
            return view('Teacher.karnameh.student', compact('namekarname', 'darsid', 'allmark', 'marks', 'cmarks', 'idc', 'idk'));
        } else {
            return view('errors.404');
        }
    }

    /*
     ایجاد کارنامه در دیتابیس وهدایت ه صفحه نمایش کارنامه*
     */
    /**
     * @param Request $request
     * @param $idk
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function kstore(Request $request, $idk)
    {
        if (auth()->user()->role == 'معلم') {

            $k = 0;
            $keys = array_keys($request->all());
            foreach ($keys as $key) {
                if ($k != 0 && $k != 1 && $k != 2) {
                    $part = explode('-', $key);
                    $user_id = $part[1];
                    $column = 'mark-' . $user_id;
                    $Skarnameh = SKarnameh::where('user_id', $user_id)->where('teacher_id', auth()->user()->id)->where('dars_id', $request->iddars)->where('karnameh_id', $idk)->get();
                    if (count($Skarnameh) > 0) {
                        $Skarnameh = SKarnameh::where('user_id', $user_id)->where('teacher_id', auth()->user()->id)->where('dars_id', $request->iddars)->where('karnameh_id', $idk)->first();

                        $Skarnameh->update([
                            'mark' => $request->$column,
                            'updated_at' => Carbon::now(),
                        ]);

                    } else {
                        SKarnameh::create([
                            'karnameh_id' => $idk,
                            'class_id' => $request->idclass,
                            'dars_id' => $request->iddars,
                            'user_id' => $user_id,
                            'teacher_id' => auth()->user()->id,
                            'mark' => $request->$column,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now(),
                        ]);

                    }
                    $mykarnamehs = \App\SKarnameh::where('karnameh_id', $idk)->where('user_id', $user_id)->get();
                    $marks = 0;
                    $vaheds = 0;
                    foreach ($mykarnamehs as $mykarnameh) {
                        $vahed = \App\dars::where('id', $mykarnameh->dars_id)->first()['vahed'];
                        $mark = ($mykarnameh->mark) * $vahed;
                        $vaheds = $vaheds + $vahed;
                        $marks = $marks + $mark;
                    }
                    if ($vaheds == 0) {
                        $moadel = 0;
                    } else
                        $moadel = $marks / $vaheds;

                    $smkarnameh = SMkarnameh::where('karnameh_id', $idk)->where('dars_id', $request->iddars)->where('user_id', $user_id)->first();
                    if (empty($smkarnameh)) {
                        SMkarnameh::create([
                            'karnameh_id' => $idk,
                            'class_id' => $request->idclass,
                            'dars_id' => $request->iddars,
                            'user_id' => $user_id,
                            'teacher_id' => auth()->user()->id,
                            'mark' => $moadel,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now(),
                        ]);
                    } else {
                        $smkarnameh->update([
                            'mark' => $moadel,
                            'updated_at' => Carbon::now(),
                        ]);

                    }
                }
                $k += 1;

            }
            alert()->success('کارنامه مربوطه با موفقیت تولید شد', 'موفق')->autoclose(3000);
            return \Redirect::route('teacher.karnameh.show', ['idk' => $idk, 'idc' => $request->idclass, 'idd' => $request->iddars])->with('message', 'State saved correctly!!!');
        } else {
            return view('errors.404');
        }
    }

    /*
     نمایش کارنامه دانش آموزان در یک درس*
     */
    /**
     * @param $idk
     * @param $idd
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function show($idk, $idc, $idd)
    {
        if (auth()->user()->role == 'معلم') {
            $skarnamehs = SKarnameh::where('teacher_id', auth()->user()->id)->where('karnameh_id', $idk)->where('dars_id', $idd)->get();
            $items = CKarnameh::where('id_karnameh', $idk)->where('dars_id', $idd)->where('class_id', $idc)->where('percent', '>', 0)->pluck('item_id');
            $cmarks = CMark::wherein('id', $items)->orderBy('id')->get();
            $namekarname = RKarnameh::where('id', $idk)->first()['name'];
//           return $skarnamehs;
            return view('Teacher.karnameh.show', compact('idd', 'namekarname', 'skarnamehs', 'idk', 'cmarks'));
        } else {
            return view('errors.404');
        }
    }

    /*
     * گرفتن تاریخ ایجاد آیتم ها برای رندر کردن آیتم ها درصفحه ایجاد کارنامه
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function render(Request $request)
    {
//        dd($request);
        if (auth()->user()->role == 'معلم') {
            $items = DB::table('c_marks')
                ->orderBy('created_at')
                ->when($request->get('dateaval'), function ($query) use ($request) {
                    $query->whereDate('created_at', '>=', $request->dateaval);
                })
                ->when($request->get('date-picker-shamsi-list'), function ($query) use ($request) {
                    $query->whereDate('created_at', '<=', $request->get('date-picker-shamsi-list'));
                })
                ->where('dars', $request->iddars)
                ->where('classid', $request->clasid)
                ->where('user_id', auth()->user()->id)
                ->get();
            return view('includ.karnamehrenders', compact('items'));
        } else {
            return view('errors.404');
        }
    }

//    کارنامه تولیدی توسط مدیر
    public function newkarnamehshow($name, $class)
    {
        $students = User::where('class', $class)->
        with(['karnameadmin' => function ($query) use ($name) {
            $query->where('name', $name);
        }])->get();
        return view('Teacher.karnameh.newstudent', compact('students','class'));
    }

    public function skarnamehshow($name, $user, $moadel)
    {
        $mykarnamehs = KarnamehAdmin::where('name', $name)->where('user_id', $user)->get();
        return view('Teacher.karnameh.newskarnameh', compact('mykarnamehs', 'moadel'));
    }
//    End
}
