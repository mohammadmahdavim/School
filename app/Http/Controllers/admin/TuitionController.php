<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\PayTuition;
use App\Tuition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class TuitionController extends Controller
{
    public function index()
    {
        $tuitions = Tuition::with('class')->orderByDesc('created_at')->paginate(20);

        return view('Admin.tuition.index', compact('tuitions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $classschool = clas::orderBy('classnamber')->get();

        return view('Admin.tuition.create', compact('classschool'));
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'title' => 'required',
            'class_id' => 'required',
            'price' => 'required'
        ]);
        foreach ($request->class_id as $class) {
            Tuition::create([
                'title' => $request->title,
                'class_id' => $class,
                'price' => $request->price,
                'expire' => $request->date1,
                'created_at' => Jalalian::now(),
            ]);
        }
        alert()->success('شهریه با موفقیت افزوده شد', 'عملیات موفق');
        return redirect('admin/tuition');
    }

    public function delete($id)
    {
//        حذف از جدول   tuition
        $row = Tuition::where('id', $id)->first();
        $row->delete();

        //        حذف از جدول pay_tuition
        $paytuitions = PayTuition::where('tuitions_id', $id)->get();
        foreach ($paytuitions as $paytuition) {
            $paytuition->delete();
        }
        return back();
    }

    public function show($id)
    {
        $tuitions = Tuition::where('id', $id)->with('paytuition')->with('paytuition.user')->first();

        return view('Admin.tuition.show', compact('tuitions'));
    }


}
