<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = User::whereNOtIn('role', ['مدیر', 'دانش آموز', 'اولیا', 'معلم'])->get();
        return view('Admin.personal.view', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.personal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['digits:11', 'numeric', 'unique:users,mobile'],
            'codemeli' => ['required', 'digits:10', 'numeric', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
        ]);
        User::create([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'sex' => $request['sex'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'mobile' => $request['phone'],
            'codemeli' => $request['codemeli'],
            'role' => $request['role'],
            'status' => 1,

        ]);

        alert()->success('پرسنل جدید با موفقیت افزوده شد', 'عملیات موفق');
        return redirect('admin/personals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::find($id);
        return view('Admin.personal.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'codemeli' => 'required',
            ]
        );
        $user= User::find($id);

        $user->update([
            'f_name' => $request['f_name'],
            'l_name' => $request['l_name'],
            'sex' => $request['sex'],
            'email' => $request['email'],
            'mobile' => $request['phone'],
            'role' => $request['role'],
        ]);

        alert()->success('پرسنل  با موفقیت ویرایش شد', 'عملیات موفق');
        return redirect('admin/personals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        حذف از جدول   user
        $row = User::where('id', $id)->first();
        $row->delete();

        return back();
    }
}
