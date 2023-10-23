<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectionItem extends Model
{
    protected $guarded=[];


    public function selection()
    {
        return $this->hasMany(Selection::class,'selection_items_id');
    }

    public function option()
    {
        return $this->hasMany(SelectionOption::class);
    }
}
