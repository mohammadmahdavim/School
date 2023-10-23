<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\Hamayesh;
use App\HamayeshMemeber;
use App\teacher;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;

class HamayeshController extends Controller
{
    public function index()
    {
        $rows = Hamayesh::all();
        return view('Admin.hamayesh.index', compact('rows'));
    }

    public function create()
    {
        $class = clas::all();
        return view('Admin.hamayesh.create', ['class' => $class]);
    }

    public function store(Request $request)
    {
        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'manager' => 'required',
            'date' => 'required',
            'time' => 'required',
            'users' => 'required',
            'class' => 'required',
            'description' => 'required',
            'items' => 'required',
            'address' => 'required',
            'patchfile' => 'required|max:5240'
        ]);
//        ایجاد فایل مناسب برای عکس ها
        $images = $request->file('patchfile');

        foreach ($images as $patchfile) {
            $cover = $patchfile;
            $filename = time() . '.png';
            $path = public_path('/images/' . $filename);
            Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
        }
        $row = Hamayesh::create([
            'title' => request('title'),
            'manager' => request('manager'),
            'context' => request('context'),
            'date' => request('date'),
            'time' => request('time'),
            'description' => request('description'),
            'address' => request('address'),
            'items' => request('items'),
            'file' => $filename,
            'class' => json_encode($request->class),
            'user' => json_encode($request->users),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ])->id;

        foreach ($request->users as $user) {

            foreach ($request->class as $class) {
                if ($user == 'teacher') {
                    $type = 'معلم';
                    $teachers = teacher::where('class_id', $class)->pluck('user_id');
                    $users = $teachers->unique('user_id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'student') {
                    $type = 'دانش آموز';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'parent') {
                    $type = 'اولیا';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'other') {
                    $type = 'دیگران';
                    $users = User::whereNOtIn('role', ['اولیا', 'دانش آموز', 'معلم'])->pluck('id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                }
            }
        }
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(5000);
        return back();
    }

    public function edit($id)
    {
        $row = Hamayesh::find($id);
        $class = clas::all();

        return view('Admin.hamayesh.edit', ['row' => $row, 'class' => $class]);

    }

    public function update(Request $request, $id)
    {

        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'manager' => 'required',
            'date' => 'required',
            'time' => 'required',
            'users' => 'required',
            'class' => 'required',
            'description' => 'required',
            'items' => 'required',
            'address' => 'required',
        ]);
        $row = Hamayesh::find($id);

//        ایجاد فایل مناسب برای عکس ها
        $images = $request->file('patchfile');
        if ($request->patchfile != [null]) {
            foreach ($images as $patchfile) {
                $cover = $patchfile;
                $filename = time() . '.png';
                $path = public_path('/images/' . $filename);
                Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
            }
            $row->update([
                'title' => request('title'),
                'manager' => request('manager'),
                'context' => request('context'),
                'date' => request('date'),
                'time' => request('time'),
                'description' => request('description'),
                'address' => request('address'),
                'items' => request('items'),
                'file' => $filename,
                'class' => json_encode($request->class),
                'user' => json_encode($request->users),
                'updated_at' => Jalalian::now(),
            ]);
        } else {
            $row->update([
                'title' => request('title'),
                'manager' => request('manager'),
                'context' => request('context'),
                'date' => request('date'),
                'time' => request('time'),
                'description' => request('description'),
                'address' => request('address'),
                'items' => request('items'),
                'class' => json_encode($request->class),
                'user' => json_encode($request->users),
                'updated_at' => Jalalian::now(),
            ]);
        }
        $members = HamayeshMemeber::where('hamayesh_id', $row->id)->get();
        if ($members) {
            foreach ($members as $member) {
                $member->delete();
            }
        }

        foreach ($request->users as $user) {

            foreach ($request->class as $class) {
                if ($user == 'teacher') {
                    $type = 'معلم';
                    $teachers = teacher::where('class_id', $class)->pluck('user_id');
                    $users = $teachers->unique('user_id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'student') {
                    $type = 'دانش آموز';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'parent') {
                    $type = 'اولیا';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'other') {
                    $type = 'دیگران';
                    $users = User::whereNOtIn('role', ['اولیا', 'دانش آموز', 'معلم'])->pluck('id');
                    foreach ($users as $iduser) {
                        HamayeshMemeber::create([
                            'hamayesh_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                }
            }
        }

        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(5000);

        return back();
    }

    public function show($id)
    {
        $row = Hamayesh::where('id', $id)->with('memeber.user')->first();
        return view('Admin.hamayesh.show', ['row' => $row]);
    }

    public function delete($id)
    {
        $selection = Hamayesh::where('id', $id)->first();

        $memebers = HamayeshMemeber::where('hamayesh_id', $id)->get();
        if ($memebers) {
            foreach ($memebers as $memeber) {
                $memeber->delete();
            }
        }
        $selection->delete();
    }


    public function list(Request $request, $id)
    {
        return $request;
    }

    public function changeStatus(Request $request)
    {
        $karnameh = Selection::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }


}
