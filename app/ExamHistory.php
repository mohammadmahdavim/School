<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamHistory extends Model
{
    protected $fillable = [
        'start_at', 'finish_at','user_id','exam_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class)->withDefault();
    }
}
