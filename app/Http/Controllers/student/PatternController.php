<?php

namespace App\Http\Controllers\student;

use App\clas;
use App\dars;
use App\Day;
use App\pattern;
use App\patternItem;
use App\patternItemAnswer;
use App\patternStatus;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatternController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $userId = auth()->user()->id - 1000;
        }
        $user = User::find($userId);
        $patterns = pattern::where('class_id', $user->class)->orderBy('created_at', 'desc')->paginate(20);

        return view('student.pattern.index', ['patterns' => $patterns]);
    }


    public function doros($id)
    {
        $pattern = pattern::find($id);
        $classId = $pattern->class_id;
        $paye = clas::where('classnamber', $classId)->pluck('paye')->first();
        $doros = dars::where('paye', $paye)->get();
        $days = Day::all();
        $statuses = patternStatus::all();
        $patternItems = patternItem::where('pattern_id', $id)->orderBy('day_id', 'desc')->get();
        $patternItems = $patternItems->groupBy('day_id');
        return view('student.pattern.doros', ['patternItems' => $patternItems, 'doros' => $doros, 'pattern' => $pattern, 'days' => $days, 'statuses' => $statuses]);
    }


    public function date($id)
    {
        return view('student.pattern.date', ['pattern' => $id]);
    }

    public function sabt(Request $request)
    {
        $pattern = pattern::where('id', $request->pattern)->first();
        $patternItem = patternItem::where('pattern_id', $request->pattern)->pluck('dars_id');
        $doros = dars::whereIn('id', $patternItem)->get();
        $answers = patternItemAnswer::where('user_id', auth()->user()->id)->where('date', $request->date)->get();
        $statuses = patternStatus::all();
        return view('student.pattern.sabt', ['statuses' => $statuses, 'pattern' => $pattern, 'answers' => $answers, 'doros' => $doros, 'date' => $request->date]);
    }

    public function sabtDars(Request $request)
    {
        $this->foreachDorosPattern($request->time, 'time', $request->date);
        $this->foreachDorosPattern($request->status, 'status', $request->date);
        $this->foreachDorosPattern($request->description, 'description', $request->date);
        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return redirect('/student/pattern');
    }

    public function foreachDorosPattern($rows, $column, $date)
    {
        foreach ($rows as $dars => $value) {
            $patternItemAnswer = patternItemAnswer::where('date', $date)->where('dars_id', $dars)->where('user_id', auth()->user()->id)->first();
            if ($patternItemAnswer) {
                $this->patternItemAnswerUpdate($patternItemAnswer, $column, $value);
            } else {
                $this->patternItemAnswerStore($column, $value, $dars, $date);
            }
        }
    }

    public function patternItemAnswerUpdate($patternItem, $key, $value)
    {
        $patternItem->update([$key => $value]);
    }

    public function patternItemAnswerStore($column, $value, $darsId, $date)
    {
        patternItemAnswer::create(['user_id' => auth()->user()->id, 'dars_id' => $darsId, $column => $value, 'date' => $date]);
    }
}

