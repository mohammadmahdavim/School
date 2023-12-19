<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSelection extends Model
{
    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(TemplateSelection::class,'template_selection_id')->withDefault();
    }
    public function teacher()
    {
        return $this->hasMany(NewSelectionTeacher::class);
    }
}
