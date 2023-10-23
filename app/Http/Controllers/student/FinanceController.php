<?php

namespace App\Http\Controllers\student;

use App\Finanace;
use App\lib\EnConverter;
use App\LogFinanace;
use App\Models\Gateway;
use App\Models\Payment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

class FinanceController extends Controller
{
    public function index()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $user = User::where('id', $iduser)->first();
        $finance = Finanace::where('user_id', $user->id)->first();
        $log_finance = LogFinanace::where('user_id', $user->id)->orderBy('created_at')->get();
        $gateways = Gateway::active()->get();
        return view('student.finance.index',
            [
                'user' => $user,
                'finance' => $finance,
                'log_finance' => $log_finance,
                'gateways' => $gateways
            ]);
    }

    public function upload(Request $request)
    {

        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images/finance');
        $cover->move($path, $filename);
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();
        $finance = new LogFinanace();
        $finance->user_id = $iduser;
        $finance->price = $request->price;
        $finance->mime = $mime;
        $finance->original_filename = $original_filename;
        $finance->filename = $filename;
        $finance->type = 'fish';
        $finance->created_at = Jalalian::now();
        $finance->save();
        alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
        return back();
    }

    public function pay(Request $request)
    {
        # for change persian charakter
        $request->merge([
            'price' => EnConverter::bn2en($request->price)
        ]);
        # end

        $gateway = Gateway::active()->where('id',$request->gateway_id)->first();
        if(!$gateway){
            return response()->json([
                'message' => 'درگاه انتخاب شده معتبر نمی باشد.'
            ],400);
        }

        if($request->price > 100){
            $token = Str::random(50);
            Payment::create([
                'user_id' => auth()->user()->id,
                'amount' => $request->price,
                'gateway_id' => $gateway->id,
                'token' => $token,
                'date' => time(),
                'trans_id' => null,
                'id_get' => null,
                'type' => 'online',
                'status' => 'waiting',
                'ip' => $request->ip(),
            ]);

            $payment = Gateway::payment($gateway->id, $token);
            $payment = $payment->getData();
            if($payment->status == 200){
                return response()->json([
                    'url' => $payment->url
                ],200);
            }

            return response()->json([
                'message' => 'ارتباط با بانک برقرار نمی باشد. بعدا تلاش کنید!'
            ],400);
        }

        return response()->json([
            'message' => 'مبلغ باید بیش از 100 تومان باشد.'
        ],400);
    }
}
