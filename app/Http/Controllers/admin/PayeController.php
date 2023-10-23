<?php

namespace App\Http\Controllers\admin;

use App\paye;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayeController extends Controller
{
    public function index()
    {
        $payes = paye::all();
        return view('Admin.paye.index', compact('payes'));

    }

    public function store(Request $request)
    {
        $this->validate(request(), [

                'name' => ['required', 'unique:payes'],
            ]
        );
        paye::create([
            'name' => request('name'),
        ]);
        alert()->success('پایه با موفقیت ایجاد شد', 'عملیت موفق')->autoclose(2000)->persistent('ok');
        return back();
    }

    public function destroy($id)
    {

//        حذف از جدول   home
        $row = paye::where('id', $id)->first();
        $row->delete();

    }
}
