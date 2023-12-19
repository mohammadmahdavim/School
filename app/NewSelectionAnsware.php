<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSelectionAnsware extends Model
{
    protected $guarded = [];

    public function answer()
    {
        return $this->belongsTo(TemplateSelectionQuestion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function option()
    {
        return $this->belongsTo(TemplateAnswareOption::class);
    }
}
