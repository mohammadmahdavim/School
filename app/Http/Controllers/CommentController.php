<?php

namespace App\Http\Controllers;

use App\Comment;
use App\PComment;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
//return $id;
        //        اعتبار سنجی اطلاعات ارسالی از فرم

        $this->validate(request(), [
            'name' => 'required',
            'comment' => 'required',
        ]);
        Comment::create([
            'name' => request('name'),
            'body' => request('comment'),
            'matlab_id' => $id,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('نظر شما بعد از تایید مدیر در سایت قرار می گیرد', 'موفق')->autoclose(2000000);

        return back();


    }

    public function pstore(Request $request,$matlabid,$commentid){

        //        اعتبار سنجی اطلاعات ارسالی از فرم

        $this->validate(request(), [
            'name' => 'required',
            'comment' => 'required',
        ]);
         PComment::create([
            'name' => request('name'),
            'body' => request('comment'),
            'matlab_id' => $matlabid,
            'comment_id' => $commentid,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('نظر شما بعد از تایید مدیر در سایت قرار می گیرد', 'موفق')->autoclose(2000000);

        return back();
    }

    public function changeStatus(Request $request){
        $karnameh = Comment::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function pchangeStatus(Request $request){
        $karnameh = PComment::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
