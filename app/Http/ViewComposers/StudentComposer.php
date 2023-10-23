<?php

namespace App\Http\ViewComposers;

use App\clas;
use App\dars;
use App\KarnamehAdmin;
use App\MessageReseiver;
use App\Setting;
use App\teacher;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class StudentComposer
{
    public function compose(View $view)
    {

        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }

        $users = User::where('id', $id)->first();
        $doros = dars::where('paye', $users->paye)->orderby('id')->get();
        $reshte=clas::where('classnamber',$users->class)->pluck('reshte')->first();
        $doros = dars::where('paye', $users->paye)
            ->whereIn('reshte',[$reshte,'بدون رشته'])->orderby('id')->get();
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->get();
        $count = MessageReseiver::where('user_id', auth()->user()->id)->where('status', 0)->count();
        $avgmarks = DB::table('mark_items')->where('user_id', auth()->user()->id)
            ->select(DB::raw('avg(mark) as avg,  coddars'))
            ->groupBy('coddars')
            ->get();
        $vaheds = 0;
        $marks = 0;
        $moadel = 0;
        if (!empty($avgmark)) {
            foreach ($avgmarks as $avgmark) {
                $vahed = dars::where('id', $avgmark->coddars)->pluck('vahed')->first();
                $vaheds = $vahed + $vaheds;
                $marks = $marks + $avgmark->avg;
            }
            $moadel = round((($marks / $vaheds) * 5),2);
        }

        $newkarname=KarnamehAdmin::where('user_id',$id)->get();
        $newkarname=$newkarname->unique('name');
        $setting=Setting::all()->first();

        $view->with(
            [
                'karnamehs' => $karnamehs,
                'count' => $count,
                '$doros' => $doros,
                'moadel' => $moadel,
                'newkarname' => $newkarname,
                'setting' => $setting,
            ]
        );
    }

}
