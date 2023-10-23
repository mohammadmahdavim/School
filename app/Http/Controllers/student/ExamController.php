<?php

namespace App\Http\Controllers\student;

use App\clas;
use App\CMark;
use App\Exam;
use App\ExamAnswer;
use App\ExamClass;
use App\ExamHistory;
use App\ExamMark;
use App\ExamQuestion;
use App\ExamRandom;
use App\MarkItem;
use App\Option;
use App\Services\CvService;
use App\Services\MarkService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;
use App\FinishExam;


class ExamController extends Controller
{

    public $MarkService;

    public function __construct(MarkService $MarkService)
    {
        $this->MarkService = $MarkService;
    }

    public function index()
    {

        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $classid = clas::where('classnamber', User::where('id', $iduser)->pluck('class')->first())->pluck('id')->first();
        $exam_id = ExamClass::where('class_id', $classid)->pluck('exam_id');

        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $classid = clas::where('classnamber', User::where('id', $iduser)->pluck('class')->first())->pluck('id')->first();
        $exam_id = ExamClass::where('class_id', $classid)->pluck('exam_id');

        $exams = Exam::whereIN('id', $exam_id)->where('archive', 0)
            ->with('mymarks')
            ->with(['examclass' => function ($q) use ($classid) {
                $q->where('class_id', $classid)->with('darsname')->with('class');
            }])
            ->whereHas('examclass', function ($q) use ($classid) {
                $q->where('class_id', $classid);
            })
            ->orderbyDesc('created_at')
            ->get();

        return view('student.exam.index', compact('exams', 'iduser'));
    }

    public function takeexam($id)
    {
        $exams = ExamQuestion::where('exam_id', $id)->first();
        if (!$exams) {
            alert()->warning('آزمون هنوز سوالی ندارد.', 'ناموفق');
            return back();
        }
        $jalalinanow = Jalalian::now()->getTimestamp();
        $examestart = explode('/', Exam::where('id', $id)->pluck('date_start')->first());
        $datestart = (new Jalalian($examestart[0], $examestart[1], $examestart[2]))->getTimestamp();
        $tstart = explode(':', Exam::where('id', $id)->pluck('start')->first());
        $starttime = 0;
        $starttime = $starttime + ($tstart[0] * 60 * 60);
        $starttime = $starttime + ($tstart[1] * 60);

        $tstart = ($starttime) + ($datestart);

        if ($jalalinanow < $tstart) {
            alert()->warning('آزمون هنوز شروع نشده است.', 'ناموفق');
            return back();
        }

        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }

        $examtime = Exam::where('id', $id)->pluck('time')->first();
        $now = Carbon::now()->timestamp;
        $finishtime = $now + ($examtime * 60);
        $examhistory = ExamHistory::where('user_id', $iduser)->where('exam_id', $id)->first();
        if (!$examhistory) {
            $examhistory = ExamHistory::create([
                'exam_id' => $id,
                'user_id' => $iduser,
                'start_at' => $now,
                'finish_at' => $finishtime,
            ]);
        }
        $endtime = $examhistory->finish_at - Carbon::now()->timestamp;
        $examexprie = explode('/', Exam::where('id', $id)->pluck('expire')->first());
        $date = (new Jalalian($examexprie[0], $examexprie[1], $examexprie[2]))->getTimestamp();
        $texpire = explode(':', Exam::where('id', $id)->pluck('texprie')->first());
        $expritime = 0;
        $expritime = $expritime + ($texpire[0] * 60 * 60);
        $expritime = $expritime + ($texpire[1] * 60);
        $examexprie = $date + $expritime;
        if ($examexprie < Jalalian::now()->getTimestamp() or $endtime < 0) {
            alert()->warning('زمان آزمون به پایان رسیده است', 'توجه');
            return redirect('/student/exam');
        }

