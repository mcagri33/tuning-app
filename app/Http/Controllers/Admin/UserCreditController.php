<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Language;
use App\Models\UserCredit;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class UserCreditController extends Controller
{

    public function __construct()
    {
        $this->language = Language::all();
    }

    public function index()
    {
        Helpers::read_json();
        if (Auth::check()) {
            $userId =  Auth::id();
        }
        if(!session()->get('session_short_name')) {
            $current_short_name = Language::where('is_default','Yes')->first()->short_name;
        } else {
            $current_short_name = session()->get('session_short_name');
        }
        $current_language_id = Language::where('short_name',$current_short_name)->first()->id;

        //dd($userId);
        $ucredits = UserCredit::where('language_id',$current_language_id)->where('user_id',$userId)->orderBy('created_at','desc')->paginate(15);

        $userAlls = UserCredit::where('language_id',$current_language_id)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.credit.history',compact('ucredits','userAlls'));

    }

    public function add()
    {
        Helpers::read_json();
        if(!session()->get('session_short_name')) {
            $current_short_name = Language::where('is_default','Yes')->first()->short_name;
        } else {
            $current_short_name = session()->get('session_short_name');
        }
        $current_language_id = Language::where('short_name',$current_short_name)->first()->id;

        $currecies = Currency::where('language_id',$current_language_id)->where('status',1)->get();
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

        if(!session()->get('session_short_name')) {
            $current_short_name = Language::where('is_default','Yes')->first()->short_name;
        } else {
            $current_short_name = session()->get('session_short_name');
        }

        $current_language_id = Language::where('short_name',$current_short_name)->first()->id;


        $credit = UserCredit::create([
            'uuid' => Str::uuid(),
            'amount' => $request->price,
            'price' => $request->price,
            'language_id' => $current_language_id,
            'user_id' => $userId ,
            'currency_id' => $request->currency_id,
            'type' => $request->type,
        ]);
        if ($request->type == 1 || $request->type == 2){
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
