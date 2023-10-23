<?php

namespace App\Http\Controllers\admin;

use App\clas;
use App\CMark;
use App\dars;
use App\Exam;
use App\ExamAnswer;
use App\ExamClass;
use App\ExamMark;
use App\ExamQuestion;
use App\Option;
use App\OptionImage;
use App\Question;
use App\Services\CvService;
use App\Services\MarkService;
use App\teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class ExamController extends Controller
{
    public $CvService;
    public $MarkService;

    public function __construct(CvService $cvService, MarkService $MarkService)
    {
        $this->CvService = $cvService;
        $this->MarkService = $MarkService;
    }

    public function index($id)
    {
        $classnumber = clas::where('classnamber', $id)->pluck('id')->first();
        $exam_id = ExamClass::where('class_id', $classnumber)->pluck('exam_id');

        $exams = Exam::whereIN('id', $exam_id)->with('users')->with('mymarks')->with('examclass')->with('examclass.darsname')->with('examclass.class')->paginate(20);

        return view('Admin.exam.index', compact('exams', 'id'));

    }

    public function student($id, $exam)
    {
        $student = User::where('role', 'دانش آموز')->where('class', $id)->pluck('id');
        $marks = ExamMark::where('exam_id', $exam)->whereIn('user_id', $student)->with('user')->get();
        $class = $id;
        $examid = $exam;
        return view('Admin.exam.student', compact('marks', 'class', 'examid'));
    }

    public function studentsingle($id, $exam_id)
    {
        $exam = Exam::where('id', $exam_id)->first();
        if ($exam->type == 0) {
            $exams = ExamQuestion::where('exam_id', $exam_id)
                ->with(['studentanswers' => function ($q) use ($id) {
                    $q->where('user_id', '=', $id);
                }])
                ->whereHas('studentanswers', function ($q) use ($id) {
                    $q->where('user_id', $id);
                })
                ->with('myoptions')->with('exam')->paginate(1);

            return view('Admin.exam.single', compact('exams'));
        } else {
            $exams = ExamQuestion::where('exam_id', $exam_id)
                ->with(['studentanswers' => function ($q) use ($id) {
                    $q->where('user_id', '=', $id);
                }])
                ->with('exam')->get();
            $user = User::find($id);
            return view('Admin.exam.descriptiveSingleStudent', compact('exams', 'exam', 'user'));

        }
    }

    public function export($examid, $clasid)
    {
        $student = User::where('role', 'دانش آموز')->where('class', $clasid)->pluck('id');
        $data = ExamMark::where('exam_id', $examid)->whereIn('user_id', $student)->
        join('users', 'users.id', '=', 'exam_marks.user_id')
            ->join('myexams', 'myexams.id', '=', 'exam_marks.exam_id')
            ->select(
                'myexams.title',
                'users.class',
                'users.f_name',
                'users.l_name',
                'exam_marks.mark',
                'myexams.created_at'

            )->get()
            ->toArray();
        $exam = Exam::find($examid);
        return Excel::create('نمرات آزمون' . ' ' . $exam->users->f_name . ' ' . $exam->users->l_name, function ($excel) use ($data) {
            $excel->sheet('نمرات آزمون', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

    public function generalCreate()
    {
        $classes = clas::all();
        $darses = dars::all();
        return view('Admin.exam.general.create', compact('classes', 'darses'));
    }

    public function generalStore(Request $request)
    {

        $this->validate(request(),
            [
                'date1' => 'required',
                'class' => 'required',
                'dars' => 'required',
                'time' => 'required',
                'title' => 'required',
                'countquestions' => 'required',
                'type' => 'required',
            ]
        );
        if ($request->mark_status) {
            $mark_status = 1;
        } else {
            $mark_status = 0;
        }

        $exam = new Exam();
        $exam->author = auth()->user()->id;
        $exam->title = $request->title;
        $exam->expire = $request['date-picker-shamsi-list'];
        $exam->date_start = $request->date1;
        $exam->texprie = $request->texpire;
        $exam->start = $request->start;
        $exam->countquestions = $request->countquestions;
        $exam->time = $request->time;
        $exam->type = $request->type;
        $exam->archive = 0;
        $exam->general = 1;
        $exam->number_dars = count($request->dars);
        $exam->mark_status = $mark_status;
        $exam->created_at = Jalalian::now();
        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images/exam');
            $cover->move($path, $filename);
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();
            $exam->filename = $filename;
            $exam->mime = $mime;
            $exam->original_filename = $original_filename;
        }
        $exam->save();
        $id = $exam->id;
        foreach ($request->dars as $dars) {
            $class = clas::where('id', $request->class)->first();
            $examclass = new ExamClass();
            $examclass->exam_id = $id;
            $examclass->class_id = $request->class;
            $examclass->dars_id = $dars;
            $examclass->save();
            if ($request->mark_status == 'on') {
                $cMark = $this->MarkService->createCMark($dars, $class->classnamber, $request->title);
                $cMark->update([
                    'exam_id' => $id
                ]);
            }
        }


        alert()->success('آزمون با موفقیت ایجاد شد حال در هر درس سوالات راایجاد کنید', 'عملیات موفق')->autoclose(5000);
        return redirect('admin/exam/doros/' . $id);
    }

    public function examDoros($id)
    {
        $doros = ExamClass::where('exam_id', $id)->with('darsname')->get();
        $exam = Exam::find($id);
        return view('Admin.exam.general.doros', compact('doros', 'exam'));

    }

    public function examDorosSort(Request $request, $id)
    {
        $row = ExamClass::where('exam_id', $id)->where('dars_id', $request->dars_id)->first();
        $row->update(['sort' => $request->sort]);
        $rows = ExamQuestion::where('exam_id', $id)->where('dars_id', $request->dars_id)->get();
        foreach ($rows as $row) {
            $row->update(['sort' => $request->sort]);
        }

        return back();
    }

    public function examDars($id)
    {
        $dars = ExamClass::where('id', $id)->first();
        $questions = ExamQuestion::where('exam_id', $dars->exam_id)->with('myoptions')->where('dars_id', $dars->dars_id)->get();
        $exam = Exam::where('id', $dars->exam_id)->first();
        if ($exam->type == 1) {
            return view('Admin.exam.general.descriptiveQuestions', compact('dars', 'questions', 'exam'));
        } else {
            return view('Admin.exam.general.testQuestions', compact('dars', 'questions', 'exam'));
        }

    }

    public function questionKey(Request $request)
    {

        foreach ($request->option as $key => $a) {
            $row = Option::find($key);
            $row->update(['correct' => $a]);
        }
        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق')->autoclose(5000);
        return back();
    }

    public function countQuestion(Request $request, $id)
    {
        $dars = ExamClass::where('id', $id)->first();
        $exam = Exam::where('id', $dars->exam_id)->first();
        $questions = ExamQuestion::where('exam_id', $dars->exam_id)->where('dars_id', $dars->dars_id)->get();
        $countQuestion = $questions->count();
        $newCountQuestions = $request->countquestions - $countQuestion;
        if ($newCountQuestions > 0) {
            for ($x = $countQuestion + 1; $x <= $request->countquestions; $x++) {
                $q = ExamQuestion::create([
                    'exam_id' => $dars->exam_id,
                    'sort' => $dars->sort,
                    'dars_id' => $dars->dars_id,
                    'title' => 'سوال شماره ' . $x,
                ]);
                if ($exam->type == 0) {
                    Option::create([
                        'question_id' => $q->id,
                        '1' => 'گزینه ۱',
                        '2' => 'گزینه ۲',
                        '3' => 'گزینه ۳',
                        '4' => 'گزینه ۴',
                        'correct' => '1',
                    ]);
                }
            }
        } elseif ($newCountQuestions < 0) {
            $newCountQuestions = (-1) * $newCountQuestions;
            $questions = ExamQuestion::where('exam_id', $dars->exam_id)
                ->where('dars_id', $dars->dars_id)
                ->orderByDesc('id')
                ->take($newCountQuestions)
                ->get();
            foreach ($questions as $question) {
                $option = Option::where('question_id', $question->id)->first();
                if($option){
                    $option->delete();

                }
                if($question){
                    $question->delete();

                }
            }

        }
        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق')->autoclose(5000);
        return back();
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = ExamQuestion::find($id);
        $question->description = $request->description;
        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images/exam');
            $cover->move($path, $filename);
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();
            $question->file = $filename;
            $question->mime = $mime;
            $question->original_filename = $original_filename;
        }
        $question->save();
        $option = Option::where('question_id', $id)->first();
        $option->update([
            '1' => $request->get('1'),
            '2' => $request->get('2'),
            '3' => $request->get('3'),
            '4' => $request->get('4'),
            'correct' => $request->get('correct'),
        ]);
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق');
        return back();
    }

    public function generals($id)
    {
        $classnumber = clas::where('classnamber', $id)->pluck('id')->first();
        $exam_id = ExamClass::where('class_id', $classnumber)->pluck('exam_id');

        $exams = Exam::whereIN('id', $exam_id)->where('general', 1)->with('users')->with('mymarks')->with('examclass')->with('examclass.darsname')->with('examclass.class')->paginate(20);

        return view('Admin.exam.general.index', compact('exams', 'id'));
    }

    public function generalEdit($id)
    {
        $exam = Exam::where('id', $id)->with('examclass')->with('examclass.darsname')->with('examclass.class')->first();
        $classes = clas::all();
        $darses = dars::all();
        $thisDars = [];
        foreach ($exam['examclass'] as $class) {
            $thisDars[] = $class->dars_id;
        }
        return view('Admin.exam.general.edit', compact('classes', 'exam', 'darses', 'thisDars'));
    }

    public function generalUpdate(Request $request, $id)
    {
        $this->validate(request(),
            [
                'date1' => 'required',
                'class' => 'required',
                'dars' => 'required',
                'time' => 'required',
                'title' => 'required',
                'countquestions' => 'required',
                'type' => 'required',
            ]
        );
        if ($request->mark_status) {
            $mark_status = 1;
        } else {
            $mark_status = 0;
        }

        $exam = Exam::find($id);
        $pmark_status = $exam->mark_status;
        $exam->title = $request->title;
        $exam->expire = $request['date-picker-shamsi-list'];
        $exam->date_start = $request->date1;
        $exam->texprie = $request->texpire;
        $exam->start = $request->start;
        $exam->countquestions = $request->countquestions;
        $exam->time = $request->time;
        $exam->type = $request->type;
        $exam->number_dars = count($request->dars);
        $exam->mark_status = $mark_status;
        $exam->updated_at = Jalalian::now();
        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images/exam');
            $cover->move($path, $filename);
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();
            $exam->filename = $filename;
            $exam->mime = $mime;
            $exam->original_filename = $original_filename;
        }
        $exam->save();
        $id = $exam->id;
        $pclass = ExamClass::where('exam_id', $exam->id)->get();
        if (count($pclass) > 0) {
            foreach ($pclass as $pclas) {
                $pclas->delete();
            }
        }
        foreach ($request->dars as $dars) {
            $class = clas::where('id', $request->class)->first();
            $dars_id = $dars;
            $examclass = new ExamClass();
            $examclass->exam_id = $id;
            $examclass->class_id = $class->id;
            $examclass->dars_id = $dars;
            $examclass->save();
            if ($pmark_status == 1 and $mark_status == 0) {
                $this->MarkService->deleteAllMarks('exam_id', $exam->id);
            }
            if ($pmark_status == 0 and $mark_status == 1) {
                $cMark = $this->MarkService->createCMark($dars_id, $class->classnamber, $request->title);
                $cMark->update([
                    'exam_id' => $exam->id
                ]);
            }
        }
        alert()->success('ویرایش با موفقیت انجام شد', 'عملیات موفق');
        return back();
    }

    public function delete($id)
    {
        $exam = Exam::where('id', $id)->first();
        $examClass = ExamClass::where('exam_id', $exam->id)->get();
        $cMarks = CMark::where('exam_id', $exam->id)->get();
        if ($cMarks) {
            foreach ($cMarks as $cMark) {
                $cMark->delete();
            }
        }
        if ($examClass) {
            foreach ($examClass as $class) {
                $class->delete();
            }
        }
        $exam->delete();
    }

    public function deleteDars($id)
    {
        $examClass = ExamClass::where('id', $id)->first();
        $examQuestions = ExamQuestion::where('exam_id', $examClass->exam_id)->where('dars_id', $examClass->dars_id)->get();
        if ($examQuestions != '[]') {
            $answers = ExamAnswer::whereIn('question_id', $examQuestions->pluck('id'))->get();
            if ($answers != '[]')
                foreach ($answers as $answer) {
                    $answer->delete();
                }
        }
        foreach ($examQuestions as $examQuestion) {
            $examQuestion->delete();
        }
        $examClass->delete();

    }

}
