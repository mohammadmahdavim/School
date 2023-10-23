<?php

namespace App\Http\Controllers\admin;

use App\FilmSection;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilmSectionController extends Controller
{
    public function index()
    {
        $sections = FilmSection::where('section_id', 0)->get();
        $bakhshs = FilmSection::whereNotIN('section_id', [0])->get();

        return view('Admin.film.index', compact('sections', 'bakhshs'));
    }


    public function section(Request $request)
    {
        FilmSection::create([
            'section' => $request->section,
        ]);
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق');

        return back();
    }

    public function bakhsh(Request $request)
    {
        $section = FilmSection::where('id', $request->section)->pluck('section')->first();
        FilmSection::create([
            'section' => $section,
            'section_id' => $request->section,
            'bakhsh' => $request->bakhsh,
        ]);
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق');
        return back();
    }

    public function delete($id)
    {
        $row = FilmSection::find($id);
        $parent_id = $row->section_id;
        if ($parent_id == 0) {
            $bakhshs = FilmSection::where('section_id', $id)->get();
            if (isset($bakhshs)) {
                foreach ($bakhshs as $bakhsh) {
                    $bakhsh->delete();
                }
            }
        }
        $row->delete();
    }
}
