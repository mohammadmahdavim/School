<?php

namespace App\Http\Controllers\student;

use App\Selection;
use App\SelectionMember;
use App\SelectionOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class SelectionController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $memeber = SelectionMember::where('user_id', $id)->where('active', 1)->pluck('selection_id');
        $selections = Selection::whereIn('id', $memeber)
            ->where('status', 1)
            ->where('date', '>=', Jalalian::now())
            ->with('item')
            ->get();
        return view('student.selection.index', ['rows' => $selections]);
    }

    public function past()
    {
        $id = auth()->user()->id;
        $memeber = SelectionMember::where('user_id', $id)->where('active', 0)->pluck('selection_id');
        $selections = Selection::whereIn('id', $memeber)
            ->where('status', 1)
            ->with('item')
            ->get();
        return view('student.selection.past', ['rows' => $selections]);
    }

    public function sabt($id)
    {
        $selection = Selection::where('id', $id)
            ->with('option')
            ->first();
        return view('student.selection.sabt', ['selection' => $selection]);

    }

    public function store(Request $request)
    {

        $permission = Selection::where('id', $request->selection_id)->pluck('permission')->first();

        if (!$request->option){
            alert()->warning('شما هیچ گزینه ای را انتخاب نکردید.', 'ناموفق');
            return back();
        }
        if (count($request->option) > $permission) {
            alert()->warning('تعداد رای شما بیش از حد مجاز است.', 'ناموفق');
            return back();
        }
        foreach ($request->option as $option) {

            $like = SelectionOption::where('Selection_id', $request->selection_id)->where('id', $option)->first();
            $like->update([
                'value' => ($like->value) + 1,
            ]);
        }
        $id = auth()->user()->id;
        $memeber = SelectionMember::where('user_id', $id)->where('Selection_id', $request->selection_id)->first();
        $memeber->update([
            'active'=>0,
        ]);
        alert()->warning(' رای شما با موفقیت ثبت شد.', 'موفق');

        return redirect('student/selection');

    }

    public function view($id){

        $row = SelectionOption::where('Selection_id', $id)
            ->with('selection')
            ->orderByDesc('value')
            ->get();
        return view('student.selection.optionview', ['row' => $row]);
    }
}
