<?php

namespace App\Http\Controllers;

use App\HomeWebModel;
use App\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class UserController extends Controller
{
    public function home()
    {
//        $rows=HomeWebModel::where('makan',$id)->paginate(12);
        $sliders = HomeWebModel::where('makan', 'اسلایدر')->get();
        $bartars = HomeWebModel::where('makan', 'برترها')->get();
        $akhbar = HomeWebModel::where('makan', 'اطلاعیه')->orderby('time', 'desc')->paginate(4);
        $roydads = HomeWebModel::where('makan', 'رویداد')->orderby('created_at')->paginate(3);
        $images = HomeWebModel::where('makan', 'گالری عکس')->orderby('time', 'desc')->get();
        $kadrs = HomeWebModel::where('makan', 'کادر مدرسه')->orderby('time', 'desc')->get();
        $imageone = HomeWebModel::where('makan', 'گالری عکس')->orderby('time', 'desc')->first();
        $rimageone = HomeWebModel::where('makan', 'رویداد')->orderby('time', 'desc')->first();
        $payams = HomeWebModel::where('makan', 'پیام های مشاوره ای')->orderby('time', 'desc')->paginate(3);
        $eftekharat = HomeWebModel::where('makan', 'افتخارات')->orderBy('time', 'desc')->paginate(4);
        $services = HomeWebModel::where('makan', 'خدمات')->orderby('time', 'desc')->get();
//return $imageone;
        $date = Jalalian::forge('today')->format('%A, %d %B %y');;
//        return $date;

        return view('home.index', compact('sliders', 'date', 'bartars', 'akhbar','rimageone', 'roydads', 'images', 'imageone', 'payams', 'eftekharat', 'services', 'kadrs'));
    }


    public function singlepage($id)
    {
        $rows = HomeWebModel::where('id', $id)->first();
        $makan=$rows->makan;
        $others = HomeWebModel::where('makan', $makan)->orderby('created_at')->take(3)->get();
        $images = MultiImage::where('matlab_id', $rows->id)->get();
        $countimages = MultiImage::where('matlab_id', $rows->id)->count();
        if ($countimages > 1) {
            return view('home.single2', compact('rows', 'images'));

        } else {
            return view('home.single', compact('rows', 'images','others'));

        }
    }

    public function other($id)
    {
        $rows = HomeWebModel::where('makan', $id)->orderBy('time', 'desc')->paginate(8);
        return view('home.other', compact('rows', 'id'));
    }

    public function game2048(){
        return view('home.2048');

    }
}
