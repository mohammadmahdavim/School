<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamMark extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class)->withDefault();
    }

    public function dars()
    {
        return $this->belongsTo(dars::class)->withDefault([
            'name' => 'Guest Author',
        ]);
    }

}
