<?php

namespace App\Http\Controllers\admin;

use App\MoshaverSabt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoshaverSabtController extends Controller
{
    public function index()
    {
        $data = MoshaverSabt::paginate(15);
        return view('Admin.moshaversabt.index', compact('data'));
    }
}
