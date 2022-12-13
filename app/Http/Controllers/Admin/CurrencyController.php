<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        Helpers::read_json();

        $currentcies = Currency::orderBy('status','desc')->paginate(15);
        return view('admin.setting.currency.index',compact('currentcies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>  'required',
            'code' =>  'required',
            'symbol' =>  'required',
        ]);


         Currency::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'value' => $request->value,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.currency.index')->with('success', 'Success Created!');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($uuid)
    {
        Helpers::read_json();
        $curFind = Currency::where('uuid', $uuid)->first();
        return view('admin.setting.currency.edit',compact('curFind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'name' =>  'required',
            'code' =>  'required',
            'symbol' =>  'required',
        ]);


        $curId = Currency::where('uuid', $uuid)->first();
        $curId->name = $request->name;
        $curId->code = $request->code;
        $curId->symbol = $request->symbol;
        $curId->value = $request->value;
        $curId->status = $request->status;
        $curId->update();
        return redirect()->route('admin.currency.index')->with('success', 'Success Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy($uuid)
    {
        $curDel = Currency::where('uuid', $uuid)->first();
        $curDel->delete();
        return redirect()->route('admin.currency.index')->with('success', 'Success Deleted!');

    }
}
