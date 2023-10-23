<?php

namespace App\Http\Controllers\admin;

use App\Fine;
use App\Http\Controllers\Controller;
use App\Library;
use App\Reservation;
use App\Trust;
use App\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        $students = User::where('role', 'دانش آموز')->get();

        return view('Admin.library.index', compact('data', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.library.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
                'issue'=>['required','unique:libraries' ],
            ]
        );
        Library::create([
            'name' => request('name'),
            'issue' => request('issue'),
            'author' => request('author'),
            'count' => request('count'),
            'publisher' => request('publisher'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success(' کتاب با موفقیت اضافه گردید.', 'عملیات موفق')->autoclose(3000);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $library = Library::where('id', $id)->first();
        return view('Admin.library.edit', compact('library'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $row = Library::find($id);

        $row->update([
            'name' => request('name'),
            'issue' => request('issue'),
            'author' => request('author'),
            'count' => request('count'),
            'publisher' => request('publisher'),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success(' کتاب با موفقیت ویرایش گردید.', 'عملیات موفق')->autoclose(3000);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trusts = Trust::where('library_id', $id)->get();
        foreach ($trusts as $trust) {
            $trust->delete();

        }
        $row = Library::find($id);
        $row->delete();
        return back();
    }

    public function trust($id)
    {
        $row = Library::find($id);
        $students = User::where('role', 'دانش آموز')->get();

        return view('Admin.library.trust', compact('row', 'students'));
    }

    public function truststore(Request $request)
    {

        $this->validate(request(), [
            'user_id' => 'required',
            'library_id' => 'required',
        ]);
        if (Fine::where('user_id', $request->user_id)->where('status', 'پرداخت نشده')->count() > 0) {
            alert()->error(' شخص مورد نظر بدهی حساب نشده دارد.', 'عملیات ناموفق')->autoclose(3000);
            return back();
        }
        if (Trust::where('user_id', $request->user_id)->where('active', 1)->count() > 2) {
            alert()->error(' شخص مورد نظر سه کتاب تحویل نداده دارد.', 'عملیات ناموفق')->autoclose(3000);

            return back();
        }
        $library = Library::where('id', $request->library_id)->first();
        if ($library->count == 0) {
            alert()->error(' موجودی کتاب به پایان رسیده است.', 'عملیات ناموفق')->autoclose(3000);

            return back();
        }

        $library->update([
            'count' => $library->count - 1,
            'updated_at' => Jalalian::now(),
        ]);

        $reserv = Reservation::where('user_id', $request->user_id)->where('library_id', $request->library_id)->where('status', 1)->first();
        if ($reserv) {

            $reserv->update([
                'status' => 0,
                'updated_at' => Jalalian::now(),
            ]);
        }
        $trust=Trust::create([
            'library_id' => request('library_id'),
            'user_id' => request('user_id'),
            'expire' => Jalalian::now()->addDays(14),
            'created_at' => Jalalian::now(),
            'updated_at' => Jalalian::now(),
        ]);

        alert()->success(' کتاب با موفقیت به امانت داده شد.', 'عملیات موفق')->autoclose(3000);

        return back();
    }

    public function back($id)
    {

        $row = Trust::find($id);
        $row->update([
            'active' => 0
        ]);
        return back();
    }


    public function tamdid($id)
    {

        $trust = Trust::where('id', $id)->first();

        $date = explode('-', $trust->expire);
        $toGregorian = CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
        $gregorian = implode('-', $toGregorian) . ' ' . '23:59:59';
        $dateEx = Jalalian::forge("$gregorian")->getTimestamp();
        $time = $dateEx - time(); // to get the time since that moment
        $day = floor($time / 86400) + 14;
        $trust->update([
            'expire' => Jalalian::now()->addDays($day),
            'count' => 1

        ]);


        return back();
    }

    public function reservation($id)
    {
        $row = Library::find($id);
        $students = User::where('role', 'دانش آموز')->get();

        return view('Admin.library.reservation', compact('row', 'students'));
    }

    public function reservationstore(Request $request)
    {
//        return $request;
        $this->validate(request(), [
            'user_id' => 'required',
            'library_id' => 'required',
        ]);
        $reserv = Reservation::where('user_id', $request->user_id)->where('library_id', $request->library_id)->where('status', 1)->count();
        if ($reserv > 0) {
            alert()->error(' یک بار برای این شخص رزور کرده اید.', 'عملیات ناموفق')->autoclose(3000);
            return back();
        }
        if (Fine::where('user_id', $request->user_id)->where('status', 'پرداخت نشده')->count() > 0) {
            alert()->error(' شخص مورد نظر بدهی حساب نشده دارد.', 'عملیات ناموفق')->autoclose(3000);
            return back();
        }
        if (Trust::where('user_id', $request->user_id)->where('active', 1)->count() > 12) {
            alert()->error(' شخص مورد نظر سه کتاب تحویل نداده دارد.', 'عملیات ناموفق')->autoclose(3000);

            return back();
        }
        $library = Library::where('id', $request->library_id)->first();
        if ($library->count != 0) {
            alert()->error('کتاب موجود است و نیاز به روزر نیست. باید امانت بدهید.', 'عملیات ناموفق')->autoclose(5000);

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

    public function intrust(Request $request)
    {

        $data = DB::table('trusts')->where('active', 1)
            ->leftJoin('libraries', 'libraries.id', '=', 'trusts.library_id')
            ->leftJoin('users', 'users.id', '=', 'trusts.user_id')
            ->select('libraries.issue', 'libraries.author', 'libraries.name',
                'libraries.publisher', 'trusts.id', 'trusts.library_id', 'trusts.user_id',
                'trusts.created_at', 'trusts.count', 'trusts.expire', 'users.f_name', 'users.l_name')
            ->when($request->get('issue'), function ($query) use ($request) {
                $query->where('libraries.issue', $request->issue);
            })
            ->when($request->get('name'), function ($query) use ($request) {
                $query->where('libraries.name', $request->name);
            })
            ->when($request->get('tamdid'), function ($query) use ($request) {

                if ($request->tamdid == 1) {
                    $query->where('trusts.count', 1);
                } elseif($request->tamdid == 2) {
                    $query->where('trusts.count', 0);
                }
            })
            ->when($request->get('user'), function ($query) use ($request) {
                $query->where('users.f_name', 'like', '%' . $request->user . '%')->
                orwhere('users.l_name', 'like', '%' . $request->user . '%');
            })
            ->when($request->get('start_date'), function ($query) use ($request) {
                $query->where('trusts.created_at', '>=', $request->start_date);
            })
            ->when($request->get('end_date'), function ($query) use ($request) {
                $query->where('trusts.created_at', '<=', $request->end_date);
            })
            ->orderByDesc('trusts.created_at')
            ->paginate(25);


        $date = Jalalian::now();
        return view('Admin.library.intrust', compact('data', 'date'));

    }

    public function inreserve()
    {
        $data = Reservation::where('status', 1)->orderByDesc('created_at')->paginate(25);
        return view('Admin.library.inreserve', compact('data'));
    }

    public function cancelreserve($id)
    {
        $reserve = Reservation::find($id);
        $reserve->delete();
        return back();
    }

    public function history(Request $request)
    {
        $data = DB::table('trusts')->whereIn('active', [1, 0])
            ->leftJoin('libraries', 'libraries.id', '=', 'trusts.library_id')
            ->leftJoin('users', 'users.id', '=', 'trusts.user_id')
            ->select('libraries.issue', 'libraries.author', 'libraries.name',
                'libraries.publisher', 'trusts.id', 'trusts.library_id', 'trusts.user_id',
                'trusts.created_at','trusts.back', 'trusts.count', 'trusts.expire', 'users.f_name', 'users.l_name')
            ->when($request->get('issue'), function ($query) use ($request) {
                $query->where('libraries.issue', $request->issue);
            })
            ->when($request->get('name'), function ($query) use ($request) {
                $query->where('libraries.name', $request->name);
            })
            ->when($request->get('tamdid'), function ($query) use ($request) {

                if ($request->tamdid == 1) {
                    $query->where('trusts.count', 1);
                } elseif($request->tamdid == 2) {
                    $query->where('trusts.count', 0);
                }
            })
            ->when($request->get('user'), function ($query) use ($request) {
                $query->where('users.f_name', 'like', '%' . $request->user . '%')->
                orwhere('users.l_name', 'like', '%' . $request->user . '%');
            })
            ->when($request->get('start_date'), function ($query) use ($request) {
                $query->where('trusts.created_at', '>=', $request->start_date);
            })
            ->when($request->get('end_date'), function ($query) use ($request) {
                $query->where('trusts.created_at', '<=', $request->end_date);
            })

            ->orderByDesc('created_at')->paginate(25);
        return view('Admin.library.history', compact('data'));
    }

    public function fine(Request $request)
    {
        $id = Fine::where('library_id', $request->library_id)
            ->where('user_id', $request->user_id)
            ->where('day', $request->day)
            ->pluck('id')->first();

        if (!$id) {
            $id = Fine::create([
                'library_id' => request('library_id'),
                'user_id' => request('user_id'),
                'day' => request('day'),
                'created_at' => Jalalian::now(),
                'updated_at' => Jalalian::now(),
            ])->id;
        }

        return redirect()->route('fines.show', $id);

    }

    public function fineshow($id)
    {
        $fine = Fine::find($id);
//        جریمه های قبلی این یوز برای همین کتاب
        $otherfine = Fine::where('library_id', $fine->library_id)
            ->where('user_id', $fine->user_id)
            ->whereNotIn('id', [$fine->id])
            ->get();
        return view('Admin.library.fine', compact('fine', 'otherfine'));

    }

    public function finechangestatus(Request $request)
    {
        $id = $request->id;
        $fine = Fine::find($id);
        $fine->update([
            'status' => request('status'),
        ]);
        alert()->success('تغییر وضعیت با موفقیت انجام شد', 'موفق');
        return redirect()->route('fines.show', $id);

    }

    public function importExport()
    {

        return view('Admin.library.excle');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        $exist = [];
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();

        if ($data->count()) {
            foreach ($data as $key => $value) {
                $allstudent = Library::where('issue', $value->issue)->first();
                if ($allstudent == null) {
                    $arr[] = [
                        'issue' => $value->issue,
                        'name' => $value->name,
                        'count' => $value->count,
                        'author' => $value->author,
                        'publisher' => $value->publisher,
                        'updated_at' => Jalalian::now(),
                        'created_at' => Jalalian::now(),
                    ];
                } else {
                    $exist[] = $value->issue;
                }
            }
            if (!empty($arr)) {
                Library::insert($arr);
            }
        }

        alert()->success('کتاب ها شما به سامانه افزوده شد', 'بارگذاری اکسل')->autoclose(2000);

        return back()->withErrors($exist);
    }

    public function downloadExcel($type)
    {

        $data = Library::select('*')
            ->get()->toArray();

        return Excel::create('لیست کتاب ها', function ($excel) use ($data) {
            $excel->sheet('users', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }


}
