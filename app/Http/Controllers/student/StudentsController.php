<?php

namespace App\Http\Controllers\student;

use App\Archive;
use App\clas;
use App\CMark;
use App\dars;
use App\Day;
use App\Discipline;
use App\Exam;
use App\ExamClass;
use App\Film;
use App\FirstMessage;
use App\Http\Controllers\Controller;
use App\KarnamehAdmin;
use App\MarkItem;
use App\MeetingUser;
use App\MessageReseiver;
use App\Moshaver;
use App\OnlineClass;
use App\pattern;
use App\RollCall;
use App\SKarnameh;
use App\TagvimS;
use App\Tamrin;
use App\TotalMark;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class StudentsController extends Controller
{

    public function index()
    {
        $modal = FirstMessage::where('receiver', 'دانش آموز')->where('modal', 1)->first();
        $messages = FirstMessage::where('receiver', 'دانش آموز')->where('modal', 0)->get();
        $class = User::where('id', auth()->user()->id)->pluck('class')->first();

        $days = TagvimS::where('class_id', $class)->with('dars')->with('times')->with('days')->orderBy('day')->get();
        $udays = $days->unique('day');
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $modal = FirstMessage::where('receiver', 'اولیا')->where('modal', 1)->first();
            $messages = FirstMessage::where('receiver', 'اولیا')->where('modal', 0)->get();
            $id = auth()->user()->id - 1000;
        }
        $users = User::where('id', $id)->first();
        $reshte = clas::where('classnamber', $class)->pluck('reshte')->first();
        $doros = dars::where('paye', $users->paye)
            ->whereIn('reshte', [$reshte, 'بدون رشته'])
            ->with('teacher')
            ->with('tagvim')
            ->with('tagvim.times')
            ->with('tagvim.days')
            ->orderby('id')
            ->get();

        $day = Jalalian::now()->getDay();
        if ($day < 10) {
            $day = '0' . $day;
        }
        $mounth = Jalalian::now()->getMonth();
        if ($mounth < 10) {
            $mounth = '0' . $mounth;
        }
        $year = Jalalian::now()->getYear();
        $date = $year . '-' . $mounth . '-' . $day;
        $enddate = $year . '/' . $mounth . '/' . $day;
        $day = Jalalian::forge('today')->format('%A');
        $day=Day::where('name',$day)->first();
        $onlines = OnlineClass::where('date', '<=', $date)->where('enddate', '>=', $enddate)->where('status', 1)
            ->where('class_id', $class)
            ->where('day_id',$day->id)
            ->orderby('start')
            ->with('author_class')
            ->get();

        $meetings = MeetingUser::where('user_id', auth()->user()->id)->pluck('meeting_id');
        $meetings = Moshaver::where('date', $enddate)->whereIn('id', $meetings)
            ->orderBy('start', 'asc')
            ->get();

        $patterns = pattern::where('class_id', $class)->where('date_from', '<=', $enddate)->where('date_to', '>=', $enddate)->where('status', 1)->get();
        return view('student.index', compact('modal','patterns', 'messages', 'days', 'udays', 'doros', 'onlines','meetings'));
    }

    public function dars($id)
    {
        $dars = dars::where('id', $id)
            ->with('teacher')
            ->with('tagvim')
            ->with('tagvim.times')
            ->with('tagvim.days')
            ->orderby('id')
            ->first();

        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $classid = User::where('id', $id)->first()['class'];
        $films[] = Film::where('class_id', $classid)->where('dars', $dars->id)->where('archive', 0)->orderByDesc('created_at')->get();
        $archiveid = Archive::where('user_id', $id)->where('model', 'Film')->pluck('item_id');
        if (count($archiveid) > 0) {
            $films = Film::where('class_id', $classid)->where('dars', $dars->id)->where('archive', 0)->get();
            $archive = Film::whereIn('id', $archiveid)->where('dars', $dars->id)->where('archive', 1)->orderby('created_at', 'desc')->latest()->get();
            $films = [$films, $archive];
        }
        $films = $films[0]->take(3);

        $tamrin[] = Tamrin::where('class_id', $classid)->where('dars', $dars->id)->where('archive', 0)->orderby('created_at', 'desc')->latest()->get();
        $archiveid = Archive::where('user_id', $id)->where('model', 'Tamrin')->pluck('item_id');
        if (count($archiveid) > 0) {
            $tamrin = Tamrin::where('class_id', $classid)->where('dars', $dars->id)->where('archive', 0)->orderby('created_at', 'desc')->latest()->get();
            $archive = Tamrin::whereIn('id', $archiveid)->where('archive', 1)->orderby('created_at', 'desc')->latest()->get();
            $tamrin = [$tamrin, $archive];
        }
        $tamrin = $tamrin[0]->take(3);

        $class = clas::where('classnamber', $classid)->pluck('id')->first();
        $exam_id = ExamClass::where('class_id', $class)->where('dars_id', $dars->id)->pluck('exam_id');

        $exams = Exam::whereIN('id', $exam_id)
            ->where('archive', 0)
            ->with('mymarks')
            ->with('examclass')
            ->with('examclass.darsname')
            ->with('examclass.class')
            ->get()
            ->take(3);

        $students = User::where('role', 'دانش آموز')->where('class', $classid)->get();

        return view('student.dars', compact('dars', 'films', 'tamrin', 'exams', 'students'));
    }

    public function tagvim()
    {

        $class = User::where('id', auth()->user()->id)->pluck('class')->first();

        $days = TagvimS::where('class_id', $class)->with('times')->with('days')->orderBy('day')->get();
        $udays = $days->unique('day');
        return view('student.tagvim', compact('days', 'udays'));

    }

    /*
     نمرات دانش آموز به صوریت درس محور در طول سال*
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mark($id)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $dars = dars::where('id', $id)->first()['name'];
        $mymark = MarkItem::where('user_id', $iduser)->where('coddars', $id)->get();
        $items = CMark::where('dars', $id)->where('classid', auth()->user()->class)->get();
        $users = User::where('id', $iduser)->get();
//        $marks = mark::where('dars', $dars)->where('user_id', $iduser)->get();
        $avg = 'هنوز نمره ای وارد نشده';
        if (!empty(MarkItem::where('user_id', $iduser)->where('coddars', $id)->first())) {
            $avg = round(MarkItem::where('user_id', $iduser)->where('coddars', $id)->avg('mark'), 2);
        }
        return view('student.mark', compact('dars', 'users', 'items', 'mymark', 'avg', 'iduser', 'id'));
    }

    public function karname()
    {
        if (auth()->user()->status == 0) {


            alert()->warning('اجازه دانلود ندارید.', 'ناموفق')->autoclose(3000);

            return redirect('/student');
        }
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();

        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $classid = User::where('id', $id)->first()['class'];
//        $doros = dars::where('id', $classid)->get();
        $users = User::where('id', $id)->first();
        $doros = dars::where('paye', $users->paye)->orderby('id')->get();
        $totalmark = TotalMark::where('user_id', $id)->get();

        $mark = 0;
        $shomarandeh = 0;
        foreach ($doros as $dars) {
            $nomreh = dars::find($dars->id)->TotalMarks()->where('user_id', $id)->first()['totalmark'];
            $vahed = $dars->vahed;
            $cmarks = \App\CMark::where('dars', $dars->id)->get();


            $bists = 0;
            foreach ($cmarks as $cmark) {

                $bist = $cmark->bist;
                $bists = $bists + $bist;
            }

            if ($bists == 0) {
                $moadel = 'هنوز دروس تکمیل نشده است.';
                return view('student.karname', compact('users', 'doros', 'moadel', 'karnamehs'));


            } else {
                $nomrehbist = (($nomreh / $bists) * 20) * $vahed;
                $mark = $mark + $nomrehbist;
                $shomarandeh = $shomarandeh + $vahed;
            }
        }
        $moadel = round($mark / $shomarandeh, 2);

        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();

        return view('student.karname', compact('users', 'doros', 'moadel', 'count'));
    }


    /*
     کارنامه های تولید شده توسط دبیر*
     */
    /**
     * @param $idk
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function karnameschool($idk)
    {
        if (auth()->user()->status == 0) {


            alert()->warning('اجازه دانلود ندارید.', 'ناموفق')->autoclose(3000);

            return redirect('/student');
        }
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $mykarnamehs = SKarnameh::where('karnameh_id', $idk)->where('user_id', $id)->get();
        if (empty($mykarnamehs[0])) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return redirect()->route('student');
        }

        if (config('global.type_mark') == 1) {
            return view('student.karnameh.school', compact('mykarnamehs', 'idk', 'id'));
        } else {
            return view('student.karnameh.schooltosify', compact('mykarnamehs', 'idk', 'id'));

        }
    }


    /*
     * کارنامه های تولید شده توسط خود سایت
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function karnamemonth()
    {
        if (auth()->user()->status == 0) {


            alert()->warning('اجازه دانلود ندارید.', 'ناموفق')->autoclose(3000);

            return redirect('/student');
        }
        return view('student.karnameh.month');
    }


    /*
     رندر کردن کارنامه ماهانه با انتخاب ماه*
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function karnamemonthrender(Request $request)
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }

        $month = $request->month;

        $mykarnamehs = DB::table('mark_items')->whereRaw('MONTH(created_at) = ?', $month)->where('user_id', $id)
            ->select(DB::raw('avg(mark) as avg,  coddars'))
            ->groupBy('coddars')
            ->get();
        $marks = 0;
        $vaheds = 0;
        foreach ($mykarnamehs as $mykarnameh) {
            $vahed = \App\dars::where('id', $mykarnameh->coddars)->first()['vahed'];
            $mark = ($mykarnameh->avg) * $vahed;
            $vaheds = $vaheds + $vahed;
            $marks = $marks + $mark;
        }

        if (
            $vaheds == 0) {
            $moadel = 0;
        } else {
            $moadel = round($marks / $vaheds, 2);

        }

        if ($month == 7) {
            $KarnamehName = 'مهر';

        } elseif ($month == 8) {
            $KarnamehName = 'آبان';

        } elseif ($month == 9) {
            $KarnamehName = 'آذر';

        } elseif ($month == 10) {
            $KarnamehName = 'دی';

        } elseif ($month == 11) {
            $KarnamehName = 'بهمن';

        } elseif ($month == 12) {
            $KarnamehName = 'اسفند';

        } elseif ($month == 1) {
            $KarnamehName = 'فروردین';

        } elseif ($month == 2) {
            $KarnamehName = 'اردیبهشت';

        } elseif ($month == 3) {
            $KarnamehName = 'خرداد';

        }

        $classnumber = auth()->user()->class;
        $studentnumbers = \App\student::where('classid', $classnumber)->count();
        $class = auth()->user()->class;
        $collection = DB::table("s_mkarnamehs")
            ->whereRaw('MONTH(created_at) = ?', $month)->where('class_id', $class)
            ->get();
        $data = $collection->where('user_id', auth()->user()->id);
        $rankkol = $data->keys()->first() + 1;
        $idk = $month;
        if (config('global.type_mark') == 1) {
            return view('includ.karnamehrendersmonth', compact('mykarnamehs', 'moadel', 'KarnamehName', 'studentnumbers', 'rankkol', 'idk', 'id'));

        } else {
            if ($moadel > 3) {
                $moadel = 'خیلی خوب';
            } elseif (($moadel < 3) && ($moadel >= 2)) {
                $avg = 'خوب';
            } elseif (($moadel < 2) && ($moadel >= 1)) {
                $avg = 'قابل قبول';
            } elseif ($moadel < 1) {
                $avg = 'نیاز به تلاش مجدد';
            }
            return view('includ.karnamehrendersmonthtosify', compact('mykarnamehs', 'moadel', 'KarnamehName', 'studentnumbers', 'rankkol', 'idk', 'id'));
        }
    }


    /*
     صفحه نمایش موارد انضباطی ثبت شده برای دانش آموز*
     */
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function discipline()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $disiplins = Discipline::where('user_id', $id)->orderByDesc('mark')->get();
        $total = Discipline::where('user_id', $id)->orderByDesc('mark')->sum('mark');

        return view('student.discipline', compact('disiplins', 'total'));
    }


    /*
     صفحه نمایش غیبت های دانش آموز*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function rollcall()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $data = RollCall::where('user_id', $id)->with('user')->orderByDesc('created_at')->get();
        if (count($data) == 0) {

            return back()->withErrors('اطلاعاتی وجود ندارد');
        }
        return view('student.absentlist', compact('data'));
    }


    public function newkarnameschool($name, $user)
    {
        $mykarnamehs = KarnamehAdmin::where('name', $name)->where('user_id', $user)->get();
        $vaheds = 0;
        $marks = 0;
        if ($mykarnamehs != '[]') {
            foreach ($mykarnamehs as $karnameh) {
                $vahed = $karnameh->dars->vahed;
                $mark = $vahed * $karnameh->mark;
                $vaheds = $vaheds + $vahed;
                $marks = $marks + $mark;
                if ($vaheds == 0) {
                    $moadel = 0;
                } else {
                    $moadel = round($marks / $vaheds, 2);
                }
            }
        } else {
            $moadel = 'نمره ای وجود ندارد.';
        }
        return view('student.karnameh.new', compact('moadel', 'mykarnamehs'));
    }
}


