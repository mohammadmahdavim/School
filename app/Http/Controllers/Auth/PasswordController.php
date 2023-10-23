<?php

namespace App\Http\Controllers\Auth;

use App\ActivationCode;
use App\Events\UserActivation;
use App\lib\EnConverter;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.mobile');
    }

    public function checkMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|iran_mobile',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('mobile', $request->mobile)->first();
        if ($user == null) {
            return response()->json(['errors' => ['شماره وارد شده موجود نیست.']], 422);
        }

        event(new UserActivation($user));
        session()->put('mobile', $user->mobile);
        return redirect('/password/reset/verify');
    }

    public function againSmsVerify()
    {
        $mobile = Session::get('mobile');
        $user = User::where('mobile', $mobile)->first();
        event(new UserActivation($user));
        return response()->json(['message' => 'پیام دوباره ارسال گردید.'], 200);
    }

    public function verify()
    {
        if (empty(Session::get('mobile'))) {
            abort(404);
        }
        return view('auth.passwords.verify');
    }

    public function check(Request $request)
    {
        if (empty(Session::get('mobile'))) {
            abort(404);
        }
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
                if ($user->remember_token == null) {
                    $user->update([
                        'remember_token' => Str::random(60)
                    ]);
                }
                return response()->json(['token' => $user->remember_token], 200);
            }
            return response()->json(['error' => ['این کد منقضی شده است.']], 401);// code has expire
        }
        return response()->json(['error' => ['این کد صحیح نیست.']], 401);
    }

    public function reset(Request $request)
    {
        if ($request->has('rc')) {
            $user = User::where('remember_token', $request->rc)->first();
            if ($user == null) {
                abort(404);
            }
            return view('auth.passwords.reset');
        }
        abort(404);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $rc = $request->rc;
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('remember_token', $rc)->first();
        if ($user == null) {
            return response()->json(['errors' => ['خطایی در تغییر رمز رخ داد لطفا پس مدتی دوباره امتحان کنید.']], 422);
        }
        $password = EnConverter::bn2en($request->password);
        $user->update([
            'password' => Hash::make($password),
            'remember_token' => Str::random(60)
        ]);
        session()->forget('mobile');
        \Auth::loginUsingId($user->id);
//        return view('/profile')->response()->json(['message' => 'رمز عبور با موفقیت تغییر کرد.'], 200);
        return  response()->json(['message' => 'رمز عبور با موفقیت تغییر کرد.'], 200);

    }
}
