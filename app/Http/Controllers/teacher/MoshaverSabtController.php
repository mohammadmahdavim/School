<?php

namespace App\Http\Controllers\teacher;

use App\MoshaverSabt;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoshaverSabtController extends Controller
{
    public function index($id)
    {
        $data = User::where('role', 'دانش آموز')->where('class', $id)->get();
        return view('Teacher.moshaver.index', compact('data', 'id'));
    }


    public function store(Request $request)
    {
        $this->validate(request(),
            [
                'date-picker-shamsi-list' => 'required',
                'text' => 'required',
                'user_id' => 'required',
                'class_id' => 'required',
            ]
        );
        MoshaverSabt::create([
            'user_id' => $request->user_id,
            'teacher_id' => auth()->user()->id,
            'class_id' => $request->class_id,
            'date' => $request['date-picker-shamsi-list'],
            'text' => $request->text,
        ]);

        alert()->success('گزارش با موفقیت ثبت گردید', 'عملیات موفق');
        return back();
    }

    public function show($id)
    {
        $data = MoshaverSabt::where('user_id', $id)->with('user')->get();
        return view('Teacher.moshaver.show', compact('data'));
    }

    public function destroy($id)
    {
        $row = MoshaverSabt::find($id);
        $row->delete();
    }
}
