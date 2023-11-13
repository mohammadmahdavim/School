<?php

namespace App\Http\Controllers\teacher;


use App\Archive;
use App\clas;
use App\CMark;
use App\dars;
use App\Exam;
use App\Http\Controllers\Controller;
use App\JTamrin;
use App\MarkItem;
use App\MessageReseiver;
use App\Services\MarkService;
use App\Tamrin;
use App\teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class TamrinController extends Controller
{
    public $MarkService;

    /**
     * ImageController constructor.
     */
    public function __construct(MarkService $MarkService)
    {
        $this->MarkService = $MarkService;

        $this->middleware('auth');
    }


    public function upload()
    {
        if (auth()->user()->role == 'معلم') {
            $allclas = teacher::where('user_id', auth()->user()->id)->with('darss')->with('class')->get();
            $allclasst = $allclas;
            $teacclass = teacher::where('user_id', auth()->user()->id)->pluck('class_id');
            $allstudents = User::where('role', 'دانش آموز')->whereIn('class', $teacclass)->orderBy('class')->get();

            return view('Teacher.tamrin.upload', compact('allclas', 'allstudents', 'allclasst'));
        } else {
            return view('errors.404');
        }
    }


    public function store(Request $request)
    {
        if (auth()->user()->role == 'معلم') {

            $this->validate(request(),
                [
                    'rowteacher' => 'required',
//                    'file' => 'mime:jpeg,pdf,png,docx',
                    'file' => 'mimes:jpg,bmp,png,docx',
                    'date1' => 'required',
                    'description' => 'required',
                    'title' => 'required',
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
            $cover = $request->file('file');
            if (!empty($cover)) {

                $filename = time() + 1 . '.' . $cover->getClientOriginalExtension();
                $path = public_path('/images');
                $cover->move($path, $filename);
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();
            }
            $cover2 = $request->file('file2');
            if (!empty($cover2)) {
                $filename2 = time() . '.' . $cover2->getClientOriginalExtension();
                $path2 = public_path('/images');
                $cover2->move($path2, $filename2);
                $pmime = $cover2->getClientMimeType();
                $poriginal_filename = $cover2->getClientOriginalName();

            }
            $rowteacher = teacher::where('id', $request->rowteacher)->first();
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            $jDate = Jalalian::now();
            $tamrin = new Tamrin();
            $tamrin->user_id = auth()->user()->id;
            $tamrin->description = $request->description;
            $tamrin->title = $request->title;
            $tamrin->mark_status = $mark_status;
            $tamrin->expire = $request->date1;
            $tamrin->time = $request->time;
            $tamrin->mark = $request->mark;
            if ($archive == 0) {
                $tamrin->class_id = $rowteacher->class_id;
                $tamrin->dars = $rowteacher->dars;
            }
            if (!empty($cover)) {
                $tamrin->original_filename = $original_filename;
                $tamrin->filename = $filename;
                $tamrin->mime = $mime;
            }
            if (!empty($cover2)) {
                $tamrin->pmime = $pmime;
                $tamrin->poriginal_filename = $poriginal_filename;
                $tamrin->pfilename = $filename2;
            }
            $tamrin->created_at = $jDate;
            $tamrin->updated_at = $jDate;
            $tamrin->archive = $archive;
            $tamrin->save();
            if ($archive == 0) {
                if ($request->mark_status == 'on') {
                    $cMark = $this->MarkService->createCMark($rowteacher->dars, $rowteacher->class_id, $request->title);
                    $cMark->update([
                        'tamrin_id' => $tamrin->id
                    ]);
                }
            }

            alert()->success('تکلیف شما با موفقیت ارسال شد', 'بارگذاری تکلیف')->autoclose(10000)->persistent('ok');

            return back();
        } else {
            return view('errors.404');
        }
    }


    public function inbox($idc, $id)
    {
        $exite = teacher::where('user_id', auth()->user()->id)->where('class_id', $idc)
            ->first();

        if (auth()->user()->role == 'معلم' and $exite) {
            $tamrinids = Tamrin::where('dars', $id)->where('class_id', $idc)->pluck('id');
            $idt = auth()->user()->id;
            $jtamrins = JTamrin::wherein('tamrin_id', $tamrinids)->where('teacher_id', $idt)->orderBy('created_at','desc')
                ->paginate(20);


            return view('Teacher.tamrin.inbox', compact('jtamrins', 'idc', 'id'));
        } else {
            return view('errors.404');
        }
    }


    public function outbox($idc, $idd)
    {
//return $id;
        $exite = teacher::where('user_id', auth()->user()->id)
            ->where('class_id', $idc)
            ->first();

        if (auth()->user()->role == 'معلم' and $exite) {

            $useridT = auth()->user()->id;
            $idclas = $idc;
            $id = $idd;
            $tamrin = Tamrin::where('dars', $idd)->where('archive', 0)->where('class_id', $idc)->where('user_id', $useridT)->orderBy('created_at', 'desc')->get();


            return view('Teacher.tamrin.outbox', compact('tamrin', 'id', 'idclas'));
        } else {
            return view('errors.404');
        }
    }

    public function jtamrin($id)
    {
        if (auth()->user()->role == 'معلم') {

            $jtamrins = JTamrin::where('tamrin_id', $id)->orderBy('created_at', 'desc')->paginate(10);
            if (count($jtamrins) > 0) {
                $idc = $jtamrins[0]->class_id;

            } else {
                $idc = 0;
            }
            return view('Teacher.tamrin.inbox', compact('jtamrins', 'id', 'idc'));
        } else {
            return view('errors.404');
        }
    }


    public function show($id)
    {
        if (auth()->user()->role == 'معلم') {
            $tamrin = Tamrin::where('id', $id)->first();
            return view('Teacher.tamrin.show', compact('tamrin', 'id'));
        } else {
            return view('errors.404');
        }
    }


    public function edite($id)
    {

        if (auth()->user()->role == 'معلم') {


            $tamrin = Tamrin::where('id', $id)->first();
            $allclas = teacher::where('user_id', auth()->user()->id)->with('darss')->with('class')->get();
            return view('Teacher.tamrin.edite', compact('allclas', 'tamrin'));
        } else {
            return view('errors.404');
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role == 'معلم') {
            $rowteacher = teacher::where('id', $request->rowteacher)->first();
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            $jDate = Jalalian::now();
            $this->validate(request(),
                [
                    'title' => 'required',
                    'paye' => 'mimes:jpeg,pdf,png,docx',
                    'date1' => 'required',
                    'description' => 'required',
                    'title' => 'required',
                ]
            );
            if ($request->archive) {
                $archive = 1;
            } else {
                $archive = 0;
            }
            $cover = $request->file('file');
            if (!empty($cover)) {

                $cover = $request->file('file');
                $filename = time() . '.' . $cover->getClientOriginalExtension();
                $path = public_path('/images');
                $cover->move($path, $filename);
                $mime = $cover->getClientMimeType();
                $original_filename = $cover->getClientOriginalName();
            }
            $tamrin = Tamrin::where('id', $id)->first();
            $pmark_status = $tamrin->mark_status;
            if ($request->mark_status) {
                $mark_status = 1;
            } else {
                $mark_status = 0;
            }

            if ($archive == 0) {
                if (!empty($cover)) {

                    $tamrin->update([
                        'description' => $request->description,
                        'title' => $request->title,
                        'mark_status' => $mark_status,
                        'expire' => $request->date1,
                        'class_id' => $rowteacher->class_id,
                        'dars' => $rowteacher->dars,
                        'updated_at' => $jDate,
                        'mime' => $cover->getClientMimeType(),
                        'original_filename' => $original_filename,
                        'filename' => $filename,
                        'archive' => $archive,

                    ]);
                } else {
                    $tamrin->update([
                        'description' => $request->description,
                        'title' => $request->title,
                        'mark_status' => $mark_status,
                        'expire' => $request->date1,
                        'time' => $request->time,
                        'mark' => $request->mark,
                        'class_id' => $rowteacher->class_id,
                        'dars' => $rowteacher->dars,
                        'updated_at' => $jDate,
                        'archive' => $archive,

                    ]);
                }
            } else {
                if (!empty($cover)) {

                    $tamrin->update([
                        'description' => $request->description,
                        'title' => $request->title,
                        'expire' => $request->date1,
                        'updated_at' => $jDate,
                        'mime' => $cover->getClientMimeType(),
                        'original_filename' => $original_filename,
                        'filename' => $filename,
                        'archive' => $archive,
                        'mark_status' => $mark_status,
                        'time' => $request->time,
                        'mark' => $request->mark,
                    ]);
                } else {
                    $tamrin->update([
                        'description' => $request->description,
                        'title' => $request->title,
                        'mark_status' => $mark_status,
                        'expire' => $request->date1,
                        'class_id' => $rowteacher->class_id,
                        'dars' => $rowteacher->dars,
                        'updated_at' => $jDate,
                        'time' => $request->time,
                        'mark' => $request->mark,
                        'archive' => $archive,
                    ]);
                }

            }
            if ($pmark_status == 1 and $mark_status == 0) {
                $this->MarkService->deleteAllMarks('tamrin_id', $tamrin->id);
            }
            if ($pmark_status == 0 and $mark_status == 1) {
                $cMark = $this->MarkService->createCMark($rowteacher->dars, $rowteacher->class_id, $request->title);
                $cMark->update([
                    'tamrin_id' => $tamrin->id
                ]);
            }

            alert()->success('تکلیف شما با موفقیت ویرایش شد', ' ویرایش تکلیف')->autoclose(10000)->persistent('ok');

            return back();
        } else {
            return view('errors.404');
        }
    }

    public function Delete($id)
    {
        if (auth()->user()->role == 'معلم') {

            $tamrin = Tamrin::where('id', $id)->first();
            $teacher = teacher::where('user_id', auth()->user()->id)->first();
            if ($teacher->dars = $tamrin->dars) {
                $this->MarkService->deleteAllMarks('tamrin_id', $tamrin->id);
                $tamrin->delete();
                alert()->success('تکلیف شما با موفقیت حذف شد', 'حذف تکلیف')->autoclose(2000)->persistent('ok');
            }
            return back();
        } else {
            return view('errors.404');
        }
    }

    public function changeStatus(Request $request)
    {
        $tamrin = Tamrin::find($request->id);
        $tamrin->status = $request->status;
        $tamrin->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

//    archive
    public function archive()
    {
        if (auth()->user()->role == 'معلم') {

            $rows = Tamrin::where('archive', 1)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return view('Teacher.tamrin.archive', compact('rows'));
        } else {
            return view('errors.404');
        }
    }

    public function sync($id)
    {
        $allclass = teacher::where('user_id', auth()->user()->id)->with('class')->get();
        $teacclass = teacher::where('user_id', auth()->user()->id)->pluck('class_id');
        $allstudents = User::where('role', 'دانش آموز')->whereIn('class', $teacclass)->orderBy('class')->get();
        $syncs = Archive::where('model', 'Tamrin')->where('item_id', $id)->get();
        $item = Tamrin::where('id', $id)->first();
        return view('Teacher.tamrin.sync', compact('allclass', 'allstudents', 'syncs', 'item'));
    }

    public function mark(Request $request)
    {

        $this->validate(request(), [
                'mark' => 'required',
            ]
        );
        $jtamrin = JTamrin::where('id', $request->id)->first();
        $jtamrin->update([
            'mark' => $request->mark,
            'updated_at' => Jalalian::now()
        ]);
        $tamrin = Tamrin::where('id', $jtamrin->tamrin_id)->first();
        if ($tamrin->mark_status == 1) {
            $class = User::where('id', $jtamrin->user_id)->pluck('class')->first();
            $cMark = CMark::where('tamrin_id', $tamrin->id)->where('classid', $class)->first();
            $row = MarkItem::where('user_id', $jtamrin->user_id)->where('item_id', $cMark->id)->first();
            if ($row == null) {
                $this->MarkService->createMarkStudent($jtamrin->user_id, $cMark->id, $request->mark);
            } else {
                $this->MarkService->updateMarkStudent($row, $request->mark);
            }
            $this->MarkService->totalMark($jtamrin->user_id, $cMark->dars, $class);
        }
        alert()->success('نمره دهی انجام شد', 'عملیت موفق');
        return back();
    }
}
