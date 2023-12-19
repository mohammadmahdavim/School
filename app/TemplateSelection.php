<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateSelection extends Model
{

    protected $guarded = [];

    public function question()
    {
        return $this->hasMany(TemplateSelectionQuestion::class);
    }
}
