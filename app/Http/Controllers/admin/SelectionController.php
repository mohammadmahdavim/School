<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\Option;
use App\Selection;
use App\SelectionItem;
use App\SelectionMember;
use App\SelectionOption;
use App\Services\SelectionService;
use App\teacher;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;

class SelectionController extends Controller
{
    public $SelectionService;

    public function __construct(SelectionService $cvService)
    {
        $this->SelectionService = $cvService;
    }

    public function index($id)
    {
        $rows = SelectionItem::where('id', $id)
            ->with('selection')
            ->wherehas('selection', function ($q) {
                $q->orderByDesc('created_at');
            })->first();
        if (!$rows) {
            alert()->warning('در این دسته بندی نظرسنجی وجود ندارد. ایجاد کنید.', 'هدایت به صفحه ایجاد')->autoclose(5000);

            return redirect('admin/selection/create/' . $id);
        }
        return view('Admin.selection.index', ['rows' => $rows]);
    }

    public function create($id)
    {
        $item = SelectionItem::find($id);
        $class = clas::all();

        return view('Admin.selection.create', ['item' => $item, 'class' => $class]);
    }

    public function store(Request $request)
    {
        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'selection_items_id' => 'required',
            'manager' => 'required',
            'date' => 'required',
            'users' => 'required',
            'class' => 'required',
            'description' => 'required',
            'number' => 'required',
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
        $row = Selection::create([
            'title' => request('title'),
            'selection_items_id' => request('selection_items_id'),
            'manager' => request('manager'),
            'date' => request('date'),
            'description' => request('description'),
            'permission' => request('number'),
            'winner' => request('winner'),
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
                        SelectionMember::create([
                            'selection_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'student') {
                    $type = 'دانش آموز';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        SelectionMember::create([
                            'selection_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'parent') {
                    $type = 'اولیا';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        SelectionMember::create([
                            'selection_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'other') {
                    $type = 'دیگران';
                    $users = User::whereNOtIn('role', ['اولیا', 'دانش آموز', 'معلم'])->pluck('id');
                    foreach ($users as $iduser) {
                        SelectionMember::create([
                            'selection_id' => $row,
                            'user_id' => $iduser,
                        ]);
                    }
                }
            }
        }
        alert()->success('عملیات با موفقیت انجام شد حال گزینه ها راایجاد کنید', 'عملیات موفق')->autoclose(5000);
        return redirect('/admin/selection/option/' . $row);
    }

    public function option($id)
    {
        $row = Selection::find($id);
        return view('Admin.selection.option', ['row' => $row]);
    }

    public function optionstore(Request $request)
    {
        $id = Selection::where('id', $request->selection_id)->pluck('selection_items_id')->first();
#crete options
        $questions = $this->SelectionService->Option($request->question);
        $imageid = 1;
        foreach ($questions as $question) {
            $newquestion = new SelectionOption();
            $newquestion->selection_id = $request->selection_id;
            $newquestion->name = $question['title'];
            $newquestion->description = $question['description'];
            $newquestion['created_at'] = strtotime(Carbon::now());
            if (isset($question['file'])) {
                $file = $question['file'];
                $filename = time() . $imageid . '.' . $file->getClientOriginalExtension();
                $file_resize = Image::make($file->getRealPath());
                $file_resize->save(public_path('/images/' . $filename), 100);
                $newquestion['file'] = $filename;
            }
            $newquestion->save();
            $imageid = $imageid + 1;
        }
#end
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(5000);

        return redirect('/admin/selection/' . $id);
    }

    public function changeStatus(Request $request)
    {
        $karnameh = Selection::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }


    public function edit($id)
    {

        $row = Selection::find($id);
        $class = clas::all();
        return view('Admin.selection.edit', ['row' => $row, 'class' => $class]);
    }

    public function update(Request $request, $id)
    {
        //        اعتبار سنجی اطلاعات ارسالی از فرم
        $this->validate(request(), [
            'title' => 'required',
            'manager' => 'required',
            'date' => 'required',
            'description' => 'required',
            'number' => 'required',
            'users' => 'required',
            'class' => 'required',
        ]);
        $row = Selection::find($id);

//        ایجاد فایل مناسب برای عکس ها
        $images = $request->file('patchfile');
        if (!empty($request->patchfile)) {

            foreach ($images as $patchfile) {
                $cover = $patchfile;
                $filename = time() . '.png';
                $path = public_path('/images/' . $filename);
                Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
            }
            $row->update([
                'title' => request('title'),
                'manager' => request('manager'),
                'date' => request('date'),
                'description' => request('description'),
                'permission' => request('number'),
                'winner' => request('winner'),
                'file' => $filename,
                'class' => json_encode($request->class),
                'user' => json_encode($request->users),
                'updated_at' => Jalalian::now(),
            ]);
        } else {
            $row->update([
                'title' => request('title'),
                'manager' => request('manager'),
                'date' => request('date'),
                'description' => request('description'),
                'permission' => request('number'),
                'winner' => request('winner'),
                'class' => json_encode($request->class),
                'user' => json_encode($request->users),
                'updated_at' => Jalalian::now(),
            ]);
        }
        $members = SelectionMember::where('selection_id', $row->id)->get();
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
                        SelectionMember::create([
                            'selection_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'student') {
                    $type = 'دانش آموز';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        SelectionMember::create([
                            'selection_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'parent') {
                    $type = 'اولیا';
                    $users = User::where('class', $class)->where('role', $type)->pluck('id');
                    foreach ($users as $iduser) {
                        SelectionMember::create([
                            'selection_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                } elseif ($user == 'other') {
                    $type = 'دیگران';
                    $users = User::whereNOtIn('role', ['اولیا', 'دانش آموز', 'معلم'])->pluck('id');
                    foreach ($users as $iduser) {
                        SelectionMember::create([
                            'selection_id' => $row->id,
                            'user_id' => $iduser,
                        ]);
                    }
                }
            }
        }

        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(5000);

        return back();
    }

    public function view($id)
    {
        $row = SelectionOption::where('Selection_id', $id)
            ->with('selection')
            ->orderByDesc('value')
            ->get();
        return view('Admin.selection.optionview', ['row' => $row]);

    }

    public function result($id)
    {
        $row = SelectionOption::where('Selection_id', $id)
            ->with('selection')
            ->orderByDesc('value')
            ->get();
        $chart = SelectionOption::where('Selection_id', $id)
            ->orderByDesc('value')
            ->get();
        $user = [];
        $count = [];
        $allcount = 0;
        foreach ($chart as $cha) {
            $allcount = $allcount + $cha->value;
        }
        if ($allcount != 0) {
            foreach ($chart as $cha) {
                $user[] = $cha->name;
                $count[] = (($cha->value) / $allcount) * 100;
            }
        }
        else{
            foreach ($chart as $cha) {
                $user[] = $cha->name;
                $count[] = $cha->value ;
            }
        }
//        return $count;
        $chartt = Charts::create('bar', 'fusioncharts')
            ->title('تعداد رای ها')
            ->elementLabel("تعداد")
            ->labels($user)
            ->values($count)
            ->dimensions(1000, 600)
            ->responsive(false);

        return view('Admin.selection.optionresult', ['row' => $row, 'chartt' => $chartt]);

    }

    public function optiondelete($id)
    {
        $option = SelectionOption::where('id', $id)->first();
        $option->delete();
    }


    public function delete($id)
    {
        $selection = Selection::where('id', $id)->first();
        $options = SelectionOption::where('selection_id', $id)->get();
        if ($options) {
            foreach ($options as $option) {
                $option->delete();
            }
        }
        $memebers = SelectionMember::where('selection_id', $id)->get();
        if ($memebers) {
            foreach ($memebers as $memeber) {
                $memeber->delete();
            }
        }
        $selection->delete();
    }
}
