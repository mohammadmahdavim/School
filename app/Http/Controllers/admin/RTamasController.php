<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\RTamas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RTamasController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view(){
        $rows=DB::table('r_tamas')->orderBy('created_at','desc')->paginate(6);

        return view('Admin.rtamas.view',compact('rows'));

    }

    public function changeStatus(Request $request)
    {
        $RTamas = RTamas::find($request->id);
        $RTamas->status = $request->status;
        $RTamas->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
    public function destroy($id)
    {
        $RTamas = RTamas::find($id);
        $RTamas->delete();

        return response()->json(['success' => 'Status change successfully.']);
    }

}
