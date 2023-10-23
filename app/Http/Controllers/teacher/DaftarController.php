<?php

namespace App\Http\Controllers\teacher;

use App\Daftar;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaftarController extends Controller
{
    public function date($class, $dars)
    {
        return view('Teacher.daftar.date', compact('class', 'dars'));
    }

    public function select(Request $request)
    {

        $date = $request->date;
        $class = $request->class;
        $dars = $request->dars;
        $users = User::where('class', $request->class)
            ->where('role', 'دانش آموز')
            ->orderBy('l_name', 'desc')
            ->with(['daftar' => function ($query) use ($request) {
                $query->where('date', $request->date);
                $query->where('class_id', $request->class);
                $query->where('dars_id', $request->dars);
                $query->where('teacher_id', auth()->user()->id);
            }])
            ->with(['studentjtamrin' => function ($query) use ($request) {
                $query->where('updated_at', str_replace('/', '-', $request['date']));
                $query->where('class_id', $request->class);
                $query->where('teacher_id', auth()->user()->id);
            }])
            ->with(['rollcall' => function ($query) use ($request) {
                $query->where('updated_at', str_replace('/', '-', $request['date']));
                $query->where('class_id', $request->class);
                $query->where('author', auth()->user()->id);
            }])
            ->get();
        return view('includ.daftar', compact('users', 'class', 'dars', 'date'));

    }

    public function mark(Request $request)
    {
        $teacher = auth()->user()->id;
        foreach ($request->porsesh as $key => $porsesh) {

            $row = Daftar::where('user_id', $key)
                ->where('date', $request->date)
                ->where('class_id', $request->idclass)
                ->where('dars_id', $request->iddars)
                ->where('teacher_id', $teacher)
                ->first();
            if (!empty($row)) {
                $row->update([
                    'porsesh' => $porsesh,
                ]);
            } else {
                Daftar::create([
                    'user_id' => $key,
                    'teacher_id' => $teacher,
                    'dars_id' => $request->iddars,
                    'class_id' => $request->idclass,
                    'date' => $request->date,
                    'porsesh' => $porsesh,

                ]);
            }

        }
        foreach ($request->mosharecat as $key => $mosharecat) {

            $row = Daftar::where('user_id', $key)
                ->where('date', $request->date)
                ->where('class_id', $request->idclass)
                ->where('dars_id', $request->iddars)
                ->where('teacher_id', $teacher)
                ->first();
            if (!empty($row)) {
                $row->update([
                    'mosharecat' => $mosharecat,
                ]);
            } else {
                Daftar::create([
                    'user_id' => $key,
                    'teacher_id' => $teacher,
                    'dars_id' => $request->iddars,
                    'class_id' => $request->idclass,
                    'date' => $request->date,
                    'mosharecat' => $mosharecat,

                ]);
            }

        }
        alert()->success('عملیات با موفقیت انجام شد','عملیات موفق');

        $users = User::where('class', $request->idclass)
            ->where('role', 'دانش آموز')
            ->orderBy('l_name', 'desc')
            ->with(['daftar' => function ($query) use ($request) {
                $query->where('date', $request->date);
                $query->where('class_id', $request->idclass);
                $query->where('dars_id', $request->iddars);
                $query->where('teacher_id', auth()->user()->id);
            }])
            ->with(['studentjtamrin' => function ($query) use ($request) {
                $query->where('updated_at', str_replace('/', '-', $request['date']));
                $query->where('class_id', $request->idclass);
                $query->where('teacher_id', auth()->user()->id);
            }])
            ->with(['rollcall' => function ($query) use ($request) {
                $query->where('updated_at', str_replace('/', '-', $request['date']));
                $query->where('class_id', $request->idclass);
                $query->where('author', auth()->user()->id);
            }])
            ->get();
        $date = $request->date;
        $class = $request->idclass;
        $dars = $request->iddars;
        return view('includ.daftar', compact('users', 'class', 'dars', 'date'));
    }



}
