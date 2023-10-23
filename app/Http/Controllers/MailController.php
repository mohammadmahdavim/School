<?php

namespace App\Http\Controllers;

use App\MailModel;
use App\MessageReseiver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\jDate;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        $id = auth()->user()->id;
        $mails = MessageReseiver::where('user_id', $id)->orderBy('status')->with('user')->get();
        $count = MessageReseiver::where('user_id', $id)->where('status', 0)->count();
        if (auth()->user()->role == 'مدیر') {
            $layout = 'admin';
        } elseif (auth()->user()->role == 'معلم') {
            $layout = 'teacher';

        } else {
            $layout = 'student';
        }
        return view('mail.index', ['mails' => $mails, 'count' => $count, 'role','layout'=>$layout]);
    }


    public function outbox()
    {
        if (auth()->user()->role == 'مدیر') {
            $layout = 'admin';
        } elseif (auth()->user()->role == 'معلم') {
            $layout = 'teacher';

        } else {
            $layout = 'student';
        }
        $id = auth()->user()->id;
        $mails = DB::table('message_reseivers')->where('author', $id)->orderBy('created_at', 'desc')->distinct('mail_id')->get();
        $count = MessageReseiver::where('status', 0)->where('user_id', $id)->count();
        return view('mail.send', ['mails' => $mails, 'count' => $count,'layout'=>$layout]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 'مدیر') {
            $layout = 'admin';
        } elseif (auth()->user()->role == 'معلم') {
            $layout = 'teacher';

        } else {
            $layout = 'student';
        }
        if (auth()->user()->status != 1) {
            alert()->warning('منتظر تایید مدیر بمانید!', 'ناموفق');

            return redirect('/profile');
        }
        $claass = DB::table('users')->where('role', 'دانش آموز')->distinct('class')->pluck('class');

        $allusers = User::all()->sortBy('role');
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        $count = MessageReseiver::where('user_id', $user_id)->where('status', 0)->count();
        if ($user->role == 'اولیا' or $user->role == 'دانش آموز') {

            return view('mail.creates', compact('allusers', 'count','layout'));
        } else {
            return view('mail.create', compact('allusers', 'count', 'claass','layout'));
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'subject' => 'required',
            'body' => 'required',
            'to' => 'required'
        ]);
        $cover = null;
        $mime = null;
        $original_filename = null;
        $filename = null;
        $user_id = auth()->user()->id;
        if (!empty($request->patchfile)) {
            $cover = $request->file('patchfile');

            $cover = $request->file('patchfile');
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images');
            $cover->move($path, $filename);
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();
        }

//        creat mail
        $mail = new MailModel();
        $mail->subject = $request->get('subject');
        $mail->body = $request->get('body');
        $mail->user_id = $user_id;
        $mail->time = time();
        $mail->mime = $mime;
        $mail->original_filename = $original_filename;
        $mail->filename = $filename;
        $mail->save();

