<?php

namespace App\Http\ViewComposers;

use App\Blog;
use App\challenge;
use App\dars;
use App\KarnamehAdmin;
use App\MessageReseiver;
use App\paye;
use App\RollCall;
use App\Setting;
use App\teacher;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AdminComposer
{

    public function compose(View $view)
    {

        $claas = DB::table('clas')
            ->orderBy('paye')->orderBy('classnamber')
            ->get();
        $paye = paye::all();
        $dars = dars::all()->sortBy('paye')->sortBy('name');
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();

        $challenge=challenge::where('status',0)->count();
        $blog=Blog::where('status',0)->count();
        $newkarname=KarnamehAdmin::all();
        $newkarname=$newkarname->unique('name');
        $setting=Setting::all()->first();
        $data = teacher::with('darss')
            ->has('class')
            ->has('darss')
            ->orderBy('class_id')->get();

        $view->with(
            [
                'claas' => $claas,
                'paye' => $paye,
                'dars' => $dars,
                'karnamehs' => $karnamehs,
                'count' => $count,
                'challenge' => $challenge,
                'blog' => $blog,
                'newkarname' => $newkarname,
                'setting' => $setting,
                'data' => $data,
            ]
        );
    }

}
