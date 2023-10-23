<?php

namespace App\Http\Controllers\teacher;

use App\Archive;
use App\clas;
use App\CMark;
use App\dars;
use App\Exam;
use App\ExamAnswer;
use App\ExamClass;
use App\ExamMark;
use App\ExamQuestion;
use App\Exports\ChequeExport;
use App\MarkItem;
use App\Option;
use App\OptionImage;
use App\Question;
use App\Services\CvService;
use App\Services\MarkService;
use App\teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
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

    public function index()
    {
        if (auth()->user()->role == 'مدیر') {
            $exams = Exam::where('archive', 0)
                ->orderByDesc('created_at')

                ->with('examclass')
                ->with('examclass.darsname')
                ->with('examclass.class')
                ->has('examclass')
                ->where('type', 0)
                ->orderbyDesc('created_at')
                ->paginate(10);
        } else {
            $exams = Exam::where('author', auth()->user()->id)
                ->orderByDesc('created_at')
                ->where('archive', 0)
                ->with('examclass')
                ->with('examclass.darsname')
                ->with('examclass.class')
                ->has('examclass')
                ->where('type', 0)
                ->orderbyDesc('created_at')
                ->paginate(10);

        }


        return view('Teacher.exam.index', compact('exams'));
    }

    public function create()
    {
        if (auth()->user()->role == 'مدیر') {
            $allclas = teacher::with('class')->with('darss')->get();

        } else {
            $allclas = teacher::where('user_id', auth()->user()->id)->with('class')->with('darss')->get();

        }
        return view('Teacher.exam.create', compact('allclas'));
    }

    public function store(Request $request)
    {

        $this->validate(request(),
            [
//                'rowteacher' => 'required',
                'date1' => 'required',
                'time' => 'required',
                'title' => 'required',
                'countquestions' => 'required',
                'type' => 'required',
            ]
        );
        if ($request->archive) {
            $archive = 1;
        } else {
            $archive = 0;
        }
        if ($request->mark_status) {
            $mark_status = 1;
        } else {
            $mark_status = 0;
        }
        if (!isset($request->rowteacher) and $archive == 0) {
//            alert()->success('کلاس و درس را انتخاب نکردید.', 'عملیات ناموفق')->autoclose(5000);
            return back()->withErrors('کلاس و درس را انتخاب نکردید.');
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
        $exam->random = $request->random;
        $exam->archive = $archive;
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
        if ($archive == 0) {
            foreach ($request->rowteacher as $rowteacher) {
                $dars_id = teacher::where('id', $rowteacher)->pluck('dars')->first();
                $class = teacher::where('id', $rowteacher)->with('class')->get();
                $class_id = $class[0]->class[0]->id;
                $examclass = new ExamClass();
                $examclass->exam_id = $id;
                $examclass->class_id = $class_id;
                $examclass->dars_id = $dars_id;
                $examclass->save();
                if ($request->mark_status == 'on') {
                    $cMark = $this->MarkService->createCMark($dars_id, $class[0]->class[0]->classnamber, $request->title);
                    $cMark->update([
                        'exam_id' => $id
                    ]);
                }
            }
        }


        alert()->success('آزمون با موفقیت ایجاد شد حال سوالات راایجاد کنید', 'عملیات موفق')->autoclose(5000);
        if ($request->type == 0) {
            return redirect('teacher/questions/' . $id);
        } else {
            for ($x = 1; $x <= $request->countquestions; $x++) {
                ExamQuestion::create([
                    'exam_id' => $id,
                    'title' => 'سوال شماره ' . $x,
                ]);
            }
            return redirect('teacher/questions/descriptive/' . $id);

        }
    }

    public function questions($id)
    {
        $exam = Exam::find($id);

        return view('Teacher.exam.createquestions', compact('exam'));
    }

    public function questionsstore(Request $request)
    {

        $this->validate(request(),
            [
//                'question.title' => 'required',
                'option.1' => 'required',
                'option.2' => 'required',
                'option.3' => 'required',
                'option.4' => 'required',
            ]
        );
//        return $request;

#crete questions
        $questions = $this->CvService->Question($request->question);

        $question_id = [];
//        return $questions;
        $imageid = 1;
        foreach ($questions as $question) {
//            return $question;
            $newquestion = new ExamQuestion();
            $newquestion->exam_id = $request->exam_id;
            $newquestion->title = $question['title'];
            $newquestion['created_at'] = strtotime(Carbon::now());
//            return $question['file'];
            if (isset($question['file'])) {

                $file = $question['file'];
                $filename = time() . $imageid . '.' . $file->getClientOriginalExtension();
//                $filename->resize(500, 500);
                $file_resize = Image::make($file->getRealPath());
                $file_resize->save(public_path('images/exam/' . $filename), 100);
                $newquestion['file'] = $filename;

            }
            if (isset($question['image'])) {
                $image = $question['image'];
                $imagefilename = time() . 'image' . $imageid . '.' . $image->getClientOriginalExtension();
//                $imagefilename->resize(500, 500);
                $image_resize = Image::make($image->getRealPath());
                $image_resize->save(public_path('images/exam/' . $imagefilename), 100);
                $newquestion['image'] = $imagefilename;

            }
            $newquestion->save();
            $question_id[] = $newquestion->id;
            $imageid = $imageid + 1;
        }

#end
#crete options
        $options = $this->CvService->Option($request->option);
        $number = 0;
        foreach ($options as $option) {
            $Option = new Option();
            $Option['question_id'] = $question_id[$number];
            $Option['1'] = $option['1'];
            $Option['2'] = $option['2'];
            $Option['3'] = $option['3'];
            $Option['4'] = $option['4'];
            if (!empty($option['correct'])) {
                $Option['correct'] = $option['correct'];
            } else {
                $Option['correct'] = 1;
            }
            $Option['created_at'] = strtotime(Carbon::now());
            $Option->save();

            $number = $number + 1;
        }
//#end

#create images
        if ($request->image) {
            if (count($request->image) == 1) {
                $output = [];
                foreach ($request->image as $key => $a) {
                    foreach ($a as $k => $name) {
                        $output[$k][$key] = $name;
                    }
                }
                if (isset($output[0])) {
                    foreach ($output[0] as $key => $img) {
                        $option_image = new OptionImage();
                        $option_image['question_id'] = $question_id[0];
                        $option_image['option_id'] = $key;
                        $imagefilename = time() . 'imagoptione' . '.' . $img->getClientOriginalExtension();
                        $image_resize = Image::make($img->getRealPath());
                        $image_resize->save(public_path('images/exam/' . $imagefilename), 100);
                        $option_image['image'] = $imagefilename;
                        $option_image['created_at'] = strtotime(Carbon::now());
                        $option_image->save();
                    }
                }
            }
        }
        if ($request->image) {
            $images = $this->CvService->image($request->image);

            foreach ($images as $key => $image) {
                $imageid = 1;
                foreach ($image as $k => $imag) {

                    $option_image = new OptionImage();
                    $option_image['question_id'] = $question_id[$key];
                    $option_image['option_id'] = $k;
                    $imagefilename = time() . 'imagoptione' . $imageid . '.' . $imag->getClientOriginalExtension();
                    $image_resize = Image::make($imag->getRealPath());
                    $image_resize->save(public_path('images/exam/' . $imagefilename), 100);
                    $option_image['image'] = $imagefilename;
                    $option_image['created_at'] = strtotime(Carbon::now());
                    $option_image->save();
                    $imageid = $imageid + 1;
                }
            }
        }
#end
        alert()->success('سوالات با موفقیت ایجاد شدند', 'عملیات موفق');
        return redirect(route('exam.show', $request->exam_id));
    }

    public function delete($id)
    {
        $user = Exam::where('id', $id)->first();
        $questions = ExamQuestion::where('exam_id', $id)->get();
        $answers = ExamAnswer::whereIn('question_id', ExamQuestion::where('exam_id', $id)->pluck('id'))->get();
        foreach ($questions as $question) {
            $question->delete();
        }
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $user->delete();

    }

    public function deletequestion($id)
    {
        $question = ExamQuestion::where('id', $id)->first();
        $question->delete();

    }

    public function edit($id)
    {

        $exam = Exam::where('id', $id)->with('examclass')->with('examclass.darsname')->with('examclass.class')->first();
        $examclass = teacher::where('class_id', $exam->examclass[0]->class->classnamber)->where('dars', $exam->examclass[0]->dars_id)->with('class')->with('darss')->first();
        $selectclass = ExamClass::where('exam_id', $id)->get();
        $ids = [];
        foreach ($selectclass as $class) {
            $classnumber = clas::where('id', $class->class_id)->first()['classnamber'];
            $teacherid = teacher::where('class_id', $classnumber)->where('dars', $class->dars_id)->first()['id'];
            $ids[] = $teacherid;
        }
        $teacherclass = teacher::whereIn('id', $ids)->with('class')->with('darss')->get();
        if (auth()->user()->role == 'مدیر') {
            $allclas = teacher::with('class')->with('darss')->get();
            $allclas = $allclas->whereNotIn('id', $teacherclass->pluck('id'));
        } else {
            $allclas = teacher::whereNotIn('id', $teacherclass->pluck('id'))->where('user_id', auth()->user()->id)->with('class')->with('darss')->get();
        }
        return view('Teacher.exam.edit', compact('exam', 'allclas', 'examclass', 'teacherclass'));

    }

    public function update(Request $request, $id)
    {
        if ($request->archive) {
            $archive = 1;
            $this->validate(request(),
                [
//                    'rowteacher' => 'required',
                    'date1' => 'required',
                    'time' => 'required',
                    'title' => 'required',
                    'countquestions' => 'required',
                ]
            );
        } else {
            $archive = 0;
            $this->validate(request(),
                [
                    'rowteacher' => 'required',
                    'date1' => 'required',
                    'time' => 'required',
                    'title' => 'required',
                    'countquestions' => 'required',
                ]
            );
        }
        if ($request->mark_status) {
            $mark_status = 1;
        } else {
            $mark_status = 0;
        }
        if (!isset($request->rowteacher) and $archive == 0) {
            return back()->withErrors('کلاس و درس را انتخاب نکردید.');
        }
        $exam = Exam::find($id);
        $pmark_status = $exam->mark_status;

        $countQuestion = $exam->countquestions;
        $exam->author = auth()->user()->id;
        $exam->title = $request->title;
        $exam->date_start = $request->date1;
        $exam->expire = $request['date-picker-shamsi-list'];
        $exam->texprie = $request->texpire;
        $exam->start = $request->start;
        $exam->countquestions = $request->countquestions;
        $exam->time = $request->time;
        $exam->type = $request->type;
        $exam->random = $request->random;
        $exam->mark_status = $mark_status;
        if ($request->archive) {
            $exam->archive = $archive;
        }
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
        $exam->updated_at = Jalalian::now();
        $exam->save();
        $pclass = ExamClass::where('exam_id', $exam->id)->get();
        if (count($pclass) > 0) {
            foreach ($pclass as $pclas) {
                $pclas->delete();
            }
        }
        if ($archive == 0) {
            foreach ($request->rowteacher as $rowteacher) {
                $dars_id = teacher::where('id', $rowteacher)->pluck('dars')->first();
                $class = teacher::where('id', $rowteacher)->with('class')->get();
                $class_id = $class[0]->class[0]->id;
                $examclass = new ExamClass();
                $examclass->exam_id = $id;
                $examclass->class_id = $class_id;
                $examclass->dars_id = $dars_id;
                $examclass->save();
                if ($pmark_status == 1 and $mark_status == 0) {
                    $this->MarkService->deleteAllMarks('exam_id', $exam->id);
                }
                if ($pmark_status == 0 and $mark_status == 1) {
                    $cMark = $this->MarkService->createCMark($dars_id, $class[0]->class[0]->classnamber, $request->title);
                    $cMark->update([
                        'exam_id' => $exam->id
                    ]);
                }
            }
            alert()->success('ویرایش با موفقیت انجام شد', 'عملیات موفق');

            if ($request->type == 0) {
                return redirect('teacher/exam');
            } else {
                $newCountQuestions = $request->countquestions - $countQuestion;
                if ($newCountQuestions > 0) {
                    for ($x = $countQuestion; $x <= $request->countquestions; $x++) {
                        ExamQuestion::create([
                            'exam_id' => $exam->id,
                            'title' => 'سوال شماره ' . $x,
                        ]);
                    }
                } elseif ($newCountQuestions < 0) {
                    $newCountQuestions = (-1) * $newCountQuestions;
                    $questions = ExamQuestion::where('exam_id', $exam->id)->orderByDesc('id')->take($newCountQuestions)->get();
                    foreach ($questions as $question) {
                        $question->delete();
                    }

                }
                return redirect('teacher/exam');
            }
        }
        alert()->success('ویرایش با موفقیت انجام شد', 'عملیات موفق');
        return redirect('/teacher/exam/sync/' . $id);

    }

    public function show($id)
    {
        $questions = Exam::where('id', $id)->with('questions')->with('questions.myoptions')->get();
        return view('Teacher.exam.questions_edit', compact('questions'));
    }

    public function questionsupdate(Request $request, $id)
    {

        $question = ExamQuestion::find($id);;
        $question->title = $request->question['title'][0];
        $question->updated_at = Jalalian::now();
        $question->save();

        $row = Option::where('question_id', $id)->first();
        $row->update([
            '1' => $request->option['1'][0],
            '2' => $request->option['2'][0],
            '3' => $request->option['3'][0],
            '4' => $request->option['4'][0],
            'correct' => $request->option['correct'][0],
            'created_at' => strtotime(Carbon::now()),
        ]);
        alert()->success('سوال ویرایش گردید', 'عملیات موفق');
        return back();
    }

    public function student($id, $exam)
    {
        $student = User::where('role', 'دانش آموز')->where('class', $id)->pluck('id');
        $marks = ExamMark::where('exam_id', $exam)->with('user')->get();
        if ($marks == []) {
            alert()->warning('تاکنون هیچ دانش آموزی شرکت نکرده است.', 'ناموفق');
            return redirect('/teacher');
        }
        return view('Teacher.exam.student', compact('marks'));
    }

    public function studentsingle($id, $exam_id)
    {
        $exam = Exam::where('id', $exam_id)->with('examclass')->first();
        if ($exam->type == 0) {
            $exams = ExamQuestion::where('exam_id', $exam_id)
                ->with(['studentanswers' => function ($q) use ($id) {
                    $q->where('user_id', '=', $id);
                }])
                ->with('myoptions')->with('exam')->paginate(1);
            return view('Teacher.exam.single', compact('exams', 'exam'));
        } else {
            $exams = ExamQuestion::where('exam_id', $exam_id)
                ->with(['studentanswers' => function ($q) use ($id) {
                    $q->where('user_id', '=', $id);
                }])
                ->with('exam')->get();
            $user = User::where('id', $id)->first();
            return view('Teacher.exam.descriptiveSingleStudent', compact('exams', 'exam', 'user'));

        }

    }

//    archive
    public function archive()
    {
        if (auth()->user()->role == 'معلم') {

            $rows = Exam::where('archive', 1)->where('author', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return view('Teacher.exam.archive', compact('rows'));
        } else {
            return view('errors.404');
        }
    }

    public function sync($id)
    {
        $allclas = teacher::where('user_id', auth()->user()->id)->with('class')->with('darss')->get();
        $exam = Exam::where('id', $id)->with('examclass')->with('examclass.darsname')->with('examclass.class')->first();

        return view('Teacher.exam.sync', compact('allclas', 'exam'));
    }

    public function syncupdate(Request $request, $id)
    {

        if ($request->archive) {
            $archive = 1;
            $this->validate(request(),
                [
//                'rowteacher' => 'required',
                    'date1' => 'required',
                    'time' => 'required',
                    'title' => 'required',
                ]
            );
        } else {
            $archive = 0;
            $this->validate(request(),
                [
                    'rowteacher' => 'required',
                    'date1' => 'required',
                    'time' => 'required',
                    'title' => 'required',
                ]
            );
        }
        $exam = Exam::where('id', $id)->first();
        $exam->author = auth()->user()->id;
        $exam->title = $request->title;
        $exam->expire = $request->date1;
        $exam->time = $request->time;
        $exam->archive = $archive;
        $exam->created_at = Jalalian::now();
        $exam->save();
        $id = $exam->id;
        if ($archive == 0) {
            foreach ($request->rowteacher as $rowteacher) {
                $dars_id = teacher::where('id', $rowteacher)->pluck('dars')->first();
                $class = teacher::where('id', $rowteacher)->with('class')->get();
                $class_id = $class[0]->class[0]->id;
                $examclass = new ExamClass();
                $examclass->exam_id = $id;
                $examclass->class_id = $class_id;
                $examclass->dars_id = $dars_id;
                $examclass->save();

            }
            alert()->success('ویرایش با موفقیت انجام شد', 'عملیات موفق');

            return redirect('teacher/exam/' . $id . '/edit');
        } else {
            alert()->success('ویرایش با موفقیت انجام شد', 'عملیات موفق');

            return back();
        }
    }

    public function changeStatus(Request $request)
    {
        $karnameh = Exam::find($request->id);
        $karnameh->status = $request->status;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function descriptiveQuestions($id)
    {
        $exam = Exam::where('id', $id)->with('questions')->first();
        return view('Teacher.exam.descriptiveQuestions', compact('exam'));
    }

    public function descriptiveQuestionsUpdate(Request $request)
    {
        $question = ExamQuestion::find($request->id);
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
        $question->description = $request->description;
        $question->mark = $request->mark;

        $question->save();
        alert()->success('عملیات با موفقیت انجام شد', 'موفق');
        return back();
    }

    public function descriptive()
    {
        if (auth()->user()->role == 'مدیر') {
            $exams = Exam::where('type', 1)
                ->orderByDesc('created_at')
                ->where('archive', 0)
                ->with('examclass')
                ->with('examclass.darsname')
                ->with('examclass.class')
                ->orderbyDesc('created_at')
                ->paginate(10);

        } else {
            $exams = Exam::where('author', auth()->user()->id)
                ->where('type', 1)
                ->orderByDesc('created_at')
                ->where('archive', 0)
                ->with('examclass')
                ->with('examclass.darsname')
                ->with('examclass.class')
                ->orderbyDesc('created_at')
                ->paginate(10);

        }

        return view('Teacher.exam.index', compact('exams'));
    }

    public function descriptivesingleUpdate(Request $request, $id)
    {
        $answer = ExamAnswer::where('id', $id)->first();
        $answer->update([
            'mark' => $request->mark
        ]);
        $exam_id = ExamQuestion::where('id', $answer->question_id)->first();
        $allquestions = ExamQuestion::where('exam_id', $exam_id->exam_id)->get();
        $mark = 0;

        foreach ($allquestions as $allquestion) {
            $newmark = ExamAnswer::where('user_id', $answer->user_id)
                ->where('question_id', $allquestion->id)
                ->pluck('mark')
                ->first();
            $mark = $mark + $newmark;
        }
        $exam_mark = ExamMark::where('user_id', $answer->user_id)
            ->where('exam_id', $exam_id->exam_id)
            ->first();
        $exam_mark->update([
            'mark' => $mark
        ]);
        $exam = Exam::where('id', $exam_id->exam_id)->first();
        if ($exam->mark_status == 1) {
            $class = User::where('id', $answer->user_id)->pluck('class')->first();
            $cMark = CMark::where('exam_id', $exam_id->exam_id)->where('classid', $class)->first();
            $row = MarkItem::where('user_id', $answer->user_id)->where('item_id', $cMark->id)->first();
            if ($row == null) {
                $this->MarkService->createMarkStudent($answer->user_id, $cMark->id, $mark);
            } else {
                $this->MarkService->updateMarkStudent($row, $mark);
            }
            $this->MarkService->totalMark($answer->user_id, $cMark->dars, $class);
        }

        alert()->success('عملیات با موفقیت انجام شد', 'موفق');
        return back();
    }

    public function karname($id)
    {
        $exam = Exam::where('id', $id)->first();
        $examMarks = ExamMark::where('exam_id', $exam->id)
            ->orderBy('mark', 'Desc')
            ->get();
        $average = ExamMark::where('exam_id', $exam->id)->where('dars_id', 'کل')->avg('mark');
        $top = ExamMark::where('exam_id', $exam->id)->where('dars_id', 'کل')->max('mark');
        $min = ExamMark::where('exam_id', $exam->id)->where('dars_id', 'کل')->min('mark');
        $doros = dars::whereIn('id', $examMarks->pluck('dars_id'))->get();
        return view('Teacher.exam.karname', compact('exam', 'doros', 'examMarks', 'average', 'top', 'min'));
    }

    public function karnameExport($id)
    {
        $data = ExamMark::where('exam_id', $id)
            ->join('users', 'users.id', '=', 'exam_marks.user_id')
            ->leftJoin('dars', 'dars.id', '=', 'exam_marks.dars_id')
            ->select('users.f_name', 'users.l_name', 'users.class', 'dars.name', 'exam_marks.mark', 'exam_marks.dars_id')
            ->orderBy('dars_id')
            ->get()->toArray();

        return Excel::create('marks', function ($excel) use ($data) {
            $excel->sheet('marks', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xls');

    }


}
