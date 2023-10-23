<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
       'id', 'user_id', 'title', 'body','little_body','place','created_at','updated_at','file'
    ];}
