<?php

namespace App\Http\Controllers\admin;

use App\dars;
use App\Http\Controllers\Controller;
use App\MessageReseiver;
use App\paye;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->paginate(25);

        return view('Admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::latest()->get();

        return view('Admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'permission' => 'required',
            'name' => 'required',
            'label' => 'required'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permission'));
        alert()->success('موفق', 'ثبت گردید');
        return redirect('/Admin/roles');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Role::find($id);
        if ($data != null) {
            $data->delete($id);
            return 'ok';
        }
        return 'fail';
    }

    public function usercreate()
    {

        $roles = Role::all()->where('label', '!=', 'web');
        $users = User::where('role', '!=', 'دانش آموز')->where('role', '!=', 'اولیا')->get();
        alert()->error('با اختصاص سمت جدید، سمت قبلی خودکار پاک می شود.', 'توجه')->autoclose(2000)->persistent('ok');

        return view('Admin.role-user.index', compact('roles', 'users'));
    }

    public function userstore(Request $request)
    {
        $user = User::where('id', $request->user)->first();
        $user->roles()->sync($request->input('role'));
        $roles = Role::all();
        $users = User::where('role', '!=', 'دانش آموز')->where('role', '!=', 'اولیا')->get();

        alert()->success('دسترسی ها به فرد مورد نظر اختصاص داده شد.', 'موفق')->autoclose(2000)->persistent('ok');

        return view('Admin.role-user.show', compact('roles', 'users'));

    }

    public function usershow()
    {
        $roles = Role::all();
        $users = User::where('role', '!=', 'دانش آموز')->where('role', '!=', 'اولیا')->get();

        return view('Admin.role-user.show', compact('roles', 'users'));
    }
}
