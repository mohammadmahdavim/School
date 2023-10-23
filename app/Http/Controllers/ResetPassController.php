<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPassController extends Controller
{
    public function index(Request $request)
    {
        $this->validate(request(),
            [
                'codemeli' => 'required|integer|digits:10',
            ]
        );
        $codmeli = $request->codemeli;
        $exist = User::where('codemeli', $codmeli)->first()['codemeli'];
        if ($codmeli == $exist) {
            $exist = User::where('codemeli', $codmeli)->first();

            $exist->update([
                'password' => Hash::make($request['codemeli']),
            ]);
            alert()->success('رمز عبور جدید شما کد ملی شما می باشد.', 'موفق')->autoclose(2000)->persistent('ok');

            return redirect()->route('login');
        } else {
            alert()->error(' کد ملی وارد شده صحیح نمی باشد.', 'ناموفق')->autoclose(2000)->persistent('ok');

            return back();
        }
    }
}
