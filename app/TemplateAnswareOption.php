<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateAnswareOption extends Model
{
    protected $guarded = [];

    public function answare()
    {
        return $this->belongsTo(TemplateAnsware::class);
    }
}
