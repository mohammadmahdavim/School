<?php

namespace App\Providers;

use App\Blog;
use App\challenge;
use App\clas;
use App\dars;
use App\FilmSection;
use App\KarnamehAdmin;
use App\MessageReseiver;
use App\paye;
use App\Setting;
use App\teacher;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(
            'layouts/admin', 'App\Http\ViewComposers\AdminComposer'
        );

        View::composer('layouts/admin', function ($view) {
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
            $data = teacher::with('darss')->has('class')->has('darss')->get();

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
        });


        View::composer(
            'layouts/student', 'App\Http\ViewComposers\StudentComposer'
        );

        View::composer('layouts/student', function ($view) {
            $id = auth()->user()->id;
            if (auth()->user()->role == 'اولیا') {
                $id = auth()->user()->id - 1000;
            }

            $users = User::where('id', $id)->first();

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
                    'doros' => $doros,
                    'karnamehs' => $karnamehs,
                    'count' => $count,
                    'moadel' => $moadel,
                    'newkarname' => $newkarname,
                    'setting' => $setting,

                ]
            );
        });

        View::composer(
            'layouts/teacher', 'App\Http\ViewComposers\TeacherComposer'
        );

        View::composer('layouts/teacher', function ($view) {
            $id = auth()->user()->id;
            $classid = teacher::where('user_id', $id)->pluck('class_id')->first();
            $claas = DB::table('clas')->orderBy('paye')->orderBy('classnamber')->where('classnamber', $classid)->get();
            $paye = clas::where('classnamber', $classid)->first()['paye'];
            $doros = dars::where('paye', $paye)->get();
            $karnamehs = DB::table('r_karnamehs')->orderBy('created_at')->where('status', 1)->get();
            $count = MessageReseiver::where('user_id', $id)->where('status', 0)->count();
            $data=teacher::where('user_id',$id)->with('darss')->get();
            $sections = FilmSection::where('section_id', 0)->get();

            $newkarname=KarnamehAdmin::all();
            $newkarname=$newkarname->unique('name');
            $setting=Setting::all()->first();

            $view->with(
                [
                    'karnamehs' => $karnamehs,
                    'count' => $count,
                    'claas' => $claas,
                    '$doros' => $doros,
                    '$paye' => $paye,
                    'data' => $data,
                    'sections' => $sections,
                    'newkarname' => $newkarname,
                    'setting' => $setting,

                ]
            );
        });
    }

}
