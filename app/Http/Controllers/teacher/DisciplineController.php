<?php

namespace App\Http\Controllers\teacher;

use App\CDiscipline;
use App\Discipline;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class DisciplineController extends Controller
{


    public function index(Request $request, $id)
    {
//return $request;
        $disciplines = DB::table('disciplines')->where('class', $id)
            ->when($request->get('start_date'), function ($query) use ($request) {
                $query->where('date', '>=', $request->start_date);
            })
            ->when($request->get('end_date'), function ($query) use ($request) {

                $query->where('date', '<=', $request->end_date);
            })
            ->orderByDesc('date')
            ->paginate(20);

//return $disciplines;
        return view('Teacher.discipline.sindex', compact('disciplines', 'id'));
    }
    /*
      صفحه ثبت مورد انضباطی برای دانش آموز*
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function screate($id)
    {
        $students = User::where('class', $id)->where('role', 'دانش آموز')->orderBy('l_name', 'desc')->get();

        $disciplines = CDiscipline::all();
        return view('Teacher.discipline.screate', compact('students', 'disciplines', 'id'));
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
//        return $request;
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
}

