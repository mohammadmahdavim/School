<?php

namespace App\Http\Controllers\teacher;

use App\clas;
use App\dars;
use App\Http\Controllers\Controller;
use App\RollCall;
use App\teacher;
use App\TeacherPresentDate;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class RollCallController extends Controller
{
    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
//        return Carbon::now()->toDateString();
        $data = User::where('role', 'دانش آموز')->where('class', $id)
            ->with('rollcall')
            ->get();
        return view('Teacher.rollcall.index', compact('data', 'id'));
    }


    public function presenttoabsent($id)
    {
        $user = User::where('id', $id)->first();
        \App\lib\Kavenegar::sendSMS($user->mobile, '', '');

        RollCall::create([
            'user_id' => $id,
            'author' => auth()->user()->id,
            'class_id' => User::where('id', $id)->pluck('class')->first(),
            'updated_at' => Jalalian::now(),
            'created_at' => Carbon::now(),
        ]);
        alert()->success('وضعیت دانش آموز به غایب تغییر پیدا کرد', 'موفق');

        return back();
    }

    public function absenttopresent($id)
    {
        $rollcall = RollCall::find($id);
        $rollcall->delete();
        alert()->success('وضعیت دانش آموز به حاظر تغییر پیدا کرد', 'موفق');
        return back();
    }

    public function absentlist($id)
    {
        $data = RollCall::where('user_id', $id)->where('author', auth()->user()->id)->with('user')->orderByDesc('created_at')->get();
        $clasid = User::where('id', $id)->pluck('class')->first();
        return view('Teacher.rollcall.absentlist', compact('data', 'clasid'));

    }

    public function absentlistall($id)
    {
        $data = RollCall::where('class_id', $id)->where('author', auth()->user()->id)->with('user')->orderByDesc('created_at')->get();
        if (count($data) == 0) {
            return back()->withErrors('اطلاعاتی وجود ندارد');
        }
        $clasid = $id;
        return view('Teacher.rollcall.absentlist', compact('data', 'clasid'));
    }

    public function done($id)
    {
        $class=clas::where('classnamber',$id)->pluck('id')->first();
        $check = TeacherPresentDate::where('user_id', auth()->user()->id)->where('class_id', $class)->where('created_at', Carbon::now()->toDateString())->first();
        if (!$check) {
            TeacherPresentDate::create([
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()->toDateString(),
                'class_id' => $class
            ]);
        }
        alert()->success('اطلاعات ثبت شد', 'موفق');
        return back();
    }
}
