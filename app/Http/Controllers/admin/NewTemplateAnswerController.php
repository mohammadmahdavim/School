<?php

namespace App\Http\Controllers\admin;

use App\TemplateAnsware;
use App\TemplateAnswareOption;
use App\TemplateSelection;
use App\TemplateSelectionQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewTemplateAnswerController extends Controller
{
    public function template_answer_index()
    {
        $rows = TemplateAnsware::all();
        return view('Admin.new_selection.answer.index', compact('rows'));
    }

    public function template_answer_store(Request $request)
    {
        TemplateAnsware::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back();
    }

    public function template_answer_update(Request $request, $id)
    {
        $row = TemplateAnsware::where('id', $id)->first();
        $row->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return back();
    }

    public function template_answer_delete($id)
    {
        $row = TemplateAnsware::where('id', $id)->first();
        $row->delete();
        return back();
    }

    public function template_answer_option($id)
    {
        $rows = TemplateAnswareOption::where('template_answare_id', $id)->get();
        return view('Admin.new_selection.answer.option', compact('rows','id'));
    }

    public function template_answer_option_store(Request $request)
    {
        TemplateAnswareOption::create([
            'name' => $request->name,
            'mark' => $request->mark,
            'template_answare_id' => $request->template_answare_id,
        ]);

        return back();
    }

    public function template_answer_option_delete($id)
    {
        $row = TemplateAnswareOption::where('id', $id)->first();
        $row->delete();
        return back();
    }


    public function template_selection_index()
    {
        $rows = TemplateSelection::all();
        return view('Admin.new_selection.template.index', compact('rows'));
    }

    public function template_selection_store(Request $request)
    {
        TemplateSelection::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back();
    }

    public function template_selection_update(Request $request, $id)
    {
        $row = TemplateSelection::where('id', $id)->first();
        $row->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return back();
    }

    public function template_selection_delete($id)
    {
        $row = TemplateSelection::where('id', $id)->first();
        $row->delete();
        return back();
    }

    public function template_selection_questions($id)
    {
        $rows = TemplateSelectionQuestion::where('template_selection_id', $id)->get();
        $templateAnswares=TemplateAnsware::all();
        return view('Admin.new_selection.template.questions', compact('rows','id','templateAnswares'));
    }

    public function template_selection_questions_store(Request $request)
    {
        TemplateSelectionQuestion::create([
            'body' => $request->body,
            'sort' => $request->sort,
            'template_selection_id' => $request->template_selection_id,
            'template_answare_id' => $request->template_answare_id,
        ]);

        return back();
    }

    public function template_selection_questions_delete($id)
    {
        $row = TemplateSelectionQuestion::where('id', $id)->first();
        $row->delete();
        return back();
    }
}
