<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = '/profile';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'codemeli';
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ]);
    }

    public function authenticated()
    {

        $user = Auth::user();
        $user->expire_token = \Carbon\Carbon::now()->addMinutes(5);
        $user->save();
        if (auth()->user()->status!=1){
            alert()->warning('منتظر تایید  بمانید','ناموفق');

            return redirect('/profile');
        }
        if (auth()->user()->role == 'دانش آموز' or auth()->user()->role == 'اولیا') {
            alert()->success('به سایت خوش آمدید','موفق');
            return redirect('/student');

        } elseif (auth()->user()->role == 'معلم') {
            alert()->success('به سایت خوش آمدید','موفق');

            return redirect('/teacher');

        } else {
            alert()->success('به سایت خوش آمدید','موفق');

            return redirect('/admin/home');

        }
    }

}
