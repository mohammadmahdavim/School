<?php

namespace App\Http\Controllers;

use App\PAnswer;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PAnswerController extends Controller
{
    public function store(Request $request)
    {

        //        اعتبار سنجی اطلاعات ارسالی از فرم

        $this->validate(request(), [
            'user_id' => 'required',
            'body' => 'required',
        ]);
        PAnswer::create([
            'user_id' => auth()->user()->id,
            'body' => request('body'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('نظر شما و تا پنج دقیقه بدون نیاز به ثبت مدیر در سایت قرار میگیرید', 'موفق')->autoclose(4000000);

        return back();


    }


    public function changeStatus(Request $request)
    {

        if (auth()->user()->role != 'دانش آموز' && auth()->user()->role != 'اولیا') {
            $karnameh = PAnswer::find($request->id);
            $karnameh->status = $request->status;
            $karnameh->save();

            return response()->json(['success' => 'Status change successfully.']);
        }
        else{
            return view('errors.404');
        }
    }
}
