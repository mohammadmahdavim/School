<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mark extends Model
{
   protected $guarded=[];


   public function users(){
       return $this->belongsTo(User::class)->withDefault();
   }


}
