<?php

namespace App\Http\Controllers\student;

use App\Archive;
use App\Http\Controllers\Controller;
use App\JTamrin;
use App\Tamrin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class JTamrinController extends Controller
{
    /*
     صفحه ارسال جواب تکلیف*
     */
    /**
     * @param $idtamrin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($tamrin_id)
    {
        $class_id = Tamrin::where('id', $tamrin_id)->pluck('class_id')->first();
        return view('student.tamrin.create', compact('tamrin_id', 'class_id'));
    }

    /*
     * ایجاد و ویرایش پاسخ تکلیف از طرف دانش آموز
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idtamrin)
    {
        $jDate = Jalalian::now();
        $id = auth()->user()->id;
        $idt = Tamrin::where('id', $idtamrin)->first()['user_id'];
        $this->validate(request(),
            [
                'daraje' => 'required',
                'file' => 'required',

            ]
        );

        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();
        $jtamrin = JTamrin::where('tamrin_id', $idtamrin)->where('user_id', $id)->first();
        if (empty($jtamrin)) {
            $jtamrin = new JTamrin();
            $jtamrin->tamrin_id = $idtamrin;
            $jtamrin->teacher_id = $idt;
            $jtamrin->user_id = $id;
            $jtamrin->created_at = $jDate;
            $jtamrin->updated_at = $jDate;
            $jtamrin->daraje = $request->daraje;
            $jtamrin->description = $request->description;
            $jtamrin->class_id = $request->class;
            $jtamrin->save();
        } else {
            $jtamrin->update([
                'daraje' => $request->daraje,
                'description' => $request->description,
            ]);
        }
        if ($cover) {
            DB::table('jtamrin_files')->insert([
                'jtamrin_id' => $jtamrin->id,
                'mime' => $mime,
                'original_filename' => $original_filename,
                'filename' => $filename,
            ]);
        }
        $jtamrins = JTamrin::where('user_id', $id)->get();

        alert()->success('تکلیف شما با موفقیت ارسال شد', 'موفق')->autoclose(10000)->persistent('ok');
        return view('student.tamrin.outbox', compact('jtamrins'));

    }


    /*
    * تمرینات دریافتی دانش آموز
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inbox()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $classid = User::where('id', $id)->first()['class'];
        $tamrin[] = Tamrin::where('class_id', $classid)->where('archive', 0)->orderby('created_at', 'desc')->latest()->get();
        $archiveid = Archive::where('user_id', $id)->where('model', 'Tamrin')->pluck('item_id');
        if (count($archiveid) > 0) {
            $tamrin = Tamrin::where('class_id', $classid)->where('archive', 0)->orderby('created_at', 'desc')->latest()->get();
            $archive = Tamrin::whereIn('id', $archiveid)->where('archive', 1)->orderby('created_at', 'desc')->latest()->get();
            $tamrin = [$tamrin, $archive];
        }
        return view('student.tamrin.inbox', compact('tamrin'));
    }

    /*
     * تمرینات ارسال کرده دانش آموز
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outbox()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $jtamrins = JTamrin::where('user_id', $id)->latest()->get();
        return view('student.tamrin.outbox', compact('jtamrins'));
    }

    /*
     * ویرایش تمرین ارسال کرده از طرف دانش آموز
     */
    /**
     * @param $tamrin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($tamrin_id)
    {
        $jtamrin = JTamrin::where('tamrin_id', $tamrin_id)->first();
        $class_id = Tamrin::where('id', $tamrin_id)->pluck('class_id')->first();
        return view('student.tamrin.edit', compact('class_id', 'tamrin_id', 'jtamrin'));
    }

    public function delete($id)
    {
        DB::table('jtamrin_files')->where('id', $id)->delete();
    }
}
