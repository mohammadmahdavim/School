<?php

namespace App\Http\Controllers\admin;

use App\CMark;
use App\dars;
use App\MessageReseiver;
use App\paye;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SMSController extends Controller
{
    public function index()
    {
        $claas = DB::table('clas')
            ->orderBy('paye')->orderBy('classnamber')
            ->get();
        $paye = paye::all();
        $dars = dars::all()->sortBy('paye')->sortBy('name');
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();

        return view('Admin.sms.manage', compact('claas', 'paye', 'dars', 'karnamehs', 'count'));
    }

    public function charge(Request $request)
    {

    }

    public function create()
    {
        $claas = DB::table('clas')
            ->orderBy('paye')->orderBy('classnamber')
            ->get();
        $paye = paye::all();
        $dars = dars::all()->sortBy('paye')->sortBy('name');
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();

        $clacs = DB::table('users')->where('role', 'دانش آموز')->distinct('class')->pluck('class');

        $allusers = User::all()->sortBy('role');
        return view('Admin.sms.send', compact('claas', 'paye', 'dars', 'karnamehs', 'count', 'clacs', 'allusers'));

    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'body' => 'required',
            'to' => 'required'
        ]);
        $reseivers = $request->to;

        foreach ($reseivers as $reseiver) {
            $claass = DB::table('users')->where('role', 'دانش آموز')->distinct('class')->pluck('class');
            foreach ($claass as $claas) {
                if ($claas == $reseiver) {
                    $usres = User::where('class', $claas)->pluck('id');
                    foreach ($usres as $user) {
                        MessageReseiver::create([
                            'mail_id' => $mail_id,
                            'user_id' => $user,
                            'status' => 0,
                            'author' => $user_id,
                            'time' => time(),
                            'important' => 0,
                        ]);
                    }
                }
            }

            if ($reseiver == 'dabir') {
                $users = User::where('role', 'معلم')->pluck('id');
                foreach ($users as $user) {
                    MessageReseiver::create([
                        'mail_id' => $mail_id,
                        'user_id' => $user,
                        'status' => 0,
                        'author' => $user_id,
                        'time' => time(),
                        'important' => 0,
                    ]);
                }
            } elseif ($reseiver == 'parent') {
                $users = User::where('role', 'اولیا')->pluck('id');
                foreach ($users as $user) {
                    MessageReseiver::create([
                        'mail_id' => $mail_id,
                        'user_id' => $user,
                        'status' => 0,
                        'author' => $user_id,
                        'time' => time(),
                        'important' => 0,
                    ]);
                }
            } elseif ($reseiver == 'student') {
                $users = User::where('role', 'دانش آموز')->pluck('id');
                foreach ($users as $user) {
                    MessageReseiver::create([
                        'mail_id' => $mail_id,
                        'user_id' => $user,
                        'status' => 0,
                        'author' => $user_id,
                        'time' => time(),
                        'important' => 0,
                    ]);
                }
            } else {
                $users = User::where('codemeli', $reseiver)->pluck('id');
                foreach ($users as $user) {
                    MessageReseiver::create([
                        'mail_id' => $mail_id,
                        'user_id' => $user,
                        'status' => 0,
                        'author' => $user_id,
                        'time' => time(),
                        'important' => 0,
                    ]);
                }
            }
        }

        return back();
    }

    public function history()
    {
        $claas = DB::table('clas')
            ->orderBy('paye')->orderBy('classnamber')
            ->get();
        $paye = paye::all();
        $dars = dars::all()->sortBy('paye')->sortBy('name');
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();

        return view('Admin.sms.history', compact('count', 'count', 'paye', 'dars', 'karnamehs','claas'));
    }
}
