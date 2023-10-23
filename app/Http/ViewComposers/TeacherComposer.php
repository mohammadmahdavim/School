<?php

namespace App\Http\ViewComposers;

use App\clas;
use App\dars;
use App\FilmSection;
use App\KarnamehAdmin;
use App\MessageReseiver;
use App\paye;
use App\Setting;
use App\teacher;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class TeacherComposer
{
    public function compose(View $view)
    {

        $id = auth()->user()->id;
        $classid = teacher::where('user_id', $id)->pluck('class_id')->first();
        $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->where('classnamber', $classid)->get();
        $paye = clas::where('classnamber', $classid)->first()['paye'];
        $doros = dars::where('paye', $paye)->get();
        $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->where('status', 1)->get();
        $count = MessageReseiver::where('user_id', $id)->where('status', 0)->count();
        $data = teacher::where('user_id', $id)->with('darss')->get();
        $sections = FilmSection::where('section_id', 0)->get();
        $newkarname = KarnamehAdmin::all();
        $newkarname = $newkarname->unique('name');
        $setting=Setting::all()->first();


        $view->with(
            [
                'karnamehs' => $karnamehs,
                'count' => $count,
                'claas' => $claas,
                'doros' => $doros,
                '$paye' => $paye,
                'data' => $data,
                'sections' => $sections,
                'newkarname' => $newkarname,
                'setting' => $setting,
            ]
        );
    }

}
