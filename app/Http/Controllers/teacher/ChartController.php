<?php

namespace App\Http\Controllers\teacher;

use App\clas;
use App\CMark;
use App\dars;
use App\Http\Controllers\Controller;
use App\teacher;
use App\TotalMark;
use App\User;
use Charts;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     مقایسه دانش آموزان در یک درس*
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chartmark($idc, $id)
    {
        if (auth()->user()->role == 'معلم') {

            $coddars = $id;
            $clas = $idc;
            $student = User::where('class', $clas)->where('role', 'دانش آموز')->pluck('id');
            $mark = TotalMark::wherein('user_id', $student)->where('coddars', $coddars)->orderBy('totalmark', 'Desc')->get();
            $itemcount = CMark::where('dars', $coddars)->where('classid', $clas)->count();
            $lname = [];
            foreach ($mark as $m) {
                $lname[] = User::where('id', $m->user_id)->first()['l_name'];
            }
            $chartt = Charts::create('bar', 'fusioncharts')
                ->title('نمرات دانش آموزان این کلاس')
                ->elementLabel("نمره")
                ->labels($lname)
                ->values($mark->pluck('totalmark'))
                ->dimensions(1000, 400)
                ->responsive(false);
            $id = $idc;
            return view('Teacher.chart.chartmark', compact('chartt', 'itemcount', 'id'));
        } else {
            return view('errors.404');
        }
    }


    /*
     * مقایسه نمرات دروس باهم
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classmark()
    {
        if (auth()->user()->role == 'معلم') {

            $paye = clas::where('classnamber', teacher::where('user_id', auth()->user()->id)->pluck('class_id')->first())->pluck('paye');
            $coddars = teacher::where('user_id', auth()->user()->id)->pluck('dars');
            $codclass = teacher::where('user_id', auth()->user()->id)->pluck('class_id');
            $items = CMark::where('user_id', auth()->user()->id)->pluck('id');
            $mark = DB::table('mark_items')->whereIn('coddars', $coddars)->whereIn('codclass', $codclass)->wherein('item_id', $items)->orderBy('coddars')
                ->select(DB::raw('avg(mark) as avg,  coddars'))
                ->groupBy('coddars')
                ->pluck('avg');
            $classnumber = DB::table('mark_items')->whereIn('codclass', $codclass)->whereIn('coddars', $coddars)->wherein('item_id', $items)->orderBy('coddars')
                ->select(DB::raw('avg(mark) as avg,  coddars'))
                ->groupBy('coddars')
                ->pluck('coddars');

            $namedars = dars::wherein('id', $classnumber)->pluck('name');
            $chartt = Charts::create('bar', 'fusioncharts')
                ->title('میانگین نمرات دروس')
                ->elementLabel("هر درس چند درصد نمرات را گرفته")
                ->labels($namedars)
                ->values($mark)
                ->dimensions(1000, 400)
                ->responsive(false);

            return view('Teacher.chart.classmark', compact('chartt'));
        } else {
            return view('errors.404');
        }
    }


    public function develop($idc, $idd)
    {
        if (auth()->user()->role == 'معلم') {
            $idclassT = $idc;
            $users = User::where('class', $idclassT)->where('role', 'دانش آموز')->pluck('id');
            $darsname = dars::where('id', $idd)->first()['name'];

            $itemss = CMark::where('user_id', auth()->user()->id)->pluck('id');

            $avge = DB::table('mark_items')->where('coddars', $idd)->wherein('user_id', $users)->wherein('item_id', $itemss)->orderBy('item_id')
                ->select(DB::raw('avg(mark) as avg,  item_id'))
                ->groupBy('item_id')
                ->pluck('avg');
            $avgeitem = DB::table('mark_items')->where('coddars', $idd)->wherein('user_id', $users)->wherein('item_id', $itemss)->orderBy('item_id')
                ->select(DB::raw('avg(mark) as avg,  item_id'))
                ->groupBy('item_id')
                ->pluck('item_id');
            $items = CMark::where('dars', $idd)->where('classid', $idclassT)->orderBy('id')->wherein('id', $avgeitem)->get();

            $chartt = Charts::create('line', 'fusioncharts')
                ->title('  نمودار پیشرفت درسی')
                ->elementLabel("چند درصد نمره را گرفتید؟")
                ->labels($items->pluck('name'))
                ->values($avge)
                ->dimensions(1000, 400)
                ->responsive(false);

            return view('Teacher.chart.develop', compact('darsname', 'idclassT', 'chartt', 'idd'));
        } else {
            return view('errors.404');
        }
    }


    //    public function paye()
//    {
//        if (auth()->user()->role == 'معلم') {
//            $useridT = auth()->user()->id;
//            $userT = User::where('id', $useridT)->get();
//            //        تعیین کلاس و درس مربوط به معلم لاگین کرده
//            $classidT = teacher::where('user_id', $useridT)->first();
//            $idclassT = explode(":", $classidT->class);
//            $idclasse = User::wherein('class', $idclassT)->get();
//
//            $idclass = $idclasse->unique('class')->pluck('class');
//            $payes = clas::wherein('classnamber', $idclass)->get();
//
//            $paye = $payes->unique('paye')->pluck('paye');
//            $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->wherein('classnamber', $idclass)->get();
//
//            $chartt = Charts::database(User::where('role', 'دانش آموز')->wherein('class', $idclass)->orderBy('paye')->get(), 'bar', 'fusioncharts')
//                ->elementLabel("تعداد")
//                ->title('تعداد دانش آموزان در هر پایه')
//                ->dimensions(1000, 400)
//                ->responsive(false)
//                ->groupBy('paye');
//
//            $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->where('status', 1)->get();
//           $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();
//
//            return view('Teacher.chart.paye', compact('claas', 'idclass', 'chartt', 'karnamehs','count'));
//        } else {
//            return view('errors.404');
//        }
//    }
//
//    public function class()
//    {
//        if (auth()->user()->role == 'معلم') {
//
//            $useridT = auth()->user()->id;
//            $userT = User::where('id', $useridT)->get();
//            //        تعیین کلاس و درس مربوط به معلم لاگین کرده
//            $classidT = teacher::where('user_id', $useridT)->first();
//            $idclassT = explode(":", $classidT->class);
//            $idclasse = User::wherein('class', $idclassT)->get();
//            $idclass = $idclasse->unique('class')->pluck('class');
//
//
//            $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->wherein('classnamber', $idclass)->get();
//
////        return $idclass;
//            $chartt = Charts::database(User::where('role', 'دانش آموز')->wherein('class', $idclass)->orderBy('class')->get(), 'bar', 'morris')
//                ->elementLabel("تعداد")
//                ->title('تعداد دانش آموزان در هر کلاس')
//                ->dimensions(1000, 400)
//                ->responsive(false)
//                ->groupBy('class');
//
//            $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->where('status', 1)->get();
//            $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();
//
//            return view('Teacher.chart.class', compact('claas', 'idclass', 'chartt', 'karnamehs','count'));
//        } else {
//            return view('errors.404');
//        }
//    }

}