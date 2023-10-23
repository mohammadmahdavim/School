<?php

namespace App\Http\Controllers;

use App\Archive;
use App\dars;
use App\Film;
use App\FilmDownlod;
use App\Http\Controllers\Controller;
use App\MessageReseiver;
use App\OnlineClass;
use App\User;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{

    /*
     * مشاهده مطالب آموزشی که توسط دبیر مربوطه بارگذاری شده است.(فیلم و...)
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($dars)
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $classid = User::where('id', $id)->first()['class'];
        $films[] = Film::where('class_id', $classid)->where('dars', $dars)->where('archive', 0)->get();
        $archiveid = Archive::where('user_id', $id)->where('model', 'Film')->pluck('item_id');
        if (count($archiveid) > 0) {
            $films = Film::where('class_id', $classid)->where('dars', $dars)->where('archive', 0)->get();
            $archive = Film::whereIn('id', $archiveid)->where('dars', $dars)->where('archive', 1)->orderby('created_at', 'desc')->latest()->get();
            $films = [$films, $archive];
//            return $archive;
        }
        return view('student.film', compact('films'));

    }

    public function count($id)
    {
        $film = Film::where('id', $id)->first();
        $count = ($film->downloadcount) + 1;
        $film->update([
            'downloadcount' => $count,
        ]);

        $filmDownlod = new FilmDownlod();
        $filmDownlod->film_id = $id;
        if (auth()->user()) {
            $filmDownlod->user_id = auth()->user()->id;
        } else {
            $filmDownlod->user_id = User::first()['id'];

        }
        $filmDownlod->save();

        return redirect(route('film.download', $film->id));
    }

    public function recordOnlineList($id)
    {
        $class = OnlineClass::where('id', $id)->first();

        $urls = \Bigbluebutton::getRecordings([
            'meetingID' => $id,
        ]);
        if ($urls=='[]'){
            alert()->success('فیلمی برای پخش وجود ندارد.', 'عملیات ناموفق');
            return back();
        }
//        return $urls;
        return view(    'online.record', ['class' => $class, 'urls' => $urls]);
    }
}


