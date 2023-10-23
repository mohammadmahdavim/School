<?php

namespace App\Http\Controllers\teacher;

use App\clas;
use App\Http\Controllers\Controller;
use App\MessageReseiver;
use App\student;
use App\teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentsController extends Controller
{

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function class(request $request, $id)
    {
//        single page for ClassStudent
        if (auth()->user()->role == 'معلم') {

            $users = User::where('class', $id)->where('role','دانش آموز')->orderBy('l_name', 'desc')->get();
            $classnamber = clas::where('classnamber', $id)->first();
            $nav = $classnamber->classnamber;

            return view('Teacher.student.show', compact('users', 'nav'));
        } else {
            return view('errors.404');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (auth()->user()->role == 'معلم') {

            $this->validate(request(), [
                    'f_name' => 'required',
                    'l_name' => 'required',
                    'fname' => 'required',
                ]

            );
            $user = User::where('id', $id)->first();
            $user->update([
                'f_name' => request('f_name'),
                'l_name' => request('l_name'),
                'fname' => request('fname'),
            ]);
            $parent = User::where('id', $id + 1000)->first();
            $parent->update([
                'l_name' => $request->l_name,
                'f_name' => $request->fname,
            ]);
            alert()->success('دانش آموز شما با موفقیت ویرایش شد', 'ویرایش دانش آموز')->autoclose(10000)->persistent('ok');

            return back();
        } else {
            return view('errors.404');
        }
    }



}
