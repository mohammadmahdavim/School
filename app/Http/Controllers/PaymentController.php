<?php

namespace App\Http\Controllers;

use App\Finanace;
use App\lib\Kavenegar;
use App\LogFinanace;
use App\Models\Gateway;
use App\Models\Payment;
use App\Reserve;
use App\Setting;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{
    public function checkout(Request $request, $token)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }

        $payment = Payment::where('token', $token)
            ->where('status', 'waiting')
            ->where('user_id', $iduser)
            ->first();

        if ($payment) {
            $verify = Gateway::verify($token);
            if ($verify) {
                if ($payment->for == 'product') {

                    $reserve = Reserve::where('id', $payment->table_id)->update(['payed' => 1]);
                    if (Setting::where('id', 1)->pluck('product_sms')->first() == 1) {
                        Kavenegar::sendSMS(auth()->user()->mobile, $reserve->code, 'product');
                    }
                    alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
                    return redirect('/student/reserves');
                } else {
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
                }


                alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
                return redirect('student/finance');
            }
            alert()->warning('عملیات پرداخت ناموفق بود. درصورت کسر پول ظرف 72 ساعت به حساب شما باز خواهد گشت.');
            return redirect('student/finance');
        }

        abort(404);
    }
}
