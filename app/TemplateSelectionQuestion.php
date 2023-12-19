<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateSelectionQuestion extends Model
{
    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(TemplateSelection::class);
    }

    public function template_answer()
    {
        return $this->belongsTo(TemplateAnsware::class);
    }
}
