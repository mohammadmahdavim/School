<?php

namespace App\Http\Controllers\student;

use App\Fine;
use App\Http\Controllers\Controller;
use App\Library;
use App\Reservation;
use App\Trust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class LibraryController extends Controller
{

    /*
     * مشاهده لیست کتاب ها با امکان جستجوی پیشرفته
     */
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $data = Library::
        when($request->get('issue'), function ($query) use ($request) {
            $query->where('issue', $request->issue);
        })
            ->when($request->get('author'), function ($query) use ($request) {
                $query->where('author', 'like', '%' . $request->author . '%');
            })
            ->when($request->get('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->get('publisher'), function ($query) use ($request) {
                $query->where('publisher', 'like', '%' . $request->publisher . '%');
            })
            ->when($request->get('start_date'), function ($query) use ($request) {
                $query->where('created_at', '>=', $request->start_date);
            })
            ->when($request->get('end_date'), function ($query) use ($request) {
                $query->where('created_at', '<=', $request->end_date);
            })
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('student.library.index', compact('data'));

    }


    /*
     * صفحه کتاب های در دست من
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mybook()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }
        $data = DB::table('trusts')->where('active', 1)->where('user_id', $id)
            ->leftJoin('libraries', 'libraries.id', '=', 'trusts.library_id')
            ->leftJoin('users', 'users.id', '=', 'trusts.user_id')
            ->select('libraries.issue', 'libraries.author', 'libraries.name',
                'libraries.publisher', 'trusts.id', 'trusts.library_id', 'trusts.user_id',
                'trusts.created_at', 'trusts.count', 'trusts.expire', 'users.f_name', 'users.l_name')
            ->orderByDesc('trusts.created_at')
            ->paginate(25);

        $date = Jalalian::now();
        return view('student.library.intrust', compact('data', 'date'));
    }


    /*
  *عملیات رزرو کتاب
  */
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reservation(Request $request)
    {

        $this->validate(request(), [
            'user_id' => 'required',
            'library_id' => 'required',
        ]);

        $reserv = Reservation::where('user_id', $request->user_id)->where('library_id', $request->library_id)->where('status', 1)->count();
        if ($reserv > 0) {
            alert()->error(' یک بار برای  رزور کرده اید.', 'عملیات ناموفق')->autoclose(3000);
            return back();
        }
        if (Fine::where('user_id', $request->user_id)->where('status', 'پرداخت نشده')->count() > 0) {
            alert()->error(' شما بدهی حساب نشده دارِید.', 'عملیات ناموفق')->autoclose(3000);
            return back();
        }
        if (Trust::where('user_id', $request->user_id)->where('active', 1)->count() > 12) {
            alert()->error(' شما سه کتاب تحویل نداده دارید.', 'عملیات ناموفق')->autoclose(3000);

            return back();
        }
        Reservation::create([
            'library_id' => request('library_id'),
            'user_id' => request('user_id'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success(' کتاب با موفقیت رزرو گردید.', 'عملیات موفق')->autoclose(3000);

        return back();
    }


    /*
     * کتاب های که دانش آموز رزور کرده است.
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myreserve()
    {
        $id = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $id = auth()->user()->id - 1000;
        }

        $data = Reservation::where('status', 1)->where('user_id', $id)->orderByDesc('created_at')->paginate(25);
        return view('student.library.inreserve', compact('data'));
    }

    public function cancelreserve($id)
    {
        $reserve = Reservation::find($id);
        $reserve->delete();
        return back();
    }

}
