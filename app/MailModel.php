<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailModel extends Model
{
    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany(MailAnswer::class,'mail_id');
    }
}
