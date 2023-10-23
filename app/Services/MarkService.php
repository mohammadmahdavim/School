<?php
/**
 * Created by PhpStorm.
 * User: mamad
 * Date: 05/06/2020
 * Time: 05:32 PM
 */

namespace App\Services;


use App\clas;
use App\CMark;
use App\dars;
use App\MarkItem;
use App\TotalMark;
use Morilog\Jalali\Jalalian;

class MarkService
{

    public function createCMark($dars, $class, $name)
    {
        $id = auth()->user()->id;
        $paye = clas::where('classnamber', $class)->pluck('paye')->first();
        $namedars = dars::where('id', $dars)->pluck('name')->first();
        $cMark = CMark::create([
            'user_id' => $id,
            'classid' => $class,
            'dars' => $dars,
            'max' => 20,
            'name' => $name,
            'payeclass' => $paye,
            'namedars' => $namedars,
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        return $cMark;
    }

    public function editCMark($dars, $class, $name, $id)
    {
        $paye = clas::where('classnamber', $class)->pluck('paye')->first();
        $namedars = dars::where('id', $dars)->pluck('name')->first();
        $cMark = CMark::find($id);
        $cMark->update([
            'classid' => $class,
            'dars' => $dars,
            'max' => 20,
            'name' => $name,
            'payeclass' => $paye,
            'namedars' => $namedars,
            'updated_at' => Jalalian::now(),
        ]);
    }

    public function createMarkStudent($user, $item, $mark)
    {
        $jDate = Jalalian::now();

        $cMark = CMark::where('id', $item)->first();
        MarkItem::create([
            'user_id' => $user,
            'item_id' => $item,
            'mark' => $mark,
            'coddars' => $cMark->dars,
            'codclass' => $cMark->classid,
            'created_at' => $jDate,
            'updated_at' => $jDate,
        ]);
    }

    public function updateMarkStudent($row, $mark)
    {
        $jDate = Jalalian::now();
        $row->update([
            'mark' => $mark,
            'updated_at' => $jDate,
        ]);
    }

    public function totalMark($user, $dars, $class)
    {
        $jDate = Jalalian::now();

        $total = 0;
        $i = 0;
        $marks = MarkItem::where('user_id', $user)->where('coddars', $dars)->get();
        foreach ($marks as $mark) {
            $total = $total + $mark->mark;
            if (!empty($mark->mark) or $mark->mark == 0) {
                $i = $i + 1;
            }
        }
        if ($i == 0) {
            $i = $i + 1;
        }

        $totalMark = TotalMark::where('user_id', $user)->where('coddars', $dars)->first();
        if ($totalMark == null) {
            TotalMark::create([
                'user_id' => $user,
                'totalmark' => $total / $i,
                'coddars' => $dars,
                'codclass' => $class,
                'created_at' => $jDate,
                'updated_at' => $jDate,
            ]);
        } else {
            $totalMark->update([
                'totalmark' => $total / $i,
                'updated_at' => $jDate,
            ]);
        }
    }

    public function deleteAllMarks($column, $id)
    {
        $cMark = CMark::where($column, $id)->where('user_id', auth()->user()->id)->first();
        if ($cMark) {
            $mark_items = MarkItem::where('item_id', $cMark->id)->get();
            if ($mark_items != '[]') {
                $user = $mark_items[0]->user_id;
                $dars = $mark_items[0]->coddars;
                $class = $mark_items[0]->codclass;
                if ($user) {
                    $this->totalMark($user, $dars, $class);
                }
            }
            foreach ($mark_items as $mark_item) {
                $mark_item->delete();
            }

            $cMark->delete();
        }

    }

}
