<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\dars;
use App\Day;
use App\pattern;
use App\patternItem;
use App\patternItemAnswer;
use App\patternStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatternController extends Controller
{


    public function index()
    {
        $patterns = pattern::paginate(20);

        return view('Admin.pattern.index', ['patterns' => $patterns]);
    }

    public function create()
    {
        $allclas = clas::all();

        return view('Admin.pattern.create', ['allclas' => $allclas]);
    }

    public function store(Request $request)
    {
        $this->validate(request(),
            [
                'name' => 'required',
                'date_from' => 'required',
                'class_id' => 'required',
            ]
        );
        $pattern = pattern::create([
            'author' => auth()->user()->id,
            'name' => $request->name,
            'date_from' => $request->date_from,
            'date_to' => $request->input('date-picker-shamsi-list'),
            'class_id' => $request->class_id,
            'status' => 1,
        ]);

        $classId = $pattern->class_id;
        $paye = clas::where('classnamber', $classId)->pluck('paye')->first();
        $doros = dars::where('paye', $paye)->get();

        $this->storeDorosItem($doros, $pattern->id);

        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return redirect('/admin/pattern/doros/' . $pattern->id);
    }

    public function edit($id)
    {
        $row = pattern::find($id);
        $allclas = clas::all();

        return view('Admin.pattern.edit', ['row' => $row, 'allclas' => $allclas]);

    }

    public function update(Request $request, $id)
    {
        $this->validate(request(),
            [
                'name' => 'required',
                'date_from' => 'required',
                'class_id' => 'required',
            ]
        );
        $pattern = pattern::find($id);
        $classId = $pattern->class_id;
        $paye = clas::where('classnamber', $classId)->pluck('paye')->first();
        $newpaye = clas::where('classnamber', $request->class_id)->pluck('paye')->first();
        if ($paye != $newpaye) {
            $items = patternItem::where('pattern_id', $pattern->id)->get();
            foreach ($items as $item) {
                $item->delete();
            }
            $doros = dars::where('paye', $newpaye)->get();
            $this->storeDorosItem($doros, $pattern->id);
        }
        $pattern->update([
            'name' => $request->name,
            'date_from' => $request->date_from,
            'date_to' => $request->input('date-picker-shamsi-list'),
            'class_id' => $request->class_id,
            'status' => 1,
        ]);

        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return back();
    }

    public function changeStatus(Request $request)
    {
        $karnameh = pattern::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
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
        return view('Admin.pattern.doros', ['patternItems' => $patternItems, 'doros' => $doros, 'pattern' => $pattern, 'days' => $days, 'statuses' => $statuses]);
    }

    public function dorosStore(Request $request)
    {
        $pattern = $request->pattern;
        $this->foreachDorosPattern($request->time, 'time', $pattern);
        $this->foreachDorosPattern($request->status, 'status', $pattern);
        $this->foreachDorosPattern($request->description, 'description', $pattern);
        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return back();
    }


    public
    function destroy($id)
    {
        $pattern = pattern::find($id);
        $pattern->delete();
    }

    public function storeDorosItem($doros, $pattern)
    {
        $days = Day::all();

        foreach ($doros as $dars) {
            foreach ($days as $day) {
                patternItem::create(['pattern_id' => $pattern, 'day_id' => $day->id, 'dars_id' => $dars->id]);

            }
        }
    }

    public function foreachDorosPattern($rows, $column, $pattern)
    {
        foreach ($rows as $day => $days) {
            foreach ($days as $darsId => $row) {
                $patternItem = patternItem::where('pattern_id', $pattern)->where('dars_id', $darsId)->where('day_id', $day)->first();
                if ($patternItem) {
                    $this->patternItemUpdate($patternItem, $column, $row);
                } else {
                    $this->patternItemStore($pattern, $column, $row, $day, $darsId);
                }
            }
        }
    }

    public function patternItemUpdate($patternItem, $key, $value)
    {
        $patternItem->update([$key => $value]);

    }

    public function patternItemStore($paaternId, $key, $value, $day, $darsId)
    {
        patternItem::create(['pattern_id' => $paaternId, 'day_id' => $day, 'dars_id' => $darsId, $key => $value]);

    }

    public function dailyReport()
    {
        return view('Admin.pattern.report.date');

    }

    public function daily(Request $request)
    {
        $answers = patternItemAnswer::where('date', '>=', $request->date_from)->where('date', '<=', $request->date_to)->with('dars')->with('statuss')->whereNotNull('time')->get();
        $answers = $answers->groupBy('user_id');
        return view('Admin.pattern.report.daily', ['answers' => $answers, 'date_from' => $request->date_from, 'date_to' => $request->date_to]);
    }

    public function monthReport()
    {
        return view('Admin.pattern.report.monthReport');
    }

    public function month(Request $request)
    {
        $dateFrom = '1400/' . $request->month . '/00';
        $dateTo = '1400/' . $request->month . '/31';
        $answers = patternItemAnswer::where('date', '>=', $dateFrom)->where('date', '<=', $dateTo)->whereNotNull('time')->get();
        $answers = $answers->groupBy('user_id');
        $dates = [];
        for ($i = 1; $i <= 31; $i++) {
            if ($i < 10) {
                $dates[] = '1400/' . $request->month . '/0' . $i;
            } else {
                $dates[] = '1400/' . $request->month . '/' . $i;
            }
        }

        return view('Admin.pattern.report.month', ['answers' => $answers, 'month' => $request->month, 'dates' => $dates]);
    }
}


