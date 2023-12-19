<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateAnsware extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(TemplateAnswareOption::class);
    }
}
