<?php

namespace App\Http\Controllers\admin;

use App\Barnameh;
use App\clas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class BarnamehController extends Controller
{
//start metodes for barname_darsi
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $claases = DB::table('clas')->orderBy('classnamber')->get();

        return view('Admin.barnane.create', compact('claases'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $class = $request->classnamber;
        $classnumber = clas::where('id', $class)->first()['classnamber'];
        $this->validate(request(),
            [

                'file' => 'required',
                'classnamber' => 'required',

            ]
        );

        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);
        $original_filename = $cover->getClientOriginalName();
        $row = Barnameh::where('classnumber', $classnumber)->where('category', 'barnameh')->first();

        if ($row == null) {
            Barnameh::create([
                'mime' => $cover->getClientMimeType(),
                'original_filename' => $cover->getClientOriginalName(),
                'filename' => $filename,
                'class_id' => $class,
                'classnumber' => $classnumber,
                'category' => 'barnameh',

            ]);
        } else {
            $row->update([
                'mime' => $cover->getClientMimeType(),
                'original_filename' => $original_filename,
                'filename' => $filename,
                'class_id' => $class,
                'classnumber' => $classnumber,
                'category' => 'barnameh',
            ]);
        }

        alert()->success('برنامه درسی با موفقیت ارسال گردید', 'ارسال برنامه درسی')->autoclose(10000)->persistent('ok');

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {

        $barnamehs = Barnameh::where('category', 'barnameh')->get();

        return view('Admin.barnane.view', compact('barnamehs'));
    }
//end metodes for barname_darsi

//start metodes for barname_emtehani
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Ecreate()
    {
        $claases = DB::table('clas')->orderBy('classnamber')->get();
        return view('Admin.emtehan.create', compact('claases'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Estore(Request $request)
    {
        $class = $request->classnamber;
        $classnumber = clas::where('id', $class)->first()['classnamber'];
        $this->validate(request(),
            [

                'file' => 'required',
                'classnamber' => 'required',

            ]
        );
        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);
        $original_filename = $cover->getClientOriginalName();
        $row = Barnameh::where('classnumber', $classnumber)->where('category', 'emtehan')->first();


        if ($row == null) {
            Barnameh::create([


                'mime' => $cover->getClientMimeType(),
                'original_filename' => $original_filename,
                'filename' => $filename,
                'class_id' => $class,
                'classnumber' => $classnumber,
                'category' => 'emtehan',
            ]);
        } else {

            $row->update([
                'mime' => $cover->getClientMimeType(),
                'original_filename' => $original_filename,
                'filename' => $filename,
                'class_id' => $class,
                'classnumber' => $classnumber,
                'category' => 'emtehan',

            ]);

        }

        alert()->success('برنامه امتحانی با موفقیت ارسال گردید', 'ارسال برنامه امتحانی')->autoclose(10000)->persistent('ok');

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Eview()
    {
        $barnamehs = Barnameh::where('category', 'emtehan')->get();
        return view('Admin.emtehan.view', compact('barnamehs'));
    }
    //end metodes for barname_emtehani

    public function destroy($id)
    {
        $dars = Barnameh::where('id', $id)->first();
        $dars->delete();
        alert()->success('برنامه  شما با موفقیت حذف شد', 'حذف موفق')->autoclose(2000)->persistent('ok');
        return back();
    }

}
