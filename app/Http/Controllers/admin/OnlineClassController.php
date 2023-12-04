<?php

namespace App\Http\Controllers\admin;

use App\BlockClassUser;
use App\clas;
use App\dars;
use App\OnlineClass;
use App\Onlinelist;
use App\Services\CvService;
use App\Services\MarkService;
use App\Services\SkyRoom;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;
use App\Day;
use Morilog\Jalali\Jalalian;


class OnlineClassController extends Controller
{
    public $CvService;
    public $skyRoom;

    public function __construct(CvService $cvService, SkyRoom $skyRoom)
    {
        $this->CvService = $cvService;
        $this->SkyRoom = $skyRoom;
    }

    public function index($id)
    {
        $rows = OnlineClass::where('class_id', $id)
            ->orderbyDesc('date')
            ->orderbyDesc('id')
            ->with('day')
            ->paginate(30);
        return view('Admin.online.index', compact('rows', 'id'));
    }

    public function create()
    {
        $allclas = clas::all();
        $doros = dars::all();
        $doros = $doros->unique('name');
        $days = Day::all();
        $teachers = User::where('role', 'معلم')->get();
        return view('Admin.online.create', compact('allclas', 'doros', 'days', 'teachers'));

    }

    public function store(Request $request)
    {

        $this->validate(request(),
            [
                'title' => 'required',
                'class_id' => 'required',
                'dars' => 'required',
                'date' => 'required',
                'date-picker-shamsi-list' => 'required',
                'start' => 'required',
                'end' => 'required',
                'member' => 'required',
            ]
        );
        if ($request['server'] == 1) {
            $connect = \Bigbluebutton::isConnect();
            if (!$connect) {
                return back()->withErrors('اتصال به سرور قطع می باشد');
            }
        } elseif ($request['server'] == 2) {
            $connect = \Bigbluebutton::server('server1')->isConnect();
            if (!$connect) {
                return back()->withErrors('اتصال به سرور قطع می باشد');
            }
        }
        if ($request['server'] == 'sky') {
//            $lastRecord = OnlineClass::latest()->first();
            $params = [
                "name" => 'room' . time(),
                "title" => "$request->title",
                "guest_login" => false,
                "op_login_first" => true,
                "max_users" => $request->member
            ];
            $id = $this->SkyRoom->actions('createRoom', $params);
            if ($id[0] == 'error') {
                return back()->withErrors($id[1]);
            }
        }
        $class = new OnlineClass();
        if ($request['server'] == 'sky') {
            $class->id = $id[1];
        }
        $class->author = $request->teacher;
        $class->title = $request->title;
        $class->date = $request->date;
        $class->enddate = request('date-picker-shamsi-list');
        $class->class_id = $request->class_id;
        $class->description = $request->description;
        $class->end = $request->end;
        $class->start = $request->start;
        $class->dars = $request->dars;
        $class->record = $request->record;
        $class->member = $request->member;
        $class->day_id = $request->day_id;
        $class->server = $request['server'];

        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images');
            $cover->move($path, $filename);
            $class->original_filename = $cover->getClientOriginalName();
            $class->filename = $filename;
            $class->mime = $cover->getClientMimeType();
        }
        $class->save();
        if ($request['server'] == 1) {
            \Bigbluebutton::create([
                'meetingID' => $class->id,
                'meetingName' => $request->title,
                'attendeePW' => 'attendee',
                'moderatorPW' => 'moderator'
            ]);
        } elseif ($request['server'] == 2) {
            \Bigbluebutton::server('server1')->create([
                'meetingID' => $class->id,
                'meetingName' => $request->title,
                'attendeePW' => 'attendee',
                'moderatorPW' => 'moderator'
            ]);
        }

