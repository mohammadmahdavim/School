<?php

namespace App\Http\Controllers;

use App\Finanace;
use App\LogFinanace;
use App\Models\Gateway;
use App\Models\Payment;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{
    public function checkout(Request $request,$token)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }

        $payment = Payment::where('token', $token)
            ->where('status', 'waiting')
            ->where('user_id', $iduser)
            ->first();

        if($payment){
            $verify = Gateway::verify($token);
            if($verify){
                $price = Payment::where('trans_id', $request->Authority)->pluck('amount')->first();
                LogFinanace::create([
                    'user_id' => $iduser,
                    'price' => $price,
                    'type' => 'online',
                    'verify' => 1,
                ]);
                $finance = Finanace::where('user_id', $iduser)->first();
                $finance->update([
                    'paid' => $finance->paid + $price,
                    'remaining' => $finance->remaining - $price,
                    'updated_at' => Jalalian::now(),
                ]);

            alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
                return redirect('student/finance');
            }
            alert()->warning('عملیات پرداخت ناموفق بود. درصورت کسر پول ظرف 72 ساعت به حساب شما باز خواهد گشت.');
            return redirect('student/finance');
        }

        abort(404);
    }
}
