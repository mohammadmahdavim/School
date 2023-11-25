<?php

namespace App\Http\Controllers\student;

use App\lib\Kavenegar;
use App\Models\Gateway;
use App\Models\Payment;
use App\Product;
use App\Reserve;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $rows = Product::when($request->get('name'), function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->name . '%');
        })
            ->paginate(30);
        return view('student.product.index', compact('rows'));
    }

    public function reserve(Request $request)
    {
        $code=$this->code();
        Reserve::create([
            'product_id' => $request->product,
            'user_id' => auth()->user()->id,
            'code' => $code,
            'for_date' => $request->input('date-picker-shamsi-list'),
        ]);
        alert()->success('رزرو با موفقت ثبت شد.', 'عملیات موفق');

        if (Setting::where('id',1)->pluck('product_sms')->first()==1)
        {
            Kavenegar::sendSMS(auth()->user()->mobile,$code,'product');

        }
        return back();
    }

    public function pay(Request $request)
    {
        $reserve = Reserve::create([
            'product_id' => $request->product,
            'user_id' => auth()->user()->id,
            'code' => $this->code(),
            'for_date' => $request->input('date-picker-shamsi-list'),
        ]);
        $product = Product::where('id', $request->product)->first();
        if ($product->price > 100) {
            $token = Str::random(50);
            Payment::create([
                'user_id' => auth()->user()->id,
                'amount' => $product->price,
                'gateway_id' => 1,
                'token' => $token,
                'date' => time(),
                'trans_id' => null,
                'id_get' => null,
                'type' => 'online',
                'status' => 'waiting',
                'for' => 'product',
                'table_id' => $reserve->id,
                'ip' => $request->ip(),
            ]);

            $payment = Gateway::payment(1, $token);
            $payment = $payment->getData();
            if ($payment->status == 200) {
                return redirect($payment->url);
            }

            return response()->json([
                'message' => 'ارتباط با بانک برقرار نمی باشد. بعدا تلاش کنید!'
            ], 400);
        }

    }

    public function code()
    {
        do {
            $randomCode = rand(100000, 999999);
        } while (Reserve::where('code', $randomCode)->exists());

        return $randomCode;
    }

    public function reserves()
    {
        $rows = Reserve::where('user_id',auth()->user()->id)
            ->with('product')
            ->orderBy('created_at','desc')
            ->paginate(30);
        return view('student.product.reserves', compact('rows'));
    }
}
