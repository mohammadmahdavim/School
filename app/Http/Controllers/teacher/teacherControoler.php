<?php

namespace App\Http\Controllers\teacher;

use App\Archive;
use App\Day;
use App\Discipline;
use App\Exam;
use App\ExamClass;
use App\Film;
use App\FilmSection;
use App\FirstMessage;
use App\Http\Controllers\Controller;
use App\OnlineClass;
use App\RollCall;
use App\TagvimT;
use App\Tamrin;
use App\teacher;
use App\Time;
use App\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class teacherControoler extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 'معلم') {
            $modal = FirstMessage::where('receiver', 'دبیر')->where('modal', 1)->first();
            $messages = FirstMessage::where('receiver', 'دبیر')->where('modal', 0)->get();
            $days = TagvimT::where('user_id', auth()->user()->id)->with('times')->with('days')->orderBy('day')->get();
            $udays = $days->unique('day');
            $teacherclass = teacher::where('user_id', auth()->user()->id)->with('tagvim')->get();
            $day=Jalalian::now()->getDay();
            if ($day<10){
                $day='0'.$day;
            }
            $mounth=Jalalian::now()->getMonth();
            if ($mounth<10){
                $mounth='0'.$mounth;
            }
            $year=Jalalian::now()->getYear();
            $date=$year.'-'.$mounth.'-'.$day;
            $enddate = $year . '/' . $mounth . '/' . $day;
             $day = Jalalian::forge('today')->format('%A');
		$day=Day::where('name',$day)->first();
            $onlines = OnlineClass::where('date','<=', $date)->where('enddate','>=', $enddate)->where('status', 1)
                ->where('author', auth()->user()->id)
                ->orderby('start')
                            ->where('day_id',$day->id)

                ->with('author_class')
                ->get();
            $rollcalls = RollCall::with('user')
                ->whereIn('class_id',$teacherclass->pluck('class_id'))
                ->where('updated_at', Jalalian::now()->format('Y-m-d'))
                ->orderByDesc('class_id')->get();
            $disiplins = Discipline::
            with('user')
                ->whereIn('class',$teacherclass->pluck('class_id'))

                ->orderByDesc('class')
                ->with('CDisciplines')
                ->where('date', Jalalian::now()->format('Y/m/d'))
                ->get();
            return view('Teacher.index', compact('messages','rollcalls','disiplins', 'modal', 'teacherclass', 'days', 'udays','onlines'));
        } else {
            return view('errors.404');
        }
    }

    public function class($id)
    {
        $exite=teacher::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if (auth()->user()->role == 'معلم' and $exite) {
            $clas = teacher::where('id', $id)->with('users')->first();
            $films = Film::where('class_id', $clas->class_id)->where('dars', $clas->dars)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get()->take(3);
            $sections = FilmSection::where('section_id', 0)->get();
            $useridT = auth()->user()->id;
            $idclas = $clas->class_id;
            $tamrins = Tamrin::where('dars', $clas->dars)->where('archive', 0)->where('class_id', $clas->class_id)->where('user_id', $useridT)->orderBy('created_at', 'desc')->get()->take(3);
            $exams = ExamClass::where('class_id', $clas->class[0]->id)
                ->where('dars_id', $clas->dars)
                ->with('exam')
                ->whereHas('exam', function ($q) {
                    $q->where('author', auth()->user()->id);
                    $q->where('archive', 0);
                })
                ->get()
                ->take(3);
            $students = User::where('class', $idclas)->where('role', 'دانش آموز')->get();
            $day=Jalalian::now()->getDay();
            if ($day<10){
                $day='0'.$day;
            }
            $mounth=Jalalian::now()->getMonth();
            if ($mounth<10){
                $mounth='0'.$mounth;
            }
            $year=Jalalian::now()->getYear();
            $date=$year.'-'.$mounth.'-'.$day;
            $onlines = OnlineClass::where('date', $date)->where('status', 1)
                ->where('class_id', $idclas)
                ->where('author', auth()->user()->id)
                ->orderby('start')
                ->get();
            return view('Teacher.class', compact('clas', 'students', 'films', 'sections', 'tamrins', 'idclas', 'exams', 'onlines'));
        } else {
            return view('errors.404');
        }
    }

    public function classteacher(Request $request, $id)
    {
        $row = teacher::find($id);
        $row->update([
            'description' => $request->description,
        ]);
        alert()->success('عملیات با موفقیت انجام گرفت.', 'موفق');
        return back();
    }

    public function link(Request $request, $id)
    {
        $row = teacher::find($id);
        $row->update([
            'class_link' => $request->class_link,
        ]);
        alert()->success('عملیات با موفقیت انجام گرفت.', 'موفق');
        return back();
    }

    public function sync(Request $request, $id)
    {
        $rows = Archive::where('model', $request->model)->where('item_id', $id)->get();
        foreach ($rows as $row) {
            $row->delete();
        }
        if ($request->class) {
            $users = User::where('role', 'دانش آموز')->whereIn('class', $request->class)->pluck('id');
            foreach ($users as $user) {
                $archive = new Archive();
                $archive->user_id = $user;
                $archive->model = $request->model;
                $archive->item_id = $id;
                $archive->save();
            }
        }
        if ($request->users) {
            foreach ($request->users as $user) {
                $archive = new Archive();
                $archive->user_id = $user;
                $archive->model = $request->model;
                $archive->item_id = $id;
                $archive->save();
            }
        }


        alert()->success('عملیات با موفقیت انجام شد', 'موفق');
        return back();
    }


    public function tagvim()
    {
        $days = TagvimT::where('user_id', auth()->user()->id)->with('times')->with('days')->orderBy('day')->get();
        $udays = $days->unique('day');

        return view('Teacher.tagvim', compact('days', 'udays'));
    }

}
