<?php

namespace App\Http\Controllers\admin;

use App\dars;
use App\MessageReseiver;
use App\paye;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class DarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $namepaye = paye::where('id', $id)->first()['name'];
        $dars = dars::orderBy('paye')->where('paye', $namepaye)->orderBy('name')->get();
        $paye = paye::all();

        return view('Admin.dars.show', compact('dars', 'paye'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paye = paye::all();
        return view('Admin.dars.create', compact('paye'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
                'name' => 'required',
                'reshte' => 'required',
            ]
        );
        $dars = dars::create([
            'name' => request('name'),
            'reshte' => request('reshte'),
            'paye' => request('paye'),
            'vahed' => request('vahed'),
        ])->id;

        if ($request->file) {
            $image = $request->file('file');

            $cover = $image;
            $filename = time() . '.' . 'png';
            $path = public_path('/images/' . $filename);
            Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
            $dars = dars::find($dars);
            $dars->update([
                'file' => $filename,
            ]);
        }
        alert()->success('درس شما با موفقیت ایجاد شد', 'ایجاد درس')->autoclose(2000)->persistent('ok');


        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->validate(request(), [
                'name' => 'required',
                'reshte' => 'required',
                'paye' => 'required',
                'vahed' => 'required',
            ]
        );
        $dars = dars::where('id', $id)->first();
        $dars->update([
            'name' => $request->name,
            'vahed' => $request->vahed,
            'reshte' => $request->reshte,
            'paye' => $request->paye,
            'updated_at' => Carbon::now(),
        ]);
        if ($request->file) {
            $image = $request->file('file');

            $cover = $image;
            $filename = time() . '.' . 'png';
            $path = public_path('/images/' . $filename);
            Image::make($cover->getRealPath())->resize(1275, 804)->save($path);
            $dars->update([
                'file' => $filename,
            ]);
        }
        alert()->success('درس شما با موفقیت ویرایش شد', 'ویرایش درس')->autoclose(2000)->persistent('ok');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dars = dars::where('id', $id)->first();
        $dars->delete();
        alert()->success('درس  شما با موفقیت حذف شد', 'حذف درس')->autoclose(2000)->persistent('ok');
        return back();
    }
}
