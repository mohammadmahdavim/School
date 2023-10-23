<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeImage extends Model
{
    protected $fillable = [
      'matlab_id',  'user_id', 'mime', 'body','original_filename','resize_image','filename',
    ];
}
