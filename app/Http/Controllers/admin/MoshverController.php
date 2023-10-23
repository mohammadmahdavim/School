<?php

namespace App\Http\Controllers\admin;

use App\Archive;
use App\clas;
use App\CommentMoshaver;
use App\FileMoshaver;
use App\MeetingUser;
use App\Moshaver;
use App\paye;
use App\RollCallMoshaver;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class MoshverController extends Controller
{


    public function index()
    {
        $rows = Moshaver::where('user_id', auth()->user()->id)->with('user')->orderBy('date', 'desc')->orderBy('start', 'desc')->paginate(20);
        return view('Admin.moshaver.index', compact('rows'));
    }

    public function create()
    {


        return view('Admin.moshaver.create');
    }

    public function store(Request $request)
    {
        if ($request['server'] == 1) {
            $connect = \Bigbluebutton::isConnect();
        } else {
            $connect = \Bigbluebutton::server('server1')->isConnect();
        }
        if (!$connect) {
            return back()->withErrors('اتصال به سرور قطع می باشد');
        }
        $this->validate(request(),
            [
                'date1' => 'required',
                'title' => 'required',
                'start' => 'required',
            ]
        );

        $moshaver = new Moshaver();
        $moshaver->user_id = auth()->user()->id;
        $moshaver->title = $request->title;
        $moshaver->date = $request->date1;
        $moshaver->description = $request->description;
        if ($request->archive == 'on') {
            $moshaver->online = 1;

        }
        $moshaver->record = $request->record;
        $moshaver->member = $request->member;
        $moshaver->start = $request->start;
        $moshaver->server = $request['server'];

        $moshaver->description = $request->description;
        $moshaver->save();
        if ($request->archive == 'on') {
            if ($request['server'] == 1) {
                \Bigbluebutton::create([
                    'meetingID' => $moshaver->id,
                    'meetingName' => $request->title,
                    'attendeePW' => 'attendee',
                    'moderatorPW' => 'moderator'
                ]);
            } else {
                \Bigbluebutton::server('server1')->create([
                    'meetingID' => $moshaver->id,
                    'meetingName' => $request->title,
                    'attendeePW' => 'attendee',
                    'moderatorPW' => 'moderator'
                ]);
            }
        }
        alert()->success('جلسه با موفقیت ایجاد شد', 'موفق');
        return back();
    }

    public function student($id)
    {
        $userid = Archive::where('item_id', $id)->where('model', 'Moshaver')->pluck('user_id');
        $users = User::where('role', 'دانش آموز')->with(['rollcallmoshaver' => function ($q) use ($id) {
            $q->where('moshavers_id', $id);
        }])->wherein('id', $userid)->get();
        return view('Admin.moshaver.student', compact('users', 'id'));


    }

    public function presenttoabsent($id, $moshavers_id)
    {

        RollCallMoshaver::create([
            'user_id' => $id,
            'moshavers_id' => $moshavers_id,
        ]);
        alert()->success('وضعیت دانش آموز به غایب تغییر پیدا کرد', 'موفق');

        return back();
    }

    public function absenttopresent($id)
    {
        $rollcall = RollCallMoshaver::find($id);
        $rollcall->delete();
        alert()->success('وضعیت دانش آموز به حاظر تغییر پیدا کرد', 'موفق');
        return back();
    }

    public function comment($id, $user_id)
    {

        $comment = CommentMoshaver::where('user_id', $user_id)->where('moshavers_id', $id)->first();
        $user = User::where('id', $user_id)->first();

        return view('Admin.moshaver.comment', compact('comment', 'user', 'id'));
    }

    public function commentstore(Request $request)
    {
        $this->validate(request(),
            [
                'moshavereh_id' => 'required',
                'user_id' => 'required',
            ]
        );
        $comment = CommentMoshaver::where('user_id', $request->user_id)->where('moshavers_id', $request->moshavereh_id)->first();
        if ($comment) {
            $comment->update([
                'comment' => request('comment'),
                'commentme' => request('commentme'),
            ]);
            alert()->success('کامنت با موفقیت ویرایش شد', 'موفق');
            return back();
        }
        $moshaver = new CommentMoshaver();
        $moshaver->user_id = $request->user_id;
        $moshaver->moshavers_id = $request->moshavereh_id;
        $moshaver->comment = $request->comment;
        $moshaver->commentme = $request->commentme;
        $moshaver->save();
        alert()->success('کامنت با موفقیت ایجاد شد', 'موفق');
        return back();
    }


    public function edit($id)
    {
        $row = Moshaver::find($id);
        return view('Admin.moshaver.edit', compact('row'));


    }

    public function update(Request $request, $id)
    {
        $this->validate(request(),
            [
                'date1' => 'required',
                'title' => 'required',
            ]
        );
        $row = Moshaver::find($id);
        $row->update([
            'date' => request('date1'),
            'start' => request('start'),
            'title' => request('title'),
            'member' => request('member'),
            'server' => request('server'),
            'record' => request('record'),
        ]);
        if ($request->archive == 'on') {
            $row->update(['online' => 1]);
            if ($request['server'] == 1) {
                \Bigbluebutton::create([
                    'meetingID' => $row->id,
                    'meetingName' => $request->title,
                    'attendeePW' => 'attendee',
                    'moderatorPW' => 'moderator'
                ]);
            } else {
                \Bigbluebutton::server('server1')->create([
                    'meetingID' => $row->id,
                    'meetingName' => $request->title,
                    'attendeePW' => 'attendee',
                    'moderatorPW' => 'moderator'
                ]);
            }
        } else {
            $row->update(['online' => 0]);

        }

        alert()->warning('جلسه با موفقیت ویرایش شد. لطفا دوباره افراد را به جلسه اختصاص دهید.', 'موفق')->autoclose(6000);
        return back();
    }

    public
    function destroy($id)
    {

//        حذف از جدول   home
        $row = CommentMoshaver::where('moshavers_id', $id)->first();
        if ($row) {
            $row->delete();
        }
        $row = RollCallMoshaver::where('moshavers_id', $id)->first();
        if ($row) {
            $row->delete();
        }
        $rows = Moshaver::where('id', $id)->first();
        $rows->delete();
    }


    public function createfile()
    {

        $paye = paye::all();
        return view('Admin.moshaver.file.create', compact('paye'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storefile(Request $request)
    {

        $this->validate(request(),
            [

                'file' => 'required',
                'paye' => 'required',
                'title' => 'required',

            ]
        );

        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);


        FileMoshaver::create([
            'mime' => $cover->getClientMimeType(),
            'original_filename' => $cover->getClientOriginalName(),
            'filename' => $filename,
            'paye' => $request->paye,
            'title' => $request->title,
            'created_at' => Jalalian::now(),
        ]);

        alert()->success('برنامه مشاوره ای با موفقیت ارسال گردید', 'ارسال برنامه مشاوره ای')->autoclose(10000)->persistent('ok');

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewfile()
    {

        $files = FileMoshaver::all();

        return view('Admin.moshaver.file.view', compact('files'));
    }

    public function destroyfile($id)
    {
        $row = FileMoshaver::find($id);
        $row->delete();

    }

    public function sync($id)
    {
        $allclass = clas::all();
        $allstudents = User::orderBy('class')->get();
        $syncs = Archive::where('model', 'Moshaver')->where('item_id', $id)->get();
        $item = Moshaver::where('id', $id)->first();
        return view('Admin.moshaver.sync', compact('allclass', 'allstudents', 'syncs', 'item'));
    }

    public function archive(Request $request, $id)
    {
        $rows = Archive::where('model', $request->model)->where('item_id', $id)->get();
        $users = MeetingUser::where('meeting_id', $id)->get();
        foreach ($users as $user) {
            $user->delete();
        }
        foreach ($rows as $row) {
            $row->delete();
        }
        if ($request->class) {
            $users = User::where('role', 'دانش آموز')->whereIn('class', $request->class)->pluck('id');
            foreach ($users as $user) {

                $archive = new Archive();
                $archive->user_id = $user;
                $archive->model = $request->model;
                $archive->item_id = $id;
                $archive->save();

                $meeting = new MeetingUser();
                $meeting->user_id = $user;
                $meeting->meeting_id = $id;
                $meeting->save();
            }
        }
        if ($request->users) {
            foreach ($request->users as $user) {
                $archive = new Archive();
                $archive->user_id = $user;
                $archive->model = $request->model;
                $archive->item_id = $id;
                $archive->save();

                $meeting = new MeetingUser();
                $meeting->user_id = $user;
                $meeting->meeting_id = $id;
                $meeting->save();
            }
        }
        alert()->success('عملیات با موفقیت انجام شد', 'موفق');
        return back();
    }

    public function record($id)
    {
        $server = Moshaver::where('id', $id)->pluck('server')->first();
        if ($server == 1) {
            $url = \Bigbluebutton::getRecordings([
                'meetingID' => $id,
            ]);
        } else {
            $url = \Bigbluebutton::server('server1')->getRecordings([
                'meetingID' => $id,
            ]);
        }

        if ($url == '[]') {
            alert()->success('فیلمی برای پخش وجود ندارد.', 'عملیات ناموفق');
            return back();
        }
        $url = $url[0]['playback']['format']['url'];
        return redirect()->to($url);
    }

    public function join($id)
    {

        $class = Moshaver::find($id);

        $name = auth()->user()->f_name . ' ' . auth()->user()->l_name;
        if ($class['server'] == 1) {
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
        return redirect()->to($url);

    }


}
