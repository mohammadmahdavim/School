<?php

namespace App\Http\Controllers\admin;

use App\dars;
use App\MessageReseiver;
use App\paye;
use App\teacher;
use App\TeacherPrograme;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\clas;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{


    /*
     * مشاهده لیست دبیران
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dars = dars::all()->sortBy('paye')->sortBy('name')->unique('name');
        $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->get();
        $users = User::where('role', 'معلم')->orderBy('id')->get();

        return view('Admin.teacher.show', compact('users', 'dars', 'claas'));
    }


    /*
     * صفحه ایجاد دبیر ایجاد
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createteacher($id)
    {
        $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->get();
        $dars = dars::all()->sortBy('paye')->sortBy('name');

        if ($id == 1) {
            return view('Admin.teacher.create1', compact('claas', 'dars'));
        } elseif ($id == 2) {
            return view('Admin.teacher.create2', compact('claas', 'dars'));
        }
    }


    /*
   * ایجاد معلم جدید در دیتابیس (users_table && teachers_table)
   */
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
                'f_name' => 'required',
                'l_name' => 'required',
                'codemeli' => ['required', 'unique:users'],
                'password' => 'required',
                'role' => 'required',
                'class' => 'required',
                'dars' => 'required',
            ]

        );

        $id = User::create([
            'f_name' => request('f_name'),
            'l_name' => request('l_name'),
            'codemeli' => request('codemeli'),
            'mobile' => request('phone'),
            'password' => Hash::make(request('password')),
            'password_show' => request('password'),
            'role' => request('role'),
            'status' => 1,


        ])->id;
        if ($request->type == 2) {
            foreach ($request->class as $clas) {
                teacher::create([
                    'user_id' => $id,
                    'class_id' => $clas,
                    'dars' => request('dars'),
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(),

                ]);
            }
        } elseif ($request->type == 1) {
            foreach ($request->dars as $dars) {
                teacher::create([
                    'user_id' => $id,
                    'class_id' => request('class'),
                    'dars' => $dars,
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(),


                ]);
            }
        }
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(2000)->persistent('ok');

        return back();
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('Admin.teacher.edit', compact('user'));
    }

    /*
     * ویرایش معلم  در دیتابیس (users_table && teachers_table)
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
                'f_name' => 'required',
                'l_name' => 'required',
            ]

        );

        $user = User::where('id', $id)->first();
        $cover = $request->file('file');

        if (!empty($cover)) {
            $filename = time() . '.' . '.png';
            $path = public_path('/uploads/' . $filename);
            Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
            $original_filename = $cover->getClientOriginalName();
            $user->update([
                'l_name' => $request->l_name,
                'f_name' => $request->f_name,
                'original_filename' => $original_filename,
                'resizeimage' => $original_filename,
                'filename' => $filename,

            ]);
        } else {
            $user->update([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
            ]);
        }


        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(2000)->persistent('ok');

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $teacher = teacher::where('user_id', $id)->first();

        $user->delete();
        $teacher->delete();

        return back();
    }


    /*
     برنامه حضور دبیران در مدرسه*
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function program()
    {
        $programs = TeacherPrograme::all()->unique('teacher_id');
        $programdays = TeacherPrograme::all();

        return view('Admin.teacher.program', compact('programdays', 'programs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyclass($id)
    {
        $teacher = teacher::where('id', $id)->first();
        $teacher->delete();
        return back();
    }


    public function showclass($id)
    {
        $dars = dars::all();
        $class = clas::all();
        $rowclass = teacher::where('user_id', $id)->with('darss')->with('class')->get();
        return view('Admin.teacher.class', compact('rowclass', 'dars', 'class', 'id'));
    }

    public function addclass(Request $request)
    {
        $this->validate(request(), [
                'class' => 'required',
                'dars' => 'required',
            ]

        );
        $user = User::where('id', $request->teacher)->first();
        $user->update([
            'status' => 1,
        ]);
        foreach ($request->dars as $dars) {
            if (!teacher::where('user_id', $request->teacher)->where('class_id', $request->class)->where('dars', $dars)->first())
                teacher::create([
                    'user_id' => $request->teacher,
                    'class_id' => $request->class,
                    'dars' => $dars,
                ]);
        }

        alert()->success('کلاس و درس با موفقیت افزوده شد', 'موفق');
        return back();

    }

    public function getDars(Request $request)
    {
        $paye = clas::where('classnamber', $request->class_id)->pluck('paye')->first();

        $data['dars'] = dars::where("paye", $paye)
            ->get(["name", "id", 'paye']);
        return response()->json($data);
    }


}
