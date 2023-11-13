<?php

namespace App\Http\Controllers\teacher;

use App\clas;
use App\CMark;
use App\dars;
use App\Http\Controllers\Controller;
use App\MarkItem;
use App\SKarnameh;
use App\teacher;
use App\TotalMark;
use App\User;
use http\Params;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use PhpParser\Node\Param;
use Excel;

class MarkController extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @param $id
     */

    public function index($idc, $iddars)
    {
        $exite = teacher::where('user_id', auth()->user()->id)->where('class_id', $idc)
            ->where('dars',$iddars)
            ->first();

        if ((auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') and $exite) {

            $darss = dars::where('id', $iddars)->first()['name'];

            //       گرفتن یوزرهایی که دانش آموزان این کلاس هستند
            $users = User::where('class', $idc)->where('role', 'دانش آموز')->orderBy('l_name', 'asc')->get();

//        گرفتن آیتم های مربوط به این درس
            $items = CMark::where('user_id', auth()->user()->id)->where('dars', $iddars)->where('classid', $idc)->get();
            return view('Teacher.student.mark', compact('users', 'iddars', 'darss', 'items', 'idc'));
        } else {
            return view('errors.404');
        }
    }


    public
    function edit(Request $request)
    {
        if (auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') {

            $iddars = $request->iddars;
            $jDate = Jalalian::now();

            $k = 0;
            $error = 0;
            $keys = array_keys($request->all());
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            if ($teacher->dars = $iddars) {

                foreach ($keys as $key) {
                    if ($k != 0 && $k != 1 && $k != 2) {
                        $part = explode('-', $key);

                        $item = $part[1];
                        $userid = $part[2];
                        $column = 'mark-' . $item . '-' . $userid;
                        $row = MarkItem::where('user_id', $userid)->where('item_id', $item)->first();
                        $maxitem = CMark::where('id', $item)->first()['max'];
                        $usermark = $request->$column;

                        if ($usermark <= $maxitem) {
                            $max = CMark::where('id', $item)->first()['max'];

                            if (!isset($request->$column)) {
                                //   dd($request->$column);
                                if ($row != null) {
                                    $row->delete();
                                }
                            }
                            if (isset($request->$column)) {
                                if ($row == null) {
                                    MarkItem::create([
                                        'user_id' => $userid,
                                        'item_id' => $item,
                                        'mark' => ($request->$column),
                                        'coddars' => $iddars,
                                        'codclass' => $request->idclass,
                                        'created_at' => $jDate,
                                        'updated_at' => $jDate,
                                    ]);
                                } else {

                                    $row->update([
                                        'user_id' => $userid,
                                        'item_id' => $item,
                                        'mark' => ($request->$column),
                                        'coddars' => $iddars,
                                        'codclass' => $request->idclass,
                                        'updated_at' => $jDate,

                                    ]);

                                }
                            }


                            $total = 0;
                            $i = 0;
                            $allmarks = MarkItem::where('user_id', $userid)->where('coddars', $iddars)->get();
                            foreach ($allmarks as $nomreh) {

                                $total = $total + $nomreh->mark;
                                                               if (!empty($nomreh->mark) or $nomreh->mark==0) {

                                    $i = $i + 1;
                                }
                            }
                            if ($i == 0) {
                                $i = $i + 1;
                            }

                            $totalmark = TotalMark::where('user_id', $userid)->where('coddars', $iddars)->first();
                            if ($totalmark == null) {
                                TotalMark::create([
                                    'user_id' => $userid,
                                    'totalmark' => $total / $i,
                                    'coddars' => $iddars,
                                    'codclass' => $request->idclass,
                                    'created_at' => $jDate,
                                    'updated_at' => $jDate,
                                ]);
                            } else {

                                $totalmark->update([
                                    'user_id' => $userid,
                                    'totalmark' => $total / $i,
                                    'coddars' => $iddars,
                                    'codclass' => $request->idclass,
                                    'updated_at' => $jDate,
                                ]);

                            }
                        } else {
                            $error = $error + 1;

                        }
                    }

                    $k += 1;

                }

            }
            alert()->success('ویرایش نمره با موفقیت انجام شد', 'ویرایش نمره')->autoclose(2000);
            return back();
        } else {
            return view('errors.404');
        }
    }


    public
    function create($idc, $idd)
    {
        if (auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') {

            $darss = dars::where('id', $idd)->first();

            $classid = $idc;
            $items = CMark::where('dars', $darss->id)->where('user_id', auth()->user()->id)->where('classid', $classid)->count();

            return view('Teacher.student.createmarkss', compact('idd', 'darss', 'items', 'classid', 'idc'));
        } else {
            return view('errors.404');
        }
    }


    public
    function store(Request $request)
    {

        if (auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') {

            $id = auth()->user()->id;
            $idd = $request->dars;
            $idc = request('classid');

            $this->validate(request(),
                [
//                    'name' => 'required',
                    'dars' => 'required',
                    'max' => 'required',

                ]
            );

            $paye = clas::where('classnamber', $request->classid)->pluck('paye')->first();
            $namedars = dars::where('id', $idd)->pluck('name')->first();

            CMark::create([
                'user_id' => $id,
                'classid' => request('classid'),
                'dars' => request('dars'),
                'max' => 20,
                'name' => request('name'),
                'payeclass' => $paye,
                'namedars' => $namedars,
                'created_at' => Jalalian::now(),
                'updated_at' => Jalalian::now(),
            ]);

            alert()->success('آیتم مورد نظر با موفقیت ثبت شد.', 'ایجاد آیتم')->autoclose(3000);
            return redirect(url('teacher/mark/' . $idc . '/' . $idd));
        } else {
            return view('errors.404');
        }
    }


    public
    function viewmark($idc, $idd)
    {
        if (auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') {
            $dars = dars::where('id', $idd)->first()['name'];
            $cmark = CMark::where('user_id', auth()->user()->id)->where('classid', $idc)->where('dars', $idd)->get();
            return view('Teacher.student.viewmark', compact('cmark', 'idd', 'dars', 'idc'));
        } else {
            return view('errors.404');
        }
    }


    public
    function markdelet($id)
    {
        if (auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') {

            $mark = CMark::where('id', $id)->first();
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            if ($teacher->dars = $mark->namedars) {
                $mark->delete();

                $Smarks = MarkItem::where('item_id', $id)->get();
                foreach ($Smarks as $Smark)
                    $Smark->delete();
            }
            return back();
        } else {
            return view('errors.404');
        }
    }


    public
    function editeemark(Request $request, $id)
    {
        $this->validate(request(),
            [
                'name' => 'required',
            ]
        );
        if (auth()->user()->role == 'معلم' or auth()->user()->role=='مدیر') {

            $mark = CMark::where('id', $id)->first();
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            if ($teacher->class_ic = $mark->classid) {
                $mark->update([
                    'name' => request('name'),
                    'updated_at' => Jalalian::now(),
                ]);;
            }
            alert()->success('آیتم مورد نظر با موفقیت ویرایش شد.', ' ویرایش آیتم')->autoclose(3000);

            return back();
        } else {
            return view('errors.404');
        }
    }

    public function date($class, $dars)
    {

        return view('Teacher.student.markdate', compact('class', 'dars'));
    }

    public function datemark(Request $request)
    {
        $date = $request->date;
        $iddars = $request->dars;
        $idc = $request->class;
        $darss = dars::where('id', $iddars)->first()['name'];
        $itemid = CMark::where('user_id', auth()->user()->id)
            ->where('dars', $iddars)
            ->where('classid', $idc)
            ->where('name', $date)
            ->pluck('id')->first();
        //       گرفتن یوزرهایی که دانش آموزان این کلاس هستند
        $users = User::where('class', $idc)
            ->where('role', 'دانش آموز')
            ->orderBy('l_name', 'asc')
            ->with(['markitems' => function ($query) use ($request, $itemid) {
                $query->where('coddars', $request->dars);
                $query->where('codclass', $request->class);
                $query->where('item_id', $itemid);
            }])
            ->get();


        return view('includ.mark', compact('users', 'iddars', 'darss', 'idc', 'date'));
    }


    public function storedate(Request $request)
    {
        $teacher = auth()->user()->id;
        $idclass = $request->idclass;
        $iddars = $request->iddars;
        $date = $request->date;
        $jDate = Jalalian::now();

        $row = CMark::where('user_id', $teacher)
            ->where('classid', $idclass)
            ->where('dars', $iddars)
            ->where('name', $date)
            ->first();
        if (!empty($row)) {
            $item = $row->id;
        }
        if (empty($row)) {
            $paye = clas::where('classnamber', $idclass)->pluck('paye')->first();
            $namedars = dars::where('id', $iddars)->pluck('name')->first();
            $item = CMark::create([
                'name' => $date,
                'user_id' => $teacher,
                'dars' => $iddars,
                'classid' => $idclass,
                'max' => 20,
                'namedars' => $paye,
                'payeclass' => $namedars,
                'created_at' => Jalalian::now(),
                'updated_at' => Jalalian::now(),
            ])->id;
        }
        foreach ($request->mark as $key => $mark) {
            $row = MarkItem::where('user_id', $key)->where('item_id', $item)->first();
            if ($row == null) {
                MarkItem::create([
                    'user_id' => $key,
                    'item_id' => $item,
                    'mark' => $mark,
                    'coddars' => $iddars,
                    'codclass' => $idclass,
                    'created_at' => $jDate,
                    'updated_at' => $jDate,
                ]);
            } else {
                $row->update([
                    'mark' => $mark,
                    'updated_at' => $jDate,
                ]);

            }
            $total = 0;
            $i = 0;
            $allmarks = MarkItem::where('user_id', $key)->where('coddars', $iddars)->get();
            foreach ($allmarks as $nomreh) {

                $total = $total + $nomreh->mark;
                if (!empty($nomreh->mark)) {
                    $i = $i + 1;
                }
            }
            if ($i == 0) {
                $i = $i + 1;
            }

            $totalmark = TotalMark::where('user_id', $key)->where('coddars', $iddars)->first();
            if ($totalmark == null) {
                TotalMark::create([
                    'user_id' => $key,
                    'totalmark' => $total / $i,
                    'coddars' => $iddars,
                    'codclass' => $idclass,
                    'created_at' => $jDate,
                    'updated_at' => $jDate,
                ]);
            } else {

                $totalmark->update([
                    'user_id' => $key,
                    'totalmark' => $total / $i,
                    'coddars' => $iddars,
                    'codclass' => $idclass,
                    'updated_at' => $jDate,
                ]);

            }
        }

        $date = $request->date;

        $darss = dars::where('id', $iddars)->first()['name'];
        $itemid = CMark::where('user_id', auth()->user()->id)
            ->where('dars', $iddars)
            ->where('classid', $idclass)
            ->where('name', $date)
            ->pluck('id')->first();
        //       گرفتن یوزرهایی که دانش آموزان این کلاس هستند
        $users = User::where('class', $idclass)
            ->where('role', 'دانش آموز')
            ->orderBy('l_name', 'asc')
            ->with(['markitems' => function ($query) use ($request, $itemid) {
                $query->where('coddars', $request->iddars);
                $query->where('codclass', $request->idclass);
                $query->where('item_id', $itemid);
            }])
            ->get();
        $idc = $idclass;
        return view('includ.mark', compact('users', 'iddars', 'darss', 'idc', 'date'));
    }

    public function export($class, $dars)
    {
//        $marks = MarkItem::where('codclass', $class)->where('coddars', $dars)->with('users')->with('items')->get();
        $data = MarkItem::where('codclass', $class)->where('coddars', $dars)->
        join('users', 'users.id', '=', 'mark_items.user_id')->
        join('c_marks', 'c_marks.id', '=', 'mark_items.item_id')
            ->select('users.l_name', 'users.f_name', 'c_marks.name', 'mark_items.mark')
            ->orderBy('mark_items.user_id')
            ->get()->toArray();
        $class = clas::where('classnamber', $class)->first();
        $dars = dars::find($dars);
        return Excel::create('خروجی نمرات کلاس' . ' ' . $class->paye . ' ' . $class->reshte . ' ' . 'درس' . ' ' . $dars->name, function ($excel) use ($data) {
            $excel->sheet('خروجی نمرات', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');

    }

    public function exportkarnameh($class, $dars)
    {
//        $marks = MarkItem::where('codclass', $class)->where('coddars', $dars)->with('users')->with('items')->get();
        $data = SKarnameh::where('class_id', $class)->where('dars_id', $dars)->
        join('users', 'users.id', '=', 's_karnamehs.user_id')->
        join('dars', 'dars.id', '=', 's_karnamehs.dars_id')
            ->select('users.l_name', 'users.f_name', 'dars.name', 's_karnamehs.mark')
            ->orderBy('s_karnamehs.user_id')
            ->get()->toArray();
        $class = clas::where('classnamber', $class)->first();
        $dars = dars::find($dars);
        return Excel::create('خروجی نمرات کلاس' . ' ' . $class->paye . ' ' . $class->reshte . ' ' . 'درس' . ' ' . $dars->name, function ($excel) use ($data) {
            $excel->sheet('خروجی نمرات', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');

    }
}