        if ($exams->exam->type == 0) {
            $countquestions = Exam::where('id', $id)->pluck('countquestions')->first();
            if ($exams->exam->random == 1) {
                $random = ExamRandom::where('user_id', $iduser)->where('exam_id', $id)->pluck('question')->first();
                if (!$random) {
                    $random = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->orderBy('dars_id')->inRandomOrder()->limit($countquestions)->pluck('id');
                    ExamRandom::create([
                        'user_id' => $iduser,
                        'exam_id' => $id,
                        'question' => json_encode($random),
                    ]);
                } else {
                    $random = \GuzzleHttp\json_decode($random);
                }
                $fmod = fmod($iduser, 2);
                if ($fmod == 1) {
                    $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->whereIn('id', $random)->orderBy('sort', 'asc')->orderby('id', 'Desc')->paginate(1);
                    if ($exams[0]->exam->type == 1) {
                        $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->whereIn('id', $random)->orderbyDesc('id')->get();
                    }
                } else {
                    $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->whereIn('id', $random)->orderBy('sort', 'asc')->orderBy('id', 'asc')->paginate(1);
                    if ($exams[0]->exam->type == 1) {
                        $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->whereIn('id', $random)->orderBy('id')->get();
                    }
                }
            } else {
                $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->orderby('id','asc')->paginate(1);;
            }
            if (count($exams) > 0) {
                return view('student.exam.take', compact('exams', 'endtime'));
            }
        } else {
            if ($exams) {
                $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->orderby('id')->get();
                return view('student.exam.takeDescriptive', compact('exams', 'endtime'));
            }
        }
        alert()->warning('آزمونی وجود ندارد');
        return back();
    }

    public function tik(Request $request)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $examid = ExamQuestion::where('id', $request->question_id)->pluck('exam_id')->first();
        $examhistory = ExamHistory::where('user_id', $iduser)->where('exam_id', $examid)->first();

        $endtime = $examhistory->finish_at - Carbon::now()->timestamp;
        $exam = ExamQuestion::where('exam_id', $examid)
            ->with('useranswers')
            ->with('myoptions')
            ->with('exam')
            ->paginate(1);

        if ($exam < Jalalian::now()->subDays(10) or $endtime < 0) {
            return 'زمان آزمون به پایان رسیده است.';
        }

        $correct = Option::where('question_id', $request->question_id)->pluck('correct')->first();
        $answer = ExamAnswer::where('question_id', $request->question_id)->where('user_id', $iduser)->first();

        if ($answer) {
            $answer->update([
                'option_id' => $request->option_value,
                'updated_at' => Jalalian::now(),
            ]);
        } else {
            $answer = ExamAnswer::create([
                'option_id' => $request->option_value,
                'correct' => $correct,
                'question_id' => $request->question_id,
                'user_id' => $iduser,
                'created_at' => Jalalian::now(),
            ]);
        }
        $generalExam = Exam::where('id', $examid)->pluck('general')->first();
        $countquestions = Exam::where('id', $examid)->pluck('countquestions')->first();
        $questions = ExamQuestion::where('exam_id', $examid)->pluck('id');
        $answers = ExamAnswer::where('user_id', $iduser)->whereIn('question_id', $questions)->get();
        $correctcount = 0;
        foreach ($answers as $answer) {
            if ($answer->option_id == $answer->correct) {
                $correctcount = $correctcount + 1;
            }
        }
        if ($correctcount == 0) {
            $mark = 0;
        } else {
            $mark = ($correctcount / $countquestions) * 20;
        }
        if ($generalExam == 1) {
            $darsid = ExamQuestion::where('id', $request->question_id)->pluck('dars_id')->first();

            $examMarkDars = ExamMark::where('exam_id', $examid)
                ->where('dars_id', $darsid)
                ->where('user_id', $iduser)
                ->first();
            if ($examMarkDars) {
                $examMarkDars->update([
                    'mark' => $mark,
                    'updated_at' => Jalalian::now(),
                ]);
            } else {
                ExamMark::create([
                    'mark' => $mark,
                    'exam_id' => $examid,
                    'dars_id' => $darsid,
                    'user_id' => $iduser,
                    'created_at' => Jalalian::now(),
                ]);
            }
        }

        $exammark = ExamMark::where('exam_id', $examid)->where('user_id', $iduser)->first();
        if ($exammark) {
            $exammark->update([
                'mark' => $mark,
                'updated_at' => Jalalian::now(),
            ]);
        } else {
            ExamMark::create([
                'mark' => $mark,
                'exam_id' => $examid,
                'user_id' => $iduser,
                'created_at' => Jalalian::now(),
            ]);
        }
        $exam = Exam::where('id', $examid)->first();
        if ($exam->mark_status == 1) {
            $class = User::where('id', $iduser)->pluck('class')->first();
            $cMark = CMark::where('exam_id', $examid)->where('classid', $class)->first();
            $row = MarkItem::where('user_id', $iduser)->where('item_id', $cMark->id)->first();
            if ($row == null) {
                $this->MarkService->createMarkStudent($iduser, $cMark->id, $mark);
            } else {
                $this->MarkService->updateMarkStudent($row, $mark);
            }
            $this->MarkService->totalMark($iduser, $cMark->dars, $class);
        }
        return 'پاسخ شما با موفقیت ثبت شد.';
    }

    public function view($id)
    {
        $exam = Exam::where('id', $id)->first();
        if ($exam->status == 0) {
            return back();
        }
        $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('myoptions')->with('exam')->paginate(1);

        if (ExamQuestion::where('exam_id', $id)->with('useranswers')->get() == '[]') {
            alert()->warning('آزمونی وجود ندارد');
            return back();
        }
        if ($exam->type == 0) {
            return view('student.exam.view', compact('exams'));

        } else {
            $exams = ExamQuestion::where('exam_id', $id)->with('useranswers')->with('exam')->get();

            return view('student.exam.viewDescriptive', compact('exams'));
        }
    }

    public function finish($id)
    {
        $exam = Exam::where('id', $id)->first();
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        FinishExam::create([
            'exam_id' => $exam->id,
            'user_id' => $iduser,
        ]);
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $classid = clas::where('classnamber', User::where('id', $iduser)->pluck('class')->first())->pluck('id')->first();
        $exam_id = ExamClass::where('class_id', $classid)->pluck('exam_id');

        $exams = Exam::whereIN('id', $exam_id)->where('archive', 0)->with('mymarks')->with('examclass')->with('examclass.darsname')->with('examclass.class')->get();

        return view('student.exam.index', compact('exams', 'iduser'));
    }

    public function answerDescriptive(Request $request)
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $examid = ExamQuestion::where('id', $request->question_id)->pluck('exam_id')->first();
        $examhistory = ExamHistory::where('user_id', $iduser)->where('exam_id', $examid)->first();
        $endtime = $examhistory->finish_at - Carbon::now()->timestamp;
        $exam = ExamQuestion::where('exam_id', $examid)->with('useranswers')->with('myoptions')->with('exam')->paginate(1);

        if ($exam < Jalalian::now()->subDays(10) or $endtime < 0) {
            alert()->success('زمان آزمون به پایان رسیده است.', 'نا موفق');
            return redirect('/student/exam');
        }

        $answer = ExamAnswer::where('question_id', $request->question_id)->where('user_id', $iduser)->first();
        if (!$answer) {
            $answer = new ExamAnswer();
            $answer->question_id = $request->question_id;
            $answer->user_id = $iduser;
            $answer->created_at = Jalalian::now();

        }
        $cover = $request->file('file');
        if (!empty($cover)) {
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            $path = public_path('/images/exam');
            $cover->move($path, $filename);
            $mime = $cover->getClientMimeType();
            $original_filename = $cover->getClientOriginalName();
            $answer->filename = $filename;
            $answer->mime = $mime;
            $answer->original_filename = $original_filename;
        }
        $answer->description = $request->description;
        $answer->updated_at = Jalalian::now();
        $answer->save();
        $exammark = ExamMark::where('exam_id', $examid)->where('user_id', $iduser)->first();
        if (!$exammark) {
            ExamMark::create([
                'mark' => 0,
                'exam_id' => $examid,
                'user_id' => $iduser,
                'created_at' => Jalalian::now(),
            ]);
        }
        alert()->success('عملیات با موفقیت انجام شد', 'موفق');
        return back();

    }

}
