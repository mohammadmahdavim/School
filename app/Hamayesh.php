<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hamayesh extends Model
{
    protected $guarded = [];

    public function memeber()
    {
        return $this->hasMany(HamayeshMemeber::class);
    }
}
