<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * مشاهده بلاگ های ایجاد شده
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(){

        $blogs=Blog::orderBydesc('created_at')->get();
        return view('Admin.blog.view',compact('blogs'));
    }

    /*
     * صفحه تکی وبلاگ
     */
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($id){

        $blog=Blog::find($id);
        return view('Admin.blog.single',compact('blog'));
    }

    /*
     * تایید و عدم تایید بلاگ
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $RTamas = Blog::find($request->id);
        $RTamas->status = $request->status;
        $RTamas->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function destroy($id)
    {

//        حذف از جدول   blogs
        $row = Blog::where('id', $id)->first();
        $row->delete();

    }
}
