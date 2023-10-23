<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkItem extends Model
{
    protected $table = 'mark_items';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function items()
    {
        return $this->belongsTo(CMark::class,'item_id')->withDefault();
    }

}
