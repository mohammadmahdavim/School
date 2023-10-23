<?php

namespace App\Http\Controllers\admin;

use App\FirstMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirstMessageController extends Controller
{
    public function index()
    {
        $rows = FirstMessage::all();

        return view('Admin.message.index', compact('rows'));

    }

    public function create()
    {

        return view('Admin.message.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
                'message' => 'required',
                'receiver' => 'required',
            ]
        );
        $modal = 0;

        if ($request->modal) {
            $modal = 1;
        }
        $row = FirstMessage::where('receiver', $request->receiver)->where('modal', 1)->first();
        if ($row) {
            $row->update([
                'modal' => 0
            ]);
        }
        foreach ($request->receiver as $receiver) {
            FirstMessage::create([
                'receiver' => $receiver,
                'message' => $request->message,
                'modal' => $modal,
            ]);
        }
        alert()->success('پیام با موفقیت ایجاد شد', 'عملیات موفق');
        return back();

    }

    public function modal(Request $request)
    {
//return $request;
        $receiver = FirstMessage::where('id', $request->id)->first();
        if ($request->modal == 1) {
            $row = FirstMessage::where('receiver', $receiver->receiver)->where('modal', 1)->first();

            if (!empty($row)) {

                $row->update([
                    'modal' => 0
                ]);
            }

            $receiver->update([
                'modal' => 1
            ]);
        } else {
            $receiver->update([
                'modal' => 0
            ]);
        }

    }

    public function destroy($id)
    {
        $row = FirstMessage::find($id);
        $row->delete();
    }
}
