<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    public $table='selectionss';
    protected $guarded=[];


    public function option()
    {
        return $this->hasMany(SelectionOption::class);
    }

    public function memeber()
    {
        return $this->hasMany(SelectionMember::class);
    }
    public function item()
    {
        return $this->hasMany(SelectionItem::class,'id','selection_items_id');
    }
}
