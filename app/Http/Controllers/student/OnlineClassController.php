<?php

namespace App\Http\Controllers\student;

use App\BlockClassUser;
use App\OnlineClass;
use App\Onlinelist;
use App\Services\SkyRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;
use Morilog\Jalali\Jalalian;

class OnlineClassController extends Controller
{
    public $skyRoom;

    public function __construct(SkyRoom $skyRoom)
    {
        $this->SkyRoom = $skyRoom;

    }

    public function index()
    {
        $user = auth()->user();
        $rows = OnlineClass::where('class_id', $user->class)
            ->orderbyDesc('date')
            ->orderbyDesc('id')
            ->paginate(20);
        return view('student.online.index', compact('rows'));
    }

    public function join($id)
    {
        $block = BlockClassUser::where('online_class_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($block) {
            alert()->error('دسترسی ندارید!!!', 'ورود ناموفق');
            return back();
        }
        $class = OnlineClass::find($id);
        $date = Jalalian::now()->format('Y-m-d');
        $time = Jalalian::now()->format('h:i:s');
        $user = auth()->user();
        $version = $this->version($class, $date);

        $count = Onlinelist::where('class_id', $class->id)->where('version', $version)->get();
        $count = $count->unique('user_id')->count();

        if ($count <= $class->member) {

            Onlinelist::create([
                'user_id' => $user->id,
                'class_id' => $class->id,
                'role' => 'viewer',
                'version' => $version,
                'date' => $date,
                'time' => $time,
            ]);

            $name = $user->f_name . ' ' . $user->l_name;
            if ($class['server'] == 'sky') {
                $params = ["room_id" => $class->id,
                    "user_id" => auth()->user()->id,
                    "nickname" => $name,
                    "access" => 1,
                    "concurrent" => 1,
                    "language" => "fa",
                    "ttl" => 3600];
                $url = $this->SkyRoom->actions('createLoginUrl', $params);
                $url = $url[1];

            } elseif
            ($class->server == 1) {
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


    public function version($class, $now)
    {
        $lastList = Onlinelist::where('class_id', $class->id)->orderbyDesc('created_at')->first();
        if ($lastList) {
            $date = $lastList->date;
            if ($now == $date) {
                return $lastList->version;
            } else {
                return $lastList->version + 1;
            }
        }
        return 1;
    }

}
