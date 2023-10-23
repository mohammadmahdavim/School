<?php

namespace App\Http\Controllers\student;

use App\Archive;
use App\BlockClassUser;
use App\CommentMoshaver;
use App\FileMoshaver;
use App\MeetingUser;
use App\Moshaver;
use App\OnlineClass;
use App\Onlinelist;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

class MoshaverController extends Controller
{
    public function index()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }

        $meetings = MeetingUser::where('user_id', $iduser)->pluck('meeting_id');
        $rows = Moshaver::whereIn('id', $meetings)
            ->orderBy('start', 'asc')
            ->get();
        return view('student.moshaver.index', compact('rows'));
    }

    public function detail($id)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $row = Moshaver::where('id', $id)->with('user')
            ->first();
        $comment = CommentMoshaver::where('moshavers_id', $row->id)->where('user_id', $iduser)->first();
        return view('student.moshaver.detail', compact('row', 'comment'));

    }

    public function barname()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $paye = User::where('id', $iduser)->pluck('paye')->first();
        $rows = FileMoshaver::where('paye', $paye)->get();
        return view('student.moshaver.barname', compact('rows'));
    }

    public function join($id)
    {

        $class = Moshaver::find($id);
        $user = auth()->user();
        $count = Onlinelist::where('class_id', $class->id)->count();
        if ($count <= $class->member) {
            $name = $user->f_name . ' ' . $user->l_name;
            if ($class->server == 1) {
                return redirect()->to(
                    Bigbluebutton::join([
                        'meetingID' => $class->id,
                        'userName' => $name,
                        'password' => 'attendee' //which user role want to join set password here
                    ])
                );
            } else {
                return redirect()->to(
                    Bigbluebutton::server('server1')->join([
                        'meetingID' => $class->id,
                        'userName' => $name,
                        'password' => 'attendee' //which user role want to join set password here
                    ])
                );
            }

            return redirect()->to($url);
        } else {
            alert()->success('محدودیت در تعداد ورود به کلاس', 'عملیات ناموفق');
            return back();
        }


    }

    public function record($id)
    {
        $url = \Bigbluebutton::getRecordings([
            'meetingID' => $id,
        ]);
        if ($url == '[]') {
            alert()->success('فیلمی برای پخش وجود ندارد.', 'عملیات ناموفق');
            return back();
        }
        $url = $url[0]['playback']['format']['url'];
        return redirect()->to($url);
    }
}
