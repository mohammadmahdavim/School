<?php

namespace App\Http\Controllers\admin;

use App\Finanace;
use App\lib\EnConverter;
use App\LogFinanace;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class FinanceController extends Controller
{
    public function index($id)
    {
        $users = User::where('role', 'دانش آموز')->where('class', $id)->with('finance')->paginate(200);
        return view('Admin.finance.index', ['users' => $users, 'id' => $id]);
    }

    public function edit(Request $request, $id)
    {
        $finance = Finanace::where('user_id', $id)->first();
        $total = (string)EnConverter::bn2en($request->total);
        if ($finance) {


            $paid = $finance->paid;

            $finance->update([
                'total' => $total,
                'dead_time' => $request->input('date-picker-shamsi-list'),
                'remaining' => $total - $paid,
                'updated_at' => Jalalian::now()
            ]);
        } else {
            Finanace::create([
                'user_id' => $id,
                'total' => $total,
                'remaining' => $total,
                'paid' => 0,
                'created_at' => Jalalian::now(),
                'updated_at' => Jalalian::now(),
            ]);
        }
        alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
        return back();
    }

    public function changeStatus(Request $request)
    {
        $user = Finanace::find($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function paid()
    {
        $paides = LogFinanace::with('user')->paginate(20);
        return view('Admin.finance.paid', ['paides' => $paides]);

    }

    public function downloadExcel($type)
    {

        $data = LogFinanace::
        join('users', 'users.id', '=', 'log_finanaces.user_id')
            ->select('users.f_name', 'users.f_name', 'users.l_name', 'users.class', 'log_finanaces.price', 'log_finanaces.type', 'log_finanaces.verify')
            ->get()->toArray();

        return Excel::create('finances', function ($excel) use ($data) {
            $excel->sheet('finances', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function fish()
    {
        $fishs = LogFinanace::where('type', 'fish')->with('user')->orderBy('created_at')->paginate(20);
        return view('Admin.finance.fish', ['fishs' => $fishs]);
    }

    public function cheque(Request $request)
    {
        $cheques = LogFinanace::whereIn('type', ['cheque', 'cache'])
            ->with('user')
            ->when($request->get('user_id'), function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->get('verify'), function ($query) use ($request) {
                $query->whereIn('verify', $request->verify);
            })
            ->when($request->get('type'), function ($query) use ($request) {
                $query->whereIn('type', $request->type);
            })
            ->when($request->get('date-picker-shamsi-list'), function ($query) use ($request) {
                $query->where('cheque_date', '>=', $request->input('date-picker-shamsi-list'));
            })
            ->when($request->get('date-picker-shamsi-list-1'), function ($query) use ($request) {
                $query->where('cheque_date', '<=', $request->input('date-picker-shamsi-list-1'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $sum = LogFinanace::whereIn('type', ['cheque', 'cache'])
            ->with('user')
            ->when($request->get('user_id'), function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->get('verify'), function ($query) use ($request) {
                $query->whereIn('verify', $request->verify);
            })
            ->when($request->get('type'), function ($query) use ($request) {
                $query->whereIn('type', $request->type);
            })
            ->when($request->get('date-picker-shamsi-list'), function ($query) use ($request) {
                $query->where('cheque_date', '>=', $request->input('date-picker-shamsi-list'));
            })
            ->when($request->get('date-picker-shamsi-list-1'), function ($query) use ($request) {
                $query->where('cheque_date', '<=', $request->input('date-picker-shamsi-list-1'));
            })->sum('price');
        $students = User::where('role', 'دانش آموز')->has('finance')->get();
        return view('Admin.finance.cheque', ['cheques' => $cheques, 'students' => $students,'sum' => $sum]);
    }

    public function cheque_cash(Request $request)
    {
        $log = LogFinanace::create([
            'user_id' => $request->user_id,
            'price' => $request->price,
            'type' => $request->type,
            'cheque_number' => $request->cheque_number,
            'cheque_date' => $request->input('date-picker-shamsi-list'),
            'verify' => isset($request->verify) ? 1 : 0,
        ]);
        if (isset($request->verify)) {
            $finance = Finanace::where('user_id', $log->user_id)->first();
            $paid = $finance->paid + $request->price;
            $remaining = $finance->remaining - $request->price;
            $finance->update([
                'paid' => $paid,
                'remaining' => $remaining,
                'status' => $remaining <= 0 ? 1 : 0,
                'updated_at' => Jalalian::now(),
            ]);
        }
        alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
        return back();
    }


    public function fishedit(Request $request, $id)
    {
        $log = LogFinanace::find($id);
        if ($log->verify == 0) {
            $log->update([
                'price' => $request->price,
                'verify' => 1,
                'cheque_date' => $request->input('date-picker-shamsi-list'),
                'updated_at' => Jalalian::now(),
            ]);
            $finance = Finanace::where('user_id', $log->user_id)->first();
            $remaining = $finance->remaining - $request->price;
            $finance->update([
                'paid' => $finance->paid + $request->price,
                'remaining' => $remaining,
                'status' => $remaining <= 0 ? 1 : 0,
                'updated_at' => Jalalian::now(),
            ]);
        } else {
            $log->update([
                'price' => $request->price,
                'cheque_date' => $request->input('date-picker-shamsi-list'),
                'verify' => 0,
                'updated_at' => Jalalian::now(),
            ]);
            $finance = Finanace::where('user_id', $log->user_id)->first();
            $remaining = $finance->remaining + $request->price;
            $finance->update([
                'paid' => $finance->paid - $request->price,
                'remaining' => $finance->remaining + $request->price,
                'status' => $remaining <= 0 ? 1 : 0,
                'updated_at' => Jalalian::now(),
            ]);
        }
        alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
        return back();
    }

    public function group(Request $request)
    {
        $users = User::where('class', $request->class)->where('role', 'دانش آموز')->get();
        foreach ($users as $user) {
            $finance = Finanace::where('user_id', $user->id)->first();
            if ($finance) {
                $paid = $finance->paid;
                $finance->update([
                    'total' => $request->finance,
                    'remaining' => $request->finance - $paid,
                    'updated_at' => Jalalian::now()
                ]);
            } else {
                Finanace::create([
                    'user_id' => $user->id,
                    'total' => $request->finance,
                    'remaining' => $request->finance,
                    'paid' => 0,
                    'created_at' => Jalalian::now(),
                    'updated_at' => Jalalian::now(),
                ]);
            }
        }
        alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
        return back();
    }

    public function upload(Request $request)
    {

        $cover = $request->file('file');
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images/finance');
        $cover->move($path, $filename);
        $mime = $cover->getClientMimeType();
        $original_filename = $cover->getClientOriginalName();
        $finance = new LogFinanace();
        $finance->user_id = $request->user_id;
        $finance->price = $request->price;
        $finance->mime = $mime;
        $finance->original_filename = $original_filename;
        $finance->filename = $filename;
        $finance->type = 'fish';
        $finance->verify = 1;
        $finance->created_at = Jalalian::now();
        $finance->save();
        $finance = Finanace::where('user_id', $request->user_id)->first();
        $finance->update([
            'paid' => $finance->paid + $request->price,
            'remaining' => $finance->remaining - $request->price,
            'updated_at' => Jalalian::now(),
        ]);
        alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
        return back();
    }

    public function delete_cheque_cash($id)
    {
        $log = LogFinanace::find($id);
        $finance = Finanace::where('user_id', $log->user_id)->first();
        $remaining = $finance->remaining + $log->price;
        $finance->update([
            'paid' => $finance->paid - $log->price,
            'remaining' => $finance->remaining + $log->price,
            'status' => $remaining <= 0 ? 1 : 0,
            'updated_at' => Jalalian::now(),
        ]);
        $log->delete();
    }

}
