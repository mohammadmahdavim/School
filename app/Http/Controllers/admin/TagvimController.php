<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\dars;
use App\Day;
use App\TagvimS;
use App\TagvimT;
use App\teacher;
use App\Time;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagvimController extends Controller
{
    public function time()
    {
        $times = Time::all();
        return view('Admin.tagvim.time', compact('times'));
    }


    public function timestore(Request $request)
    {
        $this->validate(request(),
            [
                'start' => 'required',
                'end' => 'required',
                'name' => 'required',
            ]
        );
        $input = $request->all();
        Time::create($input);
        alert()->success('عملیات موفق', 'موفق');
        return back();
    }

    public function timeedit(Request $request, $id)
    {
        $this->validate(request(),
            [
                'start' => 'required',
                'end' => 'required',
                'name' => 'required',
            ]
        );
        $input = $request->all();
        Time::find($id)->update($input);
        alert()->success('عملیات موفق', 'موفق');
        return back();
    }

    public function timedelete($id)
    {
        $time = Time::find($id);
        $teacher = TagvimT::where('time', $id)->get();
        foreach ($teacher as $teache) {
            $teache->delete();
        }
        $students = TagvimS::where('time', $id)->get();
        foreach ($students as $student) {
            $student->delete();
        }
        $time->delete();
    }

    public function student()
    {
        $times = TagvimS::with('days')
            ->with('times')
            ->with('dars')
            ->get();
        $days = Day::all();
        $parts = Time::all();
        $class = clas::all();
        $doros = dars::all();

        return view('Admin.tagvim.student', compact('times', 'parts', 'days', 'class', 'doros'));
    }


    public function studentstore(Request $request)
    {
        $this->validate(request(),
            [
                'class_id' => 'required',
                'dars_id' => 'required',
                'day' => 'required',
                'time' => 'required',
            ]
        );
        $input = $request->all();
        TagvimS::create($input);
        alert()->success('عملیات موفق', 'موفق');
        return back();
    }

    public function studentdelete($id)
    {
        $time = TagvimS::find($id);
        $time->delete();
    }


    public function studentedit(Request $request, $id)
    {
        $this->validate(request(),
            [
                'class_id' => 'required',
                'dars_id' => 'required',
                'day' => 'required',
                'time' => 'required',
            ]
        );
        $input = $request->all();
        TagvimS::find($id)->update($input);
        alert()->success('عملیات موفق', 'موفق');
        return back();
    }

    public function teacheredit(Request $request, $id)
    {
        $this->validate(request(),
            [
                'user_id' => 'required',
                'class_id' => 'required',
                'day' => 'required',
                'time' => 'required',]
        );
        $input = $request->all();
        $row = TagvimT::find($id);

        $class = teacher::where('id', $request->class_id)->first();
        $row->update([
            'user_id' => $request->user_id,
            'day' => $request->day,
            'time' => $request->time,
            'class_id' => $class->class_id,
            'dars_id' => $class->dars,
        ]);
        alert()->success('عملیات موفق', 'موفق');
        return back();
    }


    public function teacher()
    {
        $times = TagvimT::with('days')->with('user')->with('times')->get();
        $days = Day::all();
        $parts = Time::all();
        $class = teacher::with('darss')->get();
        $teachers = User::where('role', 'معلم')->get();
//        return $class[0]->darss[0]->name;
        return view('Admin.tagvim.teacher', compact('times', 'parts', 'days', 'class', 'teachers'));
    }


    public function teacherstore(Request $request)
    {
        $this->validate(request(),
            [
                'user_id' => 'required',
                'class_id' => 'required',
                'day' => 'required',
                'time' => 'required',]
        );
        $class = teacher::where('id', $request->class_id)->first();
        TagvimT::create([
            'user_id' => $request->user_id,
            'day' => $request->day,
            'time' => $request->time,
            'class_id' => $class->class_id,
            'dars_id' => $class->dars,
        ]);
        alert()->success('عملیات موفق', 'موفق');
        return back();
    }

    public function teacherdelete($id)
    {
        $time = TagvimT::find($id);
        $time->delete();
    }
}
