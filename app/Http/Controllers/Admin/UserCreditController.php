<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\UserCredit;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class UserCreditController extends Controller
{

    public function index()
    {
        Helpers::read_json();
        if (Auth::check()) {
            $userId =  Auth::id();
        }
        //dd($userId);
        $ucredits = UserCredit::where('user_id',$userId)->orderBy('created_at','desc')->paginate(15);
        $userAlls = UserCredit::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.credit.history',compact('ucredits','userAlls'));

    }

    public function add()
    {
        Helpers::read_json();
        $currecies = Currency::where('status',1)->get();
        return view('admin.credit.add',compact('currecies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/'
        ],
        [
            'price.required' => 'Price is required',
            'price.regex' => 'Price have to be number'
        ]);

        if (Auth::check()) {
            $userId =  Auth::id();
        }

       $credit = UserCredit::create([
            'uuid' => Str::uuid(),
            'amount' => $request->price,
            'price' => $request->price,
            'user_id' => $userId ,
            'currency_id' => $request->currency_id,
            'type' => $request->type,
        ]);
        if ($request->type == 1){
            $credit->status = 2;
            $credit->update();
        }

        if ($request->type == 1){
            return redirect()->route('admin.ucredit.payment');
        }else{
            echo 'Bank Payment will add later';
        }

    }


}
