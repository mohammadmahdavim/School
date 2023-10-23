<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\ExamClass;
use App\Http\Controllers\Controller;
use App\paye;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
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
     مشاهده کلاس ها*
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paye = paye::all();
        $claass = DB::table('users')->distinct('class')->pluck('class');
        $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->get();

        return view('Admin.class.show', compact('claas', 'claass', 'paye'));
    }

    /*
     * ایجاد کلاس جدید
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $paye = paye::all();
        $claass = DB::table('clas')->orderBy('classnamber')->pluck('classnamber');

        return view('Admin.class.create', compact('paye', 'claass'));
    }

    /*
     * ایجاد کلاس در دیتابیس
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
                'magta' => 'required',
                'paye' => 'required',
                'classnamber' => 'required',
            ]
        );

        clas::create([
            'magta' => request('magta'),
            'reshte' => request('reshte'),
            'paye' => request('paye'),
            'classnamber' => request('classnamber'),
            'description' => request('description'),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),

        ]);
        alert()->success('کلاس  شما با موفقیت ایجاد شد', 'ایجاد کلاس')->autoclose(2000)->persistent('ok');
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
                'magta' => 'required',
                'paye' => 'required',
                'classnamber' => 'required',
            ]

        );
        $class = clas::where('id', $id)->first();
        $class->update([
            'magta' => $request->magta,
            'reshte' => $request->reshte,
            'paye' => $request->paye,
            'classnamber' => $request->classnamber,
            'description' => $request->description,
        ]);
        alert()->success('کلاس  شما با موفقیت ویرایش شد', 'ویرایش کلاس')->autoclose(2000)->persistent('ok');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clas = clas::where('id', $id)->first();
        $exams=ExamClass::where('class_id',$id)->get();
        foreach ($exams as $exam){
            $exam->delete();

        }
        $clas->delete();
        alert()->success('کلاس  شما با موفقیت حذف شد', 'حذف کلاس')->autoclose(2000)->persistent('ok');
        return back();
    }



    public function paye()
    {
        $payes = paye::all();
        return view('Admin.paye.index', compact('payes'));

    }

    public function payestore(Request $request)
    {
        $this->validate(request(), [

                'name' => ['required', 'unique:payes'],
            ]
        );
        paye::create([
            'name' => request('name'),
        ]);
        alert()->success('پایه با موفقیت ایجاد شد', 'عملیت موفق')->autoclose(2000)->persistent('ok');
        return back();
    }

    public function payedestroy($id)
    {

//        حذف از جدول   home
        $row = paye::where('id', $id)->first();
        $row->delete();

    }
}
