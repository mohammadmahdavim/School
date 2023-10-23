<?php

namespace App\Http\Controllers\student;

use App\clas;
use App\CMark;
use App\dars;
use App\Http\Controllers\Controller;
use App\MarkItem;
use App\MessageReseiver;
use App\Tamrin;
use App\TotalMark;
use App\User;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{


    /*
     نمودار تاثیر دروس در معدل*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function sahm()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $paye = User::where('id', $id)->first()['paye'];
        $doros = dars::where('paye', $paye)->get();
        $dayere = Charts::create('pie', 'fusioncharts')
            ->title('نمودار تاثیر دروس در معدل')
            ->labels($doros->pluck('name'))
            ->values($doros->pluck('vahed'))
            ->dimensions(1100, 600);
        if (empty($dayere)) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('student');
        }

        return view('student.charts.sahm', compact('dayere'));

    }

    /*
     نمودار درصد تحویل تمارین دروس مختلف*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function tamrin()
    {

        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $class = User::where('id', $id)->first()['class'];
        $tamrin = DB::table('tamrins')->where('class_id', $class)->orderBy('user_id')
            ->select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();
        $itemms = $tamrin->pluck('user_id');
        $darslable = Tamrin::wherein('user_id', $itemms)->get();
        $uniqdars = $darslable->unique('dars')->pluck('dars');
        $uniqdars = dars::wherein('id', $uniqdars)->pluck('name');
        $jtamrin = DB::table('j_tamrins')->where('user_id', $id)->orderBy('teacher_id')
            ->select('teacher_id', DB::raw('count(*) as total'))
            ->groupBy('teacher_id')
            ->get();
        if (count($jtamrin) != 0) {

            $per = [];
            foreach ($itemms as $tem) {

                $soal = $tamrin->where('user_id', $tem)->pluck('total');
                $javab = $jtamrin->where('teacher_id', $tem)->pluck('total');
                if (count($javab) != 0) {
                    $per[] = round(($javab[0] / $soal[0]) * 100);
                } else {
                    $per[] = 0;
                }
            }

            $tamrinss = Charts::create('bar', 'fusioncharts')
                ->title('نمودار درصد تحویل تمارین دروس مختلف')
                ->elementLabel("درصد تحویل")
                ->labels($uniqdars)
                ->values($per)
                ->dimensions(1000, 600)
                ->responsive(false);
        } else {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('student');
        }

        return view('student.charts.tamrin', compact('tamrinss'));
    }


    /*
     میانگین نمرات سالانه دروس مختلف و وقایسه با همتایان*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function mark()
    {
        //        وضعیت فعلی همه درسا ها - مقایسه ای با هم
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $iddoros = TotalMark::where('user_id', $id)->pluck('coddars');
        $paye = User::where('id', $id)->first()['paye'];
        $classes = clas::where('paye', $paye)->pluck('classnamber');
        $doros = dars::where('paye', $paye)->get();
        $dars = dars::where('paye', $paye)->wherein('id', $iddoros)->orderBy('id')->get();
        $mark = TotalMark::where('user_id', $id)->orderBy('coddars')->get();

        $coddars = TotalMark::where('user_id', $id)->orderBy('coddars')->pluck('coddars');
        $tops = [];
        foreach ($coddars as $cod) {
            $top = TotalMark::where('codclass', auth()->user()->class)->orderBy('totalmark', 'desc')->where('coddars', $cod)->first()['totalmark'];
            $tops[] = $top;
        }
        $avgsclass = [];
        foreach ($coddars as $cod) {
            $avg = TotalMark::where('codclass', auth()->user()->class)->orderBy('totalmark', 'desc')->where('coddars', $cod)->avg('totalmark');
            $avgsclass[] = $avg;
        }
        $avgspaye = [];
        foreach ($coddars as $cod) {
            $avg = TotalMark::wherein('codclass', $classes)->orderBy('totalmark', 'desc')->where('coddars', $cod)->avg('totalmark');
            $avgspaye[] = $avg;
        }

        $marks = $mark->pluck('totalmark');
        $mark = Charts::multi('bar', 'fusioncharts')
            ->title('میانگین نمرات سالانه')
            ->elementLabel("نمره")
            ->labels($dars->pluck('name'))
            ->dataset('نمره من ', $marks)
            ->dataset('میانگین نمره در کلاس ', $avgsclass)
            ->dataset('میانگین نمره در پایه ', $avgspaye)
            ->dataset('بیشترین نمره', $tops)
            ->colors(['#2E86C1', '#239B56', '#2ECC71', '#CB4335'])
            ->dimensions(1000, 500)
            ->responsive(false);
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();

        return view('student.charts.mark', ['mark' => $mark]);

    }

//    نمودار پیشرفت نمرات دروس

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function markrender(Request $request)
    {
        $iddars = $request->dars;
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $users = User::where('id', $id)->first();
        $classid = User::where('id', $id)->first()['class'];
        $doros = dars::where('paye', $users->paye)->orderby('id')->get();
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();
        $dars = dars::where('id', $iddars)->first()['name'];
        $paye = User::where('id', $id)->first()['paye'];
        $classes = clas::where('paye', $paye)->pluck('classnamber');
        $markstudent = TotalMark::where('user_id', $id)->where('coddars', $iddars)->pluck('totalmark');
        $top = TotalMark::where('codclass', auth()->user()->class)->orderBy('totalmark', 'desc')->where('coddars', $iddars)->pluck('totalmark');
        $avgsclass[] = TotalMark::where('codclass', auth()->user()->class)->orderBy('totalmark', 'desc')->where('coddars', $iddars)->avg('totalmark');
        $avgspaye [] = TotalMark::wherein('codclass', $classes)->orderBy('totalmark', 'desc')->where('coddars', $iddars)->avg('totalmark');

        $tops[] = $top[0];
        $mark = Charts::multi('bar', 'fusioncharts')
            ->title('میانگین نمرات سالانه')
            ->elementLabel("نمره")
            ->labels($dars)
            ->dataset('نمره من ', $markstudent)
            ->dataset('میانگین نمره در کلاس ', $avgsclass)
            ->dataset('میانگین نمره در پایه ', $avgspaye)
            ->dataset('بیشترین نمره', $tops)
            ->colors(['#2E86C1', '#239B56', '#2ECC71', '#CB4335'])
            ->dimensions(1000, 500)
            ->responsive(false);
        return view('student.charts.chartmarkrender', compact('mark', 'doros', 'count', 'karnamehs'));

    }

    public
    function marks($idd)
    {
        //        نمودار پیشرفت ترازی برای هر درس
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $iddars = $idd;
        $dars = dars::where('id', $idd)->first()['name'];
        $items = CMark::where('dars', $iddars)->where('classid', auth()->user()->class)->orderBy('id')->get();
        $markss = MarkItem::where('user_id', $id)->where('coddars', $iddars)->orderBy('id')->get();
        $users = TotalMark::where('coddars', $iddars)->orderByDesc('totalmark')->pluck('user_id');
        $markrank = MarkItem::where('coddars', $iddars)->orderBy('item_id')->orderBy('mark', 'Desc')->get();
        $ittems = MarkItem::where('coddars', $iddars)->orderBy('item_id')->get();
        $item = $ittems->unique('item_id')->all();
        $ranks = [];
        $s = 1;
        foreach ($item as $ite) {
            $rankss = 1;
            foreach ($markrank as $markran) {
                if ($markran->item_id == $ite->item_id) {
                    if ($markran->user_id == $id) {
                        break;
                    }
                    ++$rankss;
                }
            }
            $ranks[] = $rankss;
        }

        $rank = 1;
        foreach ($users as $user) {
            if ($user == $id) {
                break;
            }
            ++$rank;
        }

        $avg = DB::table('mark_items')->where('coddars', $iddars)->orderBy('id')
            ->select(DB::raw('avg(mark) as avg,  item_id'))
            ->groupBy('item_id')
            ->get();
        $nomreh = [];
        $k = 0;
        foreach ($markss as $ma) {

            $nomreh[] = [(($ma->mark))];
        }

        $avge = [];
        foreach ($avg as $av) {
            $avge [] = [(($av->avg))];
            $k += 1;
        }
        if ($k > 1) {
            if (!empty($nomreh)) {
                $nomreh = call_user_func_array("array_merge", $nomreh);
                $avge = call_user_func_array("array_merge", $avge);
            }
        }
        if (count($nomreh) > 1) {
            $marks = Charts::multi('line', 'fusioncharts')
                ->title('  نمودار پیشرفت درسی')
                ->elementLabel("چند درصد نمره را گرفتید؟")
                ->labels($items->pluck('name'))
                ->dataset('نمره من ', $nomreh)
                ->dataset('میانگین کلاس', [2])
                ->dataset(' رتبه در کلاس', $ranks)->dimensions(1000, 500);
        } else {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('student');
        }
//return $ranks;
        return view('student.charts.marks', compact('marks', 'rank', 'dars'));

    }


    /*
     نمودار پیشرفت معدل دانش آموز در طول سال*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public
    function moadel()
    {

        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $ids = [7, 8, 9, 10, 11, 12, 1, 2, 3];
        $marks = [];
        foreach ($ids as $i) {
            $mark = DB::table('mark_items')->where('user_id', $id)->orderBy('id')->whereRaw('MONTH(created_at) = ?', $i)
                ->select(DB::raw('avg(mark) as avg,  user_id'))
                ->groupBy('user_id')
                ->pluck('avg');

            if (count($mark) > 0) {
                $marks[] = ($mark[0]) * 5;
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

            return view('student.charts.moadel', compact('chartt'));
        } else {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('student');
        }
    }


}




