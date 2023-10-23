<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishExam extends Model
{
  protected $guarded=[];

  public function exam()
  {
      return $this->belongsTo(Exam::class,'id','exam_id')->withDefault();
  }
}
