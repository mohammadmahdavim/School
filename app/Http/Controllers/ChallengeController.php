<?php

namespace App\Http\Controllers;

use App\challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class ChallengeController extends Controller
{

    /*
     * ایجاد اتاق جدید توسط دبیر و مدیر
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {
            return view('challenge.create');
        } else {
            return view('errors.404');
        }
    }

    /*
     * ایجاد اتاق گفتمان در دیتابیس
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
        ]);


        //        ایجاد تالار جیدی در جدول challenge
        $jDate = Jalalian::now();
        $id = challenge::create([
            'user_id' => auth()->user()->id,
            'title' => request('title'),
            'description' => request('description'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;

        if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {
            $row = challenge::where('id', $id)->first();
            $row->update([
                'status' => 1,
            ]);
        }
        return redirect()->route('challenge.show')->with('status', 'تالار شما با موفقیت ایجاد شد');
    }

    /*
     * نمایش اتاق های ایجاد شده
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {

        if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {

            $challenges = DB::table('challenges')->orderBy('created_at', 'desc')->get();

            return view('challenge.show', compact('challenges'));
        } else {
            return view('errors.404');
        }
    }

    /*
     * تایید و یا عدم تایید اتاق گفتگو
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function changeStatus(Request $request)
    {

        if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {

            $RTamas = challenge::find($request->id);
            $RTamas->status = $request->status;
            $RTamas->save();
            return response()->json(['success' => 'Status change successfully.']);
        } else {
            return view('errors.404');
        }

    }

    /*
     *حذف اتاق
     */
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {

        $row = challenge::where('id', $id)->first();
        $row->delete();
        return back();
    }
}
