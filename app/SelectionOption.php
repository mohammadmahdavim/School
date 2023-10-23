<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectionOption extends Model
{
    protected  $table='selection_optionss';
    protected $guarded = [];

    public function selection()
    {
        return $this->belongsTo(Selection::class)->withDefault();
    }

    public function selectionitem()
    {
        return $this->belongsTo(SelectionItem::class)->withDefault();
    }
}