        alert()->success('کلاس  شما با موفقیت ایجاد شد.', 'عملیات موفق');
        return redirect(route('online_class_admin', $request->class_id));
    }

    public function edit($id)
    {
        $row = OnlineClass::find($id);
        $allclas = clas::all();
        $doros = dars::all();
        $doros = $doros->unique('name');
        $days = Day::all();
        $teachers = User::where('role', 'معلم')->get();

        return view('Admin.online.edit', compact('allclas', 'row', 'doros', 'days', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $classid = $id;
        $this->validate(request(),
            [
                'title' => 'required',
                'class_id' => 'required',
                'dars' => 'required',
                'date' => 'required',
                'start' => 'required',
                'end' => 'required',
                'date-picker-shamsi-list' => 'required',
                'member' => 'required',

            ]
        );
        if ($request['server'] == 1) {
            $connect = \Bigbluebutton::isConnect();
            if (!$connect) {
                return back()->withErrors('اتصال به سرور قطع می باشد');
            }
        } elseif ($request['server'] == 2) {
            $connect = \Bigbluebutton::server('server1')->isConnect();
            if (!$connect) {
                return back()->withErrors('اتصال به سرور قطع می باشد');
            }
        }


        if ($request['server'] == 'sky') {
            $params = [
                "room_id" => $id,
                "name" => $request->title,
                "title" => "$request->title",
                "max_users" => $request->member
            ];
            $id = $this->SkyRoom->actions('updateRoom', $params);
            if ($id[0] == 'error') {
                return back()->withErrors($id[1]);
            }
        } elseif ($request['server'] == 1) {
            \Bigbluebutton::create([
                'meetingID' => $id,
                'meetingName' => $request->title,
                'attendeePW' => 'attendee',
                'moderatorPW' => 'moderator',
                'record' => true,

            ]);
        } else {
            \Bigbluebutton::server('server1')->create([
                'meetingID' => $id,
                'meetingName' => $request->title,
                'attendeePW' => 'attendee',
                'moderatorPW' => 'moderator',
                'record' => true,

            ]);
        }

        $class = OnlineClass::find($classid);
        $class->author = $request->teacher;

        $class->title = $request->title;
        $class->date = $request->date;
        $class->class_id = $request->class_id;
        $class->description = $request->description;
        $class->end = $request->end;
        $class->start = $request->start;
        $class->dars = $request->dars;
        $class->status = $request->status;
        $class->record = $request->record;
        $class->member = $request->member;
        $class->day_id = $request->day_id;

        $class->enddate = request('date-picker-shamsi-list');

        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images');
            $cover->move($path, $filename);
            $class->original_filename = $cover->getClientOriginalName();;
            $class->filename = $filename;
            $class->mime = $cover->getClientMimeType();
        }
        $class->save();
        alert()->success('کلاس  شما با موفقیت ویرایش شد.', 'عملیات موفق');
        return redirect(('/admin/online/' . $request->class_id));
    }

    public function delete($id)
    {
        $row = OnlineClass::find($id);
        if ($row->server != 'sky') {

            $row->delete();
        } else {
            $params = [
                "room_id" => $id,
            ];
            $this->SkyRoom->actions('deleteRoom', $params);
        }
        return back();

    }

    public function join($id)
    {

        $class = OnlineClass::find($id);
        $name = auth()->user()->f_name . ' ' . auth()->user()->l_name;
        $user = auth()->user();
        if ($class['server'] == 'sky') {
            $params = ["room_id" => $class->id,
                "user_id" => auth()->user()->id,
                "nickname" => $name,
                "access" => 3,
                "concurrent" => 1,
                "language" => "fa",
                "ttl" => 3600];
            $url = $this->SkyRoom->actions('createLoginUrl', $params);
            $url = $url[1];
        } elseif ($class['server'] == 1) {
            $url = \Bigbluebutton::start([
                'meetingID' => $class->id,
                'moderatorPW' => 'moderator', //moderator password set here
                'attendeePW' => 'attendee', //attendee password here
                'userName' => $name,//for join meeting
            ]);
        } else {
            $url = \Bigbluebutton::server('server1')->start([
                'meetingID' => $class->id,
                'moderatorPW' => 'moderator', //moderator password set here
                'attendeePW' => 'attendee', //attendee password here
                'userName' => $name,//for join meeting
            ]);
        }
        $date = Jalalian::now()->format('Y-m-d');
        $time = Jalalian::now()->format('h:i:s');

        $user = auth()->user();
        $version = $this->version($class, $date);

        Onlinelist::create([
            'user_id' => $user->id,
            'class_id' => $class->id,
            'role' => 'moderator',
            'version' => $version,
            'date' => $date,
            'time' => $time,
        ]);

        if ($url == null) {
            if ($class['server'] == 1) {
                \Bigbluebutton::create([
                    'meetingID' => $class->id,
                    'meetingName' => $class->title,
                    'attendeePW' => 'attendee',
                    'moderatorPW' => 'moderator'
                ]);
            } elseif ($class['server'] == 2) {
                \Bigbluebutton::server('server1')->create([
                    'meetingID' => $class->id,
                    'meetingName' => $class->title,
                    'attendeePW' => 'attendee',
                    'moderatorPW' => 'moderator'
                ]);
            }
            return redirect('/admin/online/join/' . $class->id);

        }

        return redirect()->to($url);

    }

    public function listGroup($id)
    {
        $class = OnlineClass::where('id', $id)->first();
        $groups = Onlinelist::where('class_id', $id)->groupBy('version')
            ->get();
        return view('Admin.online.listGroup', compact('groups', 'class'));
    }

    public function list($id, $version)
    {
        $class = OnlineClass::where('id', $id)->first();
        $students = User::where('class', $class->class_id)->where('role', 'دانش آموز')
            ->with([
                'online_list' => function ($query) use ($id, $version) {
                    $query->where('class_id', $id)->where('version', $version)->select('class_id', 'user_id', 'time');
                },
            ])
            ->select('codemeli', 'f_name', 'l_name', 'fname', 'class', 'id')
            ->get();
        return view('Admin.online.list', compact('students', 'class'));

    }

    public function blockList($id)
    {
        $class = OnlineClass::where('id', $id)->first();
        $students = User::where('class', $class->class_id)->where('role', 'دانش آموز')
            ->with([
                'block_class'
            ])
            ->select('codemeli', 'f_name', 'l_name', 'fname', 'class', 'id')
            ->get();
        return view('Admin.online.blockList', compact('students', 'class'));

    }

    public function blockListStore(Request $request)
    {
        $rows = BlockClassUser::where('online_class_id', $request->class)->get();
        if ($rows) {
            foreach ($rows as $row) {
                $row->delete();
            }
        }
        if ($request->block) {
            foreach ($request->block as $key => $a) {
                BlockClassUser::create([
                    'online_class_id' => $request->class,
                    'user_id' => $key,
                ]);
            }
        }
        return 'success';

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

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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

