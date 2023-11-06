<?php

namespace App\Http\Controllers\admin;

use App\CDiscipline;
use App\clas;
use App\Discipline;
use App\Http\Controllers\Controller;
use App\RollCall;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class DisciplineController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * مشاهده موارد انضباطی ایجاد کرده
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cindex()
    {
        $disciplines = DB::table('c_disciplines')->orderByDesc('created_at')->get();
        return view('Admin.discipline.cmanage', compact('disciplines'));
    }

    /*
     صفحه ایجاد مورد انضباطی جدید*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ccreate()
    {
        return view('Admin.discipline.ccreate');
    }


    /*
     ایجاد مورد انضباطی در دیتابیس وجدول c_discipline*
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cstore(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'mark' => 'required'
        ]);

        CDiscipline::create([
            'name' => request('name'),
            'description' => request('description'),
            'mark' => request('mark'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('آیتم مورد نظر با موفقیت ثبت شد.', 'ایجاد آیتم انضباطی')->autoclose(3000);

        return redirect()->route('Admin.cdiscipline.manage');

    }


    public function all(Request $request)
    {
        $list = Discipline::groupBy('user_id')
            ->when($request->get('user_id'), function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })

            ->selectRaw('*, sum(mark) as sum')
            ->get();

        $other = User::where('role', 'دانش آموز')
            ->when($request->get('user_id'), function ($query) use ($request) {
                $query->where('id', $request->user_id);
            })
            ->whereNotIn('id', $list->pluck('user_id'))->orderBy('l_name')->get();

        $users = user::where('role', 'دانش آموز')->get();

        return view('Admin.discipline.class', compact('list', 'other','users'));

    }

    /*
      مشاهده لیست دانش آموزان با نمره انضباط*
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function class($id)
    {
        $users = User::where('role', 'دانش آموز')->where('class', $id)->pluck('id');
        $list = Discipline::whereIn('user_id', $users)->groupBy('user_id')
            ->selectRaw('*, sum(mark) as sum')
            ->get();
        $user_id = Discipline::whereIn('user_id', $users)->groupBy('user_id')
            ->selectRaw('*, sum(mark) as sum')
            ->pluck('user_id');
        $other = User::where('role', 'دانش آموز')->where('class', $id)->whereNotIn('id', $user_id)->orderBy('l_name')->get();

        return view('Admin.discipline.class', compact('list', 'other'));

    }

    /*
     * مشاهده موارد انضباطی یک دانش آموز
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($id)
    {
        $disiplins = Discipline::where('user_id', $id)->orderByDesc('mark')->get();
        $total = Discipline::where('user_id', $id)->orderByDesc('mark')->sum('mark');

        return view('Admin.discipline.single', compact('disiplins', 'total'));
    }

    /*
      حذف مورد انضباطی از جدول c_discipline*
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cdestroy($id)
    {
        $cdiscipline = CDiscipline::where('id', $id)->first();
        $cdiscipline->delete();
        $sdisciplines = Discipline::where('disciplines_id', $id)->get();
        foreach ($sdisciplines as $sdiscipline) {
            $sdiscipline->delete();
        }
        alert()->error('آیتم مورد نظر با موفقیت حذف شد.', 'حذف آیتم انضباطی')->autoclose(3000);
        return back();
    }

    /*
     آپدیت مورد انضباطی از جدول c_discipline*
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cupdate($id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'mark' => 'required'
        ]);
        $cdiscipline = CDiscipline::where('id', $id)->first();
        $cdiscipline->update([
            'name' => request('name'),
            'description' => request('description'),
            'mark' => request('mark'),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('آیتم مورد نظر با موفقیت ویرایش شد.', 'ویرایش آیتم انضباطی')->autoclose(3000);

        return redirect()->route('Admin.cdiscipline.manage');
    }

    /*
       صفحه ثبت مورد انضباطی برای دانش آموز*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function screate()
    {
        $students = User::where('role', 'دانش آموز')->get();
        $disciplines = CDiscipline::all();

        return view('Admin.discipline.screate', compact('students', 'disciplines'));
    }

    /*
     ایجاد مورد انضباطی دانش آموز در جدول discipline*
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sstore(Request $request)
    {

        $this->validate(request(), [
            'discipline' => 'required',
            'student' => 'required',
        ]);
        $mark = CDiscipline::where('id', $request->discipline)->pluck('mark')->first();
        $user = User::where('id', request('student'))->first();
        Discipline::create([
            'disciplines_id' => request('discipline'),
            'description' => request('description'),
            'user_id' => request('student'),
            'class' => $user->class,
            'paye' => $user->paye,
            'mark' => $mark,
            'date' => $request->date,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success(' مورد انضباطی با موفقیت ثبت شد.', 'ثبت مورد انضباطی')->autoclose(3000);

        return back();
    }

    /*
     * مشاهده موارد انضباطی ثبت شده برای دانش آموزان
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sindex(Request $request)
    {
        $disciplines = DB::table('disciplines')
            ->when($request->get('start_date'), function ($query) use ($request) {
                $query->where('date', '>=', $request->start_date);
            })
            ->when($request->get('end_date'), function ($query) use ($request) {

                $query->where('date', '<=', $request->end_date);
            })
            ->when($request->get('user_id'), function ($query) use ($request) {

                $query->where('user_id',  $request->user_id);
            })
            ->orderByDesc('date')
            ->paginate(20);
        $users = user::where('role', 'دانش آموز')->get();

        return view('Admin.discipline.sindex', compact('disciplines','users'));
    }

    /*
    حذف مورد انضباطی دانش آموز *
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sdestroy($id)
    {
        $row = Discipline::where('id', $id)->first();
        $row->delete();

        return back();
    }

    /*
     * لیست حضور و غیاب دانش موزان کلاس محور
     */
    /***
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function rollcall($id)
    {

        $data = RollCall::where('class_id', $id)->with('user')->orderByDesc('created_at')->get();
        if (count($data) == 0) {
            return back()->withErrors('اطلاعاتی وجود ندارد');
        }
        $clasid = User::where('id', $id)->pluck('class')->first();
        return view('Admin.absentlist', compact('data', 'clasid', 'id'));
    }

    public function rollcallindex($id)
    {
        $data = User::where('role', 'دانش آموز')->where('class', $id)->with('rollcall')->get();
        return view('Admin.rollcall.index', compact('data', 'id'));
    }

    public function presenttoabsent($id)
    {

        RollCall::create([
            'user_id' => $id,
            'author' => auth()->user()->id,
            'class_id' => User::where('id', $id)->pluck('class')->first(),
            'created_at' => Carbon::now(),
            'updated_at' => Jalalian::now(),
        ]);
//        alert()->success('وضعیت دانش آموز به غایب تغییر پیدا کرد', 'موفق');

        return back();
    }

    public function absenttopresent($id)
    {
        $rollcall = RollCall::find($id);
        $rollcall->delete();
        alert()->success('وضعیت دانش آموز به حاظر تغییر پیدا کرد', 'موفق');
        return back();
    }

    public function absentlist($id)
    {
        $data = RollCall::where('user_id', $id)->where('author', auth()->user()->id)->with('user')->orderByDesc('created_at')->get();
        $clasid = User::where('id', $id)->pluck('class')->first();
        return view('Admin.rollcall.absentlist', compact('data', 'clasid'));

    }


    public function chartall()
    {


        $disciplines = DB::table('disciplines')
            ->select(DB::raw('count(id) as count,  disciplines_id'))
            ->groupBy('disciplines_id')
            ->orderBy('count', 'desc')
            ->get();
//        return $disciplines;
        $name = [];
        $count = [];
        foreach ($disciplines as $discipline) {
            $count[] = $discipline->count;
            $name[] = CDiscipline::where('id', $discipline->disciplines_id)->pluck('name')->first();
        }
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('آیتم های انضباطی')
            ->elementLabel("تعداد")
            ->labels($name)
            ->values($count)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.discipline.charts.all', compact('chartt'));

    }


    public function chartclass($id)
    {

        $user_id = User::where('class', $id)->pluck('id');

        $disciplines = DB::table('disciplines')->whereIn('user_id', $user_id)
            ->select(DB::raw('count(id) as count,  disciplines_id'))
            ->groupBy('disciplines_id')
            ->orderBy('count', 'desc')
            ->get();
//        return $disciplines;
        $name = [];
        $count = [];
        foreach ($disciplines as $discipline) {
            $count[] = $discipline->count;
            $name[] = CDiscipline::where('id', $discipline->disciplines_id)->pluck('name')->first();
        }
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('آیتم های انضباطی')
            ->elementLabel("تعداد")
            ->labels($name)
            ->values($count)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.discipline.charts.class', compact('chartt', 'id'));

    }

    public function chartpaye($paye)
    {
        $idclass = clas::where('paye', $paye)->pluck('classnamber');

        $user_id = User::where('class', $idclass)->pluck('id');

        $disciplines = DB::table('disciplines')->whereIn('user_id', $user_id)
            ->select(DB::raw('count(id) as count,  disciplines_id'))
            ->groupBy('disciplines_id')
            ->orderBy('count', 'desc')
            ->get();
        $name = [];
        $count = [];
        foreach ($disciplines as $discipline) {
            $count[] = $discipline->count;
            $name[] = CDiscipline::where('id', $discipline->disciplines_id)->pluck('name')->first();
        }
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('آیتم های انضباطی')
            ->elementLabel("تعداد")
            ->labels($name)
            ->values($count)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.discipline.charts.paye', compact('chartt', 'paye'));

    }

    public function chartcomparisonpaye()
    {
        $disciplines = DB::table('disciplines')
            ->select(DB::raw('count(id) as count,  paye'))
            ->groupBy('paye')
            ->orderBy('count', 'desc')
            ->get();
//        return $disciplines;
        $paye = [];
        $count = [];
        foreach ($disciplines as $discipline) {
            $paye[] = $discipline->paye;
            $count[] = $discipline->count;
        }
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('آیتم های انضباطی')
            ->elementLabel("تعداد مورد ثبت شده")
            ->labels($paye)
            ->values($count)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.discipline.charts.comparisonpaye', compact('chartt'));
    }

    public function chartcomparisonclass()
    {
        $disciplines = DB::table('disciplines')
            ->select(DB::raw('count(id) as count,  class'))
            ->groupBy('class')
            ->orderBy('count', 'desc')
            ->get();
//        return $disciplines;
        $class = [];
        $count = [];
        foreach ($disciplines as $discipline) {
            $class[] = $discipline->class;
            $count[] = $discipline->count;
        }
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('آیتم های انضباطی')
            ->elementLabel("تعداد مورد ثبت شده")
            ->labels($class)
            ->values($count)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.discipline.charts.comparisonclass', compact('chartt'));
    }

    public function today_absent()
    {
        $data = RollCall::
        where('updated_at', Jalalian::now()->format('Y-m-d'))
            ->orderByDesc('user_id')
            ->groupBy('user_id')
            ->get();
        $details = RollCall::
        with('user')
            ->with('teacher')
            ->where('updated_at', Jalalian::now()->format('Y-m-d'))
            ->orderByDesc('user_id')
            ->get();
        $classR = clas::all();

        return view('Admin.rollcall.today', compact('data', 'classR', 'details'));
    }

    public function absent_ok($id)
    {
        $row = RollCall::where('id', $id)->first();
        $ok = 1;
        if ($row->ok == 1) {
            $ok = 0;
        }
        DB::table('roll_calls')
            ->where('id', $row->id)->update(['ok' => $ok]);

        alert()->success('وضعیت غیبت تغییر پیدا کرد', 'موفق');

        return back();
    }
}

