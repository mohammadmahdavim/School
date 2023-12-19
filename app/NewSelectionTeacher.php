<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSelectionTeacher extends Model
{
    protected $guarded = [];

    public function selection()
    {
        return $this->belongsTo(NewSelection::class);
    }
    public function teacher()
    {
        return $this->belongsTo(teacher::class);
    }
}
