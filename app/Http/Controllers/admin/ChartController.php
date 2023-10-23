<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\CMark;
use App\dars;
use App\Http\Controllers\Controller;
use App\paye;
use App\student;
use App\TotalMark;
use App\User;
use Charts;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{


    /*
     * نمودار پیشرفت کل دانش آموزان(میانگین نمرات ماهانه مدرسه)
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function kol()
    {
        $ids = [7, 8, 9, 10, 11, 12, 1, 2, 3];
        $marks = [];
        foreach ($ids as $i) {
            $mark = DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $i)
                ->select(DB::raw('avg(mark) as avg, MONTH(created_at)'))
                ->groupBy('MONTH(created_at)')
                ->pluck('avg');

            if (count($mark) > 0) {
                $marks[] = ($mark[0])*5;
            } else {
                $marks[] = 0;
            }

        }

        if (count($marks) != 0) {
            $chartt = Charts::create('bar', 'fusioncharts')
                ->title('میانگین ماهانه نمرات دانش آموزان این پایه')
                ->elementLabel("نمره")
                ->labels(['مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند', 'فروردین', 'اردیبهشت', 'خرداد',])
                ->values($marks)
                ->dimensions(1000, 600)
                ->responsive(false);

            return view('Admin.charts.kol', compact('chartt'));
        } else {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return back();
        }
    }


    /*
     * نمودار پیشرفت  دانش آموزان یک کلاس(میانگین نمرات ماهانه کلاس)
     */
    /***
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function class($id)
    {
        $students = User::where('role', 'دانش آموز')->where('class', $id)->pluck('id');
        $ids = [7, 8, 9, 10, 11, 12, 1, 2, 3];
        $marks = [];
        foreach ($ids as $i) {
            $mark = DB::table('mark_items')->wherein('user_id', $students)->whereRaw('MONTH(created_at) = ?', $i)
                ->select(DB::raw('avg(mark) as avg, MONTH(created_at)'))
                ->groupBy('MONTH(created_at)')
                ->pluck('avg');

            if (count($mark) > 0) {
                $marks[] = ($mark[0])*5;
            } else {
                $marks[] = 0;
            }

        }

        if (count($marks) != 0) {
            $chartt = Charts::create('bar', 'fusioncharts')
                ->title('میانگین ماهانه نمرات دانش آموزان این پایه')
                ->elementLabel("نمره")
                ->labels(['مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند', 'فروردین', 'اردیبهشت', 'خرداد',])
                ->values($marks)
                ->dimensions(1000, 600)
                ->responsive(false);
            return view('Admin.charts.class', compact('chartt', 'id'));
        } else {

            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('admin.home');
        }


    }


    /*
     * نمودار پیشرفت  دانش آموزان یک پایه(میانگین نمرات ماهانه پایه)
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function paye($id)
    {

        $payee = paye::where('id', $id)->first()['name'];
        $classid = clas::where('paye', $payee)->pluck('classnamber');
        $students = User::where('role', 'دانش آموز')->wherein('class', $classid)->pluck('id');

        $ids = [7, 8, 9, 10, 11, 12, 1, 2, 3];
        $marks = [];
        foreach ($ids as $i) {
            $mark = DB::table('mark_items')->wherein('user_id', $students)->whereRaw('MONTH(created_at) = ?', $i)
                ->select(DB::raw('avg(mark) as avg, MONTH(created_at)'))
                ->groupBy('MONTH(created_at)')
                ->pluck('avg');

            if (count($mark) > 0) {
                $marks[] = ($mark[0])*5;
            } else {
                $marks[] = 0;
            }

        }


        if (count($marks) != 0) {
            $chartt = Charts::create('bar', 'fusioncharts')
                ->title('میانگین ماهانه نمرات دانش آموزان این پایه')
                ->elementLabel("نمره")
                ->labels(['مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند', 'فروردین', 'اردیبهشت', 'خرداد',])
                ->values($marks)
                ->dimensions(1000, 600)
                ->responsive(false);

            return view('Admin.charts.paye', compact('chartt', 'payee'));
        } else {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('admin.home');
        }

    }

    /*
     * نمودار تعداد بارگذاری مطالب آموزشی و تمارین دبیران
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teacheractivity()
    {

        $tamrins = DB::table('tamrins')
            ->select(DB::raw('count(id) as count,  user_id'))
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->get();
        $films = DB::table('films')
            ->select(DB::raw('count(id) as count,  user_id'))
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->get();

        $users = [];
        $countactivity = [];
        if (count($tamrins) > 0 && count($films) > 0) {
            foreach ($tamrins as $tamrin) {
                $film = $films->where('user_id', $tamrin->user_id)->pluck('count');
                if (count($film) > 0) {
                    $counts = $tamrin->count + $film[0];
                    $users[] = User::where('id', $tamrin->user_id)->pluck('L_name')->first();
                    $countactivity[] = $counts;
                } else {
                    $counts = $tamrin->count;
                    $users[] = User::where('id', $tamrin->user_id)->pluck('L_name')->first();
                    $countactivity[] = $counts;
                }

            }
            foreach ($films as $film) {
                $tamrin = $tamrins->where('user_id', $film->user_id)->pluck('user_id');
//                return $films;
                if (count($tamrin) == 0) {
                    $counts = $film->count;
                    $users[] = User::where('id', $film->user_id)->pluck('L_name')->first();
                    $countactivity[] = $counts;
                }
            }
        } elseif (count($tamrins) > 0 && count($films) == 0) {

            foreach ($tamrins as $tamrin) {
                $counts = $tamrin->count;
                $users[] = User::where('id', $tamrin->user_id)->pluck('L_name')->first();
                $countactivity[] = $counts;
            }

        } elseif (count($tamrins) == 0 && count($films) > 0) {
            foreach ($films as $film) {
                $counts = $film->count;
                $users[] = User::where('id', $film->user_id)->pluck('L_name')->first();
                $countactivity[] = $counts;
            }
        }
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('تعداد مطالب بارگذاری کرده دبیران')
            ->elementLabel("تعداد")
            ->labels($users)
            ->values($countactivity)
            ->dimensions(1000, 600)
            ->responsive(false);
        return view('Admin.charts.teacheractivity', compact('chartt'));
    }

    /*
     * مقایسه معدل کلاس ها
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moadel()
    {
        $markss = DB::table('c_marks')->orderBy('classid')->get();
        $classs = $markss->unique('classid');
        $marks = DB::table('mark_items')->orderBy('codclass')
            ->select(DB::raw('avg(mark) as avg,  coddars,codclass'))
            ->groupBy('codclass', 'coddars')
            ->get();

        $uniqmarks = $marks->unique('codclass');
        $a = [];
        foreach ($uniqmarks as $uniqmark) {
            $ma = 0;
            $id = 0;

            foreach ($marks as $nomr) {
                if ($uniqmark->codclass == $nomr->codclass) {
                    $vahed = dars::where('id', $nomr->coddars)->pluck('vahed');
                    $ma = $ma + (($nomr->avg) * ($vahed[0]));
                    $id = $id + $vahed[0];
                }

            }
            $a[] = ($ma / $id)*5;
        }

        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('معدل هر کلاس با تاثیر ضریب دروس')
            ->elementLabel("نمره")
            ->labels($classs->pluck('classid'))
            ->values($a)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.charts.moadel', compact('chartt'));
    }


    /*
     * نمودار مقایسه معدل کلاس ها دریک پایه
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function koldars($id)
    {
        $paye = paye::where('id', $id)->first()['name'];
        $classid = clas::where('paye', $paye)->pluck('classnamber');

        $markss = DB::table('c_marks')->whereIn('classid', $classid)->orderBy('classid')->get();
        $classs = $markss->unique('classid');
        $marks = DB::table('mark_items')->whereIn('codclass', $classid)->orderBy('codclass')
            ->select(DB::raw('avg(mark) as avg,  coddars,codclass'))
            ->groupBy('codclass', 'coddars')
            ->get();

        $uniqmarks = $marks->unique('codclass');

        $a = [];
        foreach ($uniqmarks as $uniqmark) {
            $ma = 0;
            $id = 0;
            foreach ($marks as $nomr) {

                if ($uniqmark->codclass == $nomr->codclass) {
                    $vahed = dars::where('id', $nomr->coddars)->pluck('vahed');
                    $ma = $ma + (($nomr->avg) * ($vahed[0]));
                    $id = $id + $vahed[0];
                }

            }
            $a[] = ($ma / $id)*5;
        }

        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('معدل هر کلاس با تاثیر ضریب دروس')
            ->elementLabel("نمره")
            ->labels($classs->pluck('classid'))
            ->values($a)
            ->dimensions(1000, 600)
            ->responsive(false);


        return view('Admin.charts.koldars', compact('chartt'));
    }


    /*
     * نمودار مقایسه معدل یه درس در کلاس های یک پایه
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payeclassdars($id)
    {
        $darss = dars::where('id', $id)->first()['name'];
        $payename = dars::where('id', $id)->first()['paye'];
        $markss = DB::table('c_marks')->where('dars', $id)->orderBy('classid')->get();
        $classs = $markss->unique('classid')->pluck('classid');
        $marks = DB::table('mark_items')->where('coddars', $id)->orderBy('codclass')
            ->select(DB::raw('avg(mark) as avg,  codclass'))
            ->groupBy('codclass')
            ->pluck('avg');

        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('میانگین نمرات درس مورد نظر در کلاس')
            ->elementLabel("نمره")
            ->labels($classs)
            ->values($marks)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.charts.payeclassdars', compact('chartt', 'darss', 'payename'));
    }





    /*
     * نمودار مقایسه نمرات دروس در یک کلاس
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classdars($id)
    {

        $markss = DB::table('c_marks')->where('classid', $id)->orderBy('dars')->get();
        $classs = $markss->unique('dars')->pluck('dars');
        $student=User::where('class',$id)->where('role','دانش آموز')->pluck('id');
        $marks = DB::table('mark_items')->orderBy('coddars')->wherein('user_id', $student)
            ->select(DB::raw('avg(mark) as avg,  coddars'))
            ->groupBy('coddars')
            ->pluck('avg');

        $darsname = dars::wherein('id', TotalMark::where('codclass', $id)->pluck('coddars'))->orderby('id')->pluck('name');

        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('میانگین نمره هر درس در این کلاس')
            ->elementLabel("نمره")
            ->labels($darsname)
            ->values($marks)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.charts.classdars', compact('chartt',  'id'));
    }


    /*
     * مقایسه دانش آموزان یک کلاس در یک درس
     */
    /**
     * @param $id
     * @param $idclass
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payedars($id, $idclass)
    {

        $darss = dars::where('id', $id)->first()['name'];
        $itemcount = CMark::where('dars', $id)->where('classid', $idclass)->count();

        $student = student::where('classid', $idclass)->pluck('user_id');
        $mark = TotalMark::wherein('user_id', $student)->where('coddars', $id)->where('codclass', $idclass)->orderBy('totalmark', 'Desc')->get();

        $lname = [];
        foreach ($mark as $m) {


            $lname[] = User::where('id', $m['user_id'])->first()['l_name'];
        }

        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('نمرات دانش آموزان این کلاس')
            ->elementLabel("نمره")
            ->labels($lname)
            ->values($mark->pluck('totalmark'))
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.charts.payedars', compact('chartt', 'itemcount', 'darss', 'idclass'));


    }

    /*
     * مقایسه تعداد دانش آموزان پایه ها
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function numberpaye()
    {
        $chartt = Charts::database(User::where('role', 'دانش آموز')->orderBy('paye')->get(), 'bar', 'fusioncharts')
            ->elementLabel("تعداد")
            ->title('تعداد دانش آموزان در هر پایه')
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupBy('paye');


        return view('Admin.charts.payenumber', compact('chartt'));

    }

    /*
     * مقایسه تعداد دانش آموزان کلاس ها
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function numberclass()
    {
        $chartt = Charts::database(User::where('role', 'دانش آموز')->orderBy('class', 'desc')->get(), 'bar', 'fusioncharts')
            ->elementLabel("تعداد")
            ->title('تعداد دانش آموزان در هر پایه')
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupBy('class');

        return view('Admin.charts.classnumber', compact('chartt'));
    }


}
