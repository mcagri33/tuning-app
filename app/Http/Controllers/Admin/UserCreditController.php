<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\UserCredit;
use Illuminate\Http\Request;
use Auth;
class UserCreditController extends Controller
{

    public function index()
    {
        Helpers::read_json();
        if (Auth::check()) {
            $userId =  Auth::id();
        }
        //dd($userId);
        $ucredits = UserCredit::where('user_id',$userId)->paginate(15);

        return view('admin.credit.history',compact('ucredits'));

    }

    public function add()
    {
        Helpers::read_json();

        return view('admin.credit.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' =>  'required|numeric|between:1,99999999999999',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/'
        ]);
        UserCredit::create([
            'amount' => $request->amount,
            'price' => $request->price,
            'status' => $request->status,
            'user_id' => $this->userid ,
            'type' => $request->type,
        ]);

        if ($request->type == 1){
            return redirect()->route('admin.ucredit.payment');
        }else{
            echo 'Bank Payment will add later';
        }

    }
}