//        creat rasevers mail
        $mail_id = $mail->id;
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


            if ($reseiver == 'all') {
                $usres = User::all()->pluck('id');
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
            } elseif ($reseiver == 'dabir') {
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

        alert()->success('موفق', 'با موفقیت ارسال شد');

        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->role == 'مدیر') {
            $layout = 'admin';
        } elseif (auth()->user()->role == 'معلم') {
            $layout = 'teacher';

        } else {
            $layout = 'student';
        }
        $ids = auth()->user()->id;
        $count = MessageReseiver::where('user_id', $ids)->where('status', 0)->count();
        $mail = MailModel::find($id);
        $mail->update(['status' => 1]);
        $mailShow = MessageReseiver::where('user_id', $ids)->where('mail_id', $id)->first();
        if ($mailShow) {
            $mailShow->update([
                'status' => 1
            ]);
        }

        return view('mail.show', ['count' => $count, 'mail' => $mail,'layout'=>$layout]);


    }

    public function showin($id)
    {
        if (auth()->user()->role == 'مدیر') {
            $layout = 'admin';
        } elseif (auth()->user()->role == 'معلم') {
            $layout = 'teacher';

        } else {
            $layout = 'student';
        }
        $ids = auth()->user()->id;
        $count = MessageReseiver::where('user_id', $ids)->where('status', 0)->count();
        $mail = MailModel::find($id);
        $mail->update(['status' => 1]);
        $mailShow = MessageReseiver::where('user_id', $ids)->where('mail_id', $id)->first();
        if ($mailShow) {
            $mailShow->update([
                'status' => 1
            ]);
        }

        return view('mail.showin', ['count' => $count, 'mail' => $mail,'layout'=>$layout]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role == 'مدیر') {
            $layout = 'admin';
        } elseif (auth()->user()->role == 'معلم') {
            $layout = 'teacher';

        } else {
            $layout = 'student';
        }
        $mail = MailModel::where('id', $id)->first();
        $allusers = User::all()->sortBy('role');
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();
        $count = MessageReseiver::where('user_id', $user_id)->where('status', 0)->count();
        if ($user->role == 'اولیا' or $user->role == 'دانش آموز') {
            return view('mail.edites', compact('allusers', 'count', 'mail','layout'));
        } else {
            return view('mail.edite', compact('allusers', 'count', 'mail','layout'));
        }

    }

    public function update(Request $request, $id)
    {

        $this->validate(request(), [
            'subject' => 'required',
            'body' => 'required',
            'to' => 'required'
        ]);
        $allusers = User::all()->sortBy('role');
        $user_id = auth()->user()->id;
        $count = MessageReseiver::where('user_id', $user_id)->where('status', 0)->count();
        $mailres = MessageReseiver::where('mail_id', $id)->get();
        foreach ($mailres as $M)
            if (!empty($M)) {
                $M->delete();
            }
        $mail = MailModel::where('id', $id)->first();
        $mail->delete();

        $cover = null;
        $mime = null;
        $original_filename = null;
        $filename = null;
        $user_id = auth()->user()->id;
        if (!empty($request->patchfile)) {
            $cover = $request->file('patchfile');

            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();
            $filename = $cover->getFilename() . '.' . $extension;
        }
//        creat mail
        $mail = new MailModel();
        $mail->subject = $request->get('subject');
        $mail->body = $request->get('body');
        $mail->user_id = $user_id;
        $mail->time = time();
        $mail->mime = $mime;
        $mail->original_filename = $original_filename;
        $mail->filename = $filename;
        $mail->save();

//        creat rasevers mail
        $mail_id = $mail->id;
        $reseivers = $request->to;
        foreach ($reseivers as $reseiver) {
            if ($reseiver == 'all') {
                $usres = User::all()->pluck('id');
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
            } elseif ($reseiver == 'dabir') {
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
                MessageReseiver::create([
                    'mail_id' => $mail_id,
                    'user_id' => $reseiver,
                    'status' => 0,
                    'author' => $user_id,
                    'time' => time(),
                    'important' => 0,
                ]);
            }
        }

        alert()->success('موفق', 'با موفقیت ویرایش شد');

        return Redirect::to('/mail/outbox');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatein($id)
    {
//        return $id;
        $mail = MessageReseiver::where('mail_id', $id)->where('user_id', auth()->user()->id)->first();
        $mail->update([
            'important' => 1
        ]);

        alert()->success('موفق', 'با موفقیت جز پیام های مهم قرار گرفت');
        return back();
    }

    public function onupdatein($id)
    {
//        return $id;
        $mail = MessageReseiver::where('mail_id', $id)->where('user_id', auth()->user()->id)->first();
        $mail->update([
            'important' => 0
        ]);

        alert()->success('موفق', 'با موفقیت از پیام های مهم خارج گردید');
        return back();
    }

    public function updateout($id)
    {
//        return $id;
        $mail = MessageReseiver::where('mail_id', $id)->where('author', auth()->user()->id)->first();
        $mail->update([
            'important' => 1
        ]);

        alert()->success('موفق', 'با موفقیت جز پیام های مهم قرار گرفت');
        return back();
    }

    public function onupdateout($id)
    {
        $mail = MessageReseiver::where('mail_id', $id)->where('author', auth()->user()->id)->first();
        $mail->update([
            'important' => 0
        ]);

        alert()->success('موفق', 'با موفقیت از پیام های مهم خارج گردید');
        return back();
    }

    public function updatestar($id)
    {
        $mail = MessageReseiver::where('mail_id', $id)->where('author', auth()->user()->id)->orwhere('user_id', auth()->user()->id)->first();
        $mail->update([
            'important' => 0
        ]);

        alert()->success('موفق', 'با موفقیت از پیام های مهم خارج گردید');
        return back();
    }

    public function onupdatestar($id)
    {
        $mail = MessageReseiver::where('mail_id', $id)->where('author', auth()->user()->id)->orwhere('user_id', auth()->user()->id)->first();
        $mail->update([
            'important' => 0
        ]);

        alert()->success('موفق', 'با موفقیت از پیام های مهم خارج گردید');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    public function delete($id)
    {
//        alert()->confirmButton('ok','')
        $mail = MessageReseiver::where('id', $id)->where('user_id', auth()->user()->id)->first();
        $mail->delete();
        alert()->success('پیام شما با موفقیت حذف شد', 'حذف پیام')->autoclose(2000)->persistent('ok');


        return back();

    }

    public function deletemail($id)
    {
        $mailid = MessageReseiver::where('id', $id)->first()['mail_id'];
        $mailres = MessageReseiver::where('mail_id', $mailid)->get();
        foreach ($mailres as $M)
            if (!empty($M)) {
                $M->delete();
            }
        $mail = MailModel::where('id', $mailid)->first();
        $mail->delete();
        alert()->success('پیام شما با موفقیت حذف شد', 'حذف پیام')->autoclose(2000)->persistent('ok');
        return back();
    }

    public function important()
    {
        $id = auth()->user()->id;

        $mails = MessageReseiver::where('user_id', $id)->orderBy('created_at', 'desc')->where('important', 1)->get();
        $count = MessageReseiver::where('user_id', $id)->where('status', 0)->count();
        return view('mail.important', ['mails' => $mails])->with(['count' => $count]);
    }

    public function forward($id)
    {
        $mail = MailModel::where('id', $id)->first();
        $allusers = User::all()->sortBy('role');
        $user_id = auth()->user()->id;
        $count = MessageReseiver::where('user_id', $user_id)->where('status', 0)->count();
//        return $mail;
        return view('mail.forward', compact('allusers', 'count', 'mail'));
    }

    public function forwardto(Request $request, $id)
    {
        $this->validate(request(), [

            'to' => 'required'
        ]);
        $mail = MailModel::where('id', $id)->first();
        $user_id = $mail->user_id;
        $mail_id = $mail->id;
        $reseivers = $request->to;
        foreach ($reseivers as $reseiver) {
            if ($reseiver == 'all') {
                $usres = User::all()->pluck('id');
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
            } elseif ($reseiver == 'dabir') {
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
                MessageReseiver::create([
                    'mail_id' => $mail_id,
                    'user_id' => $reseiver,
                    'status' => 0,
                    'author' => $user_id,
                    'time' => time(),
                    'important' => 0,
                ]);
            }
        }

        alert()->success('موفق', 'با موفقیت ارسال  شد');

        return back();

    }
}

