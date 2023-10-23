<?php

namespace App\Http\Controllers\admin;

use App\Maghta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class maghtaController extends Controller
{
    public function index()
    {

        $rows = DB::table('maghta')->get();
        return view('admin.maghta.index', compact('rows'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
                'name' => 'required',
            ]
        );

        Maghta::create(['name' => $request->name]);
        alert()->success('مقطع  شما با موفقیت ایجاد شد', 'ایجاد مقطع')->autoclose(2000)->persistent('ok');
        return back();
    }

    public function destroy($id)
    {
        $clas = Maghta::where('id', $id)->first();
        $clas->delete();
        alert()->success('مقطع  شما با موفقیت حذف شد', 'حذف مقطع')->autoclose(2000)->persistent('ok');
        return back();
    }
}
