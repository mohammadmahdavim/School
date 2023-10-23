<?php

namespace App\Http\Controllers\admin;

use App\CKarnameh;
use App\Http\Controllers\Controller;
use App\RKarnameh;
use App\SKarnameh;
use App\student;
use App\teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class RKarnamehController extends Controller
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
     * صفحه ارسال درخواست ایجاد کارنامه
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Admin.karnameh.index');
    }

    /*
     * ایجاد کارنامه در دیتابیس
     */
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
                'name' => 'required',
            ]
        );

        $jdate = Jalalian::now();
        RKarnameh::create([
            'name' => request('name'),
            'status' => 1,
            'created_at' => $jdate,
            'updated_at' => $jdate,
        ]);
        alert()->success('درخواست شما با موفقیت ثبت شد', '  درخواست کارنامه')->autoclose(2000)->persistent('ok');
        return back();
    }

    /*
     * نمایش وضعیت تولید کارنامه های درخواستی
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        return view('Admin.karnameh.show', compact('karnamehs'));
    }

    /*
     * اجازه و عدم اجازه تولید کارنامه توسط دبیران
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $karnameh = RKarnameh::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    /*
     * حذف کارنامه
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $karnameh = RKarnameh::where('id', $id)->first();
        $skarnameh = SKarnameh::where('karnameh_id', $id)->get();
        $ckarnameh = CKarnameh::where('id_karnameh', $id)->get();
        foreach ($skarnameh as $skarname) {
            $skarname->delete();

        }
        foreach ($ckarnameh as $ckarname) {
            $ckarname->delete();
        }
        $karnameh->delete();
        return back();

    }

    /*
     *وضعیت کارنامه های تولیدی توسط دبیران
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showdetails($id)
    {
        $teachers = teacher::all()->unique('user_id');
        return view('Admin.karnameh.details', compact('teachers', 'id'));
    }


    /*
     * مشاهده معدل های دانش آموزان در یک کارنامه انتخابی
     */
    /**
     * @param $idk
     * @param $idc
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function student($idk, $idc)
    {
        $students = student::where('classid', $idc)->get();
        return view('Admin.karnameh.student', compact( 'idc', 'idk', 'students'));
    }

    /*
     * مشاهده جزییات کارنامه یک دانش آموز
     */
    /***
     * @param $idk
     * @param $ids
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function studentshow($idk, $ids)
    {
        $mykarnamehs = SKarnameh::where('karnameh_id', $idk)->where('user_id', $ids)->get();
        if (empty($mykarnamehs[0])) {
            alert()->warning('اطلاعاتی برای نمایش وجود ندارد.', 'ناموفق')->autoclose(3000);
            return back();
        }
        $id=$ids;
        $user=User::find($id);
        $class=$user->class;
        $paye=$user->paye;
        return view('Admin.karnameh.skarnameh', compact( 'mykarnamehs', 'idk', 'id','class','paye'));
    }


}

