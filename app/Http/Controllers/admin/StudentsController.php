<?php

namespace App\Http\Controllers\admin;

use App\Archive;
use App\clas;
use App\CommentMoshaver;
use App\ExamAnswer;
use App\Http\Controllers\Controller;
use App\MarkItem;
use App\ModelParent;
use App\paye;
use App\RollCallMoshaver;
use App\student;
use App\TotalMark;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = user::where('role', 'دانش آموز')
            ->when($request->get('name'), function ($query) use ($request) {
                $query->where('f_name', $request->name)
                    ->orwhere('l_name', $request->name);
            })
            ->when($request->get('Fname'), function ($query) use ($request) {
                $query->where('Fname', 'like', '%' . $request->Fname . '%');
            })
            ->when($request->get('codemeli'), function ($query) use ($request) {
                $query->where('codemeli', 'like', '%' . $request->codemeli . '%');
            })
            ->when($request->get('class'), function ($query) use ($request) {
                $query->where('class', 'like', '%' . $request->class . '%');
            })
            ->when($request->get('start_date'), function ($query) use ($request) {

                $query->where('created_at', '>=', $request->start_date);
            })
            ->when($request->get('end_date'), function ($query) use ($request) {

                $query->where('created_at', '<=', $request->end_date);
            })
            ->orderBy('class')
            ->orderby('l_name')
            ->paginate(20);

        $allclass = clas::all();

        return view('Admin.student.show', compact('users', 'allclass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paye = paye::all();
        $claass = DB::table('clas')->orderBy('classnamber')->pluck('classnamber');

        return view('Admin.student.create', compact('paye', 'claass'));
    }

    /*
     ایجاد دانش آموز جدید در دیتابیس*
     در جداول user(هم برای دانش آموز و هم اولیا)و student , parents*
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
                'f_name' => 'required',
                'l_name' => 'required',
                'Fname' => 'required',
                'codemeli' => ['required', 'unique:users'],
                'paye' => 'required',
                'classnamber' => 'required',
            ]
        );
        $national_code = $request['codemeli'];
        $national_code = str_replace(' ', '', $national_code);
        $lenght = \Illuminate\Support\Str::length($national_code);
        if ($lenght == 8) {
            $national_code = '00' . $national_code;
        } elseif ($lenght == 9) {
            $national_code = '0' . $national_code;
        }
        $id = User::create([
            'f_name' => request('f_name'),
            'l_name' => request('l_name'),
            'Fname' => request('Fname'),
            'sex' => request('sex'),
            'shomarande' => request('shomarande'),
            'birthday' => request('date-picker-shamsi-list'),
            'codemeli' => request('codemeli'),
            'email' => request('email'),
            'password' => Hash::make($request['codemeli']),
            'password_show' => $request['codemeli'],
            'role' => request('role'),
            'paye' => request('paye'),
            'mobile' => request('mobile'),
            'mobile_father' => request('mobile_father'),
            'mobile_mother' => request('mobile_mother'),
            'class' => request('classnamber'),
            'sabttime' => Carbon::now(),
            'status' => 1,

        ])->id;
        $idparent = $id + 1000;
        $codmeliparent = '1' . $national_code;

        User::create([
            'id' => $idparent,
            'f_name' => request('Fname'),
            'l_name' => request('l_name'),
            'codemeli' => $codmeliparent,
            'password' => Hash::make($codmeliparent),
            'role' => 'اولیا',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'paye' => request('paye'),
            'mobile_father' => request('mobile_father'),
            'class' => request('classnamber'),
            'sabttime' => Carbon::now(),
            'status' => 1,

        ]);

        ModelParent::create([
            'user_id' => $idparent,
            'student_id' => $id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        student::create([
            'user_id' => $id,
            'classid' => request('classnamber'),
            'address' => request('address'),
            'description' => request('description'),
        ]);
        alert()->success('دانش آموز شما با موفقیت ایجاد شد', 'ایجاد دانش آموز')->autoclose(2000)->persistent('ok');
        return back();
    }


    public function studentEdit($id)
    {
        $user = User::find($id);
        $paye = paye::all();
        $claass = DB::table('clas')->orderBy('classnamber')->pluck('classnamber');

        return view('Admin.student.edit', compact('paye', 'claass', 'user'));
    }

    /*
     ویرایش اطلاعات دانش آموز و اولیا در جدول users*
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->validate(request(), [
                'f_name' => 'required',
                'l_name' => 'required',
                'codemeli' => ['required'],
                'paye' => 'required',
                'classnamber' => 'required',
            ]

        );
        $national_code = $request['codemeli'];
        $national_code = str_replace(' ', '', $national_code);
        $lenght = \Illuminate\Support\Str::length($national_code);
        if ($lenght == 8) {
            $national_code = '00' . $national_code;
        } elseif ($lenght == 9) {
            $national_code = '0' . $national_code;
        }
        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . '.png';
            $path = public_path('/uploads/' . $filename);
            Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
            $original_filename = $cover->getClientOriginalName();
            $user = User::where('id', $id)->first();
            $user->update([
                'l_name' => $request->l_name,
                'f_name' => $request->f_name,
                'fname' => $request->Fname,
                'original_filename' => $original_filename,
                'resizeimage' => $original_filename,
                'filename' => $filename,
                'class' => $request->classnamber,
                'paye' => $request->paye,
                'sex' => $request->sex,
                'status' => 1,
                'codemeli' => request('codemeli'),
                'password' => Hash::make($request['codemeli']),
            ]);
        } else {
            $user = User::where('id', $id)->first();
            $user->update([
                'l_name' => $request->l_name,
                'f_name' => $request->f_name,
                'fname' => $request->Fname,
                'mobile' => request('mobile'),
                'mobile_father' => request('mobile_father'),
                'mobile_mother' => request('mobile_mother'),
                'class' => $request->classnamber,
                'paye' => $request->paye,
                'sex' => $request->sex,
                'status' => 1,
                'codemeli' => request('codemeli'),
                'password' => Hash::make($request['codemeli']),
            ]);
        }
        $parent = User::where('id', $id + 1000)->first();
        $codmeliparent = '1' . $national_code;

        if ($parent) {
            $parent->update([
                'l_name' => $request->l_name,
                'f_name' => $request->Fname,
                'class' => $request->classnamber,
                'paye' => $request->paye,
                'sex' => $request->sex,
                'mobile' => request('mobile_father'),
                'codemeli' => $codmeliparent,
                'password' => Hash::make($codmeliparent),
            ]);
        }
        $student = student::where('user_id', $user->id)->first();
        if ($student) {
            $student->update([
                'classid' => $request->classnamber,
                'address' => request('address'),
                'description' => request('description'),
            ]);
        } else {
            student::create([
                'user_id' => $user->id,
                'classid' => $request->classnamber,
                'address' => request('address'),
                'description' => request('description'),

            ]);
        }

        alert()->success('دانش آموز  شما با موفقیت ویرایش شد', 'ویرایش دانش آموز')->autoclose(2000)->persistent('ok');

        return back();
    }

    /*
     * حذف کلیه اطلاعت مربوط به دانش موز در جداول user - mark - student - total_marks
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arshives = Archive::where('user_id', $id)->get();
        $idp = $id + 1000;
        $user = User::where('id', $id)->first();
        $parent = User::where('id', $idp)->first();
        $parentmodel = ModelParent::where('user_id', $idp)->first();
        $student = student::where('user_id', $id)->first();
        $marks = MarkItem::where('user_id', $id)->get();
        $Tmarks = TotalMark::where('user_id', $id)->get();
        $commentmoshaver = CommentMoshaver::where('user_id', $id)->get();
        $RollCallMoshaver = RollCallMoshaver::where('user_id', $id)->get();
        $ExamAnswer = DB::table('exam_answerss')->where('user_id', $id)->delete();
        $ExamAnswer = DB::table('exam_histories')->where('user_id', $id)->delete();
//        dd($ExamAnswer);
//return $ExamAnswer;
        if (count($RollCallMoshaver) > 0) {

            foreach ($RollCallMoshaver as $RollCall) {
                $RollCall->delete();
            }
        }
//        if (count($ExamAnswer)>0) {
//            foreach ($ExamAnswer as $ans) {
//                $ans->delete();
//            }
//        }
        if (count($commentmoshaver) > 0) {
            foreach ($commentmoshaver as $comment) {
                $comment->delete();
            }
        }
        if (count($arshives) > 0) {
            foreach ($arshives as $arshive) {
                $arshive->delete();
            }
        }
        if (count($marks) > 0) {

            foreach ($marks as $mark) {
                $mark->delete();
            }
        }
        if (count($Tmarks) > 0) {

            foreach ($Tmarks as $Tmark) {
                $Tmark->delete();
            }
        }
        if (!empty($user)) {
            $user->delete();

        }
        if (!empty($student)) {

//            $student->delete();

        }
        if (!empty($parent)) {
            $parent->delete();

        }
        if (!empty($parentmodel)) {
//            $parentmodel->delete();

        }
        return back();

    }

    /*
     * مشاهده کلاس به کلاس دانش آموزان
     */
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function class($id)
    {
        $users = User::where('class', $id)->where('role', 'دانش آموز')->orderBy('l_name')->get();
        $allclas = clas::all();
        return view('Admin.student.classshow', compact('users', 'allclas'));

    }

    /*
     * مشاهده اطلاعات اولیا
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function parent()
    {
        $users = User::where('role', 'اولیا')
            ->orderBy('class')
            ->orderBy('l_name')
            ->paginate(40);

        return view('Admin.parent.show', compact('users'));
    }

    public function card($id)
    {
        $user = User::find($id);
        return view('Admin.student.card', compact('user'));

    }
}
