<?php

namespace App\Http\Controllers\admin;

use App\NewSelection;
use App\NewSelectionTeacher;
use App\teacher;
use App\TemplateAnsware;
use App\TemplateSelection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewSelectinoController extends Controller
{
    public function selection_index()
    {
        $rows = NewSelection::with('template')->with('teacher')->orderBy('created_at', 'asc')->get();
        $templates = TemplateSelection::all();
        $teachers = teacher::with('users')
            ->with('darss')
            ->with('class')
            ->get();

        return view('Admin.new_selection.selection.index', compact('rows', 'templates', 'teachers'));
    }

    public function selection_store(Request $request)
    {
        $row = NewSelection::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'required' => isset($request->required) ? 1 : 0,
            'template_selection_id' => $request->template_selection_id,
        ]);
        if (isset($request->class_id)) {

            foreach ($request->class_id as $classId) {
                NewSelectionTeacher::create([
                    'new_selection_id' => $row->id,
                    'teacher_id' => $classId
                ]);
            }
        }
        return back();
    }

    public function selection_update(Request $request, $id)
    {
        $row = NewSelection::where('id', $id)->first();
        $row->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'required' => isset($request->required) ? 1 : 0,
            'template_selection_id' => $request->template_selection_id,
        ]);
        foreach ($row->teacher as $teacher) {
            $teacher->delete();
        }
        if (isset($request->class_id)) {
            foreach ($request->class_id as $classId) {
                NewSelectionTeacher::create([
                    'new_selection_id' => $row->id,
                    'teacher_id' => $classId
                ]);
            }
        }
        return back();
    }

    public function selection_delete($id)
    {
        $row = NewSelection::where('id', $id)->first();
        $row->delete();
        return back();
    }
}
