<?php

namespace App\Http\Controllers\Auth;

use App\ActivationCode;
use App\Cart;
use App\Events\UserActivation;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:6,1');
    }

    public function index()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $code = $request->code;
        $mobile = Session::get('mobile');
        $user = User::where('mobile', $mobile)->first();
        $activation = ActivationCode::where('code', $code)
            ->where('user_id', $user->id)
            ->where('used', 0)
            ->orderby('id', 'desc')
            ->first();
        if ($activation != null) {
            if ($activation->expire >= Carbon::now()) {
                $activation->update([
                    'used' => 1
                ]);
                User::find($activation->user_id)->update(['mobile_verified' => '1']);
                Wallet::create([
                    'user_id' => $activation->user_id,
                    'balance' => 0,
                    'valid' => 0
                ]);
                Auth::loginUsingId($activation->user_id);
                $basket = session()->get('cart');
                $user_id = $activation->user_id;
                if ($basket && count(session('cart')) != 0) {
                    foreach (session('cart') as $id => $item) {
                        $cart = Cart::where('user_id', $user_id)
                            ->where('price_id', $item['price_id'])
                            ->where('status', 1)->first();
                        if ($cart == null) {
                            Cart::create([
                                'user_id' => $user_id,
                                'price_id' => $item['price_id'],
                                'quantity' => $item['quantity'],
                                'status' => 1,
                                'size_id' => $item['size_id']
                            ]);
                        } else {
                            $quantity = $cart->quantity;
                            $cart->update([
                                'quantity' => $quantity + $item['quantity'],
                            ]);
                        }
                    }
                }
                session()->forget('mobile');
                session()->forget('cart');
                return response()->json(['message' => 'ثبت نام با موفقیت کامل شد.'], 200);
            }
            return response()->json(['error' => ['این کد منقضی شده است.']], 401);// code has expire
        }
        return response()->json(['error' => ['این کد صحیح نیست.']], 401);
    }

    public function againSmsVerify()
    {
        $mobile = Session::get('mobile');
        $user = User::where('mobile', $mobile)->first();
        event(new UserActivation($user));
        return response()->json(['message' => 'پیام دوباره ارسال گردید.'], 200);
    }
}
