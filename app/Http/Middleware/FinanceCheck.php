<?php

namespace App\Http\Middleware;

use App\Finanace;
use App\LogFinanace;
use App\Setting;
use Closure;
use Morilog\Jalali\Jalalian;

class FinanceCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $setting = Setting::where('id', 1)->first();
        $cheque = LogFinanace::whereIn('type', ['cheque', 'cache'])
            ->where('user_id', auth()->user()->id)
            ->where('verify', 0)
            ->where('cheque_date', '<', Jalalian::now())
            ->first();

        $chequeSms = LogFinanace::whereIn('type', ['cheque', 'cache'])
            ->where('user_id', auth()->user()->id)
            ->where('verify', 0)
            ->where('sms', 0)
            ->where('cheque_date', '<', Jalalian::now()->addDays(2))
            ->first();

        if ($chequeSms) {
            \App\lib\Kavenegar::sendCheque(auth()->user()->mobile, $chequeSms->cheque_number, $chequeSms->price);
            $chequeSms->update(['sms' => 1]);
        }

        if ($setting->finance_status == 1 and $cheque) {
            alert()->error('ابتدا شهریه خود را پرداخت کنید.', 'ورود ناموفق');
            return redirect('/student/finance');
        }
        $userFinance=Finanace::where('user_id',auth()->user()->id)->first();
     if($userFinance)
     {
            if ($setting->finance_status == 0 or $userFinance->dead_time == '') {
            return $next($request);
        } else {
            $status = $this->checkDate($userFinance->dead_time);
            if ($status == 'not_expire') {
                return $next($request);
            } else {
                $status = $this->checkFinance();
                if ($status == 'true') {
                    return $next($request);
                } else {
                    alert()->error('ابتدا شهریه خود را پرداخت کنید.', 'ورود ناموفق');
                    return redirect('/student/finance');
                }
            }
        }
     }

else{
    
                return $next($request);

}
    }

    public function checkDate($date)
    {
        $date = explode('-', $date);
        $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
        $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
        $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
        $nowTimestamp = \Morilog\Jalali\Jalalian::forge("now")->getTimestamp();
        if ($dateEx >= $nowTimestamp) {
            return 'not_expire';
        } else {
            return 'expire ';
        }
    }

    public function checkFinance()
    {
        $user = auth()->user()->id;
        $finance = Finanace::where('user_id', $user)->first();
        if ($finance) {
            if ($finance->remaining == 0 or $finance->status == 1) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            return 'true';

        }

    }
}
