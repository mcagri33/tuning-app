<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        Helpers::read_json();
        $cbrands = CarBrand::paginate(10);
        return view('admin.setting.car.brand.index',compact('cbrands'));
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
            'name' => 'required',
        ]);

        CarBrand::create([
            'name' => $request->name,
            'uuid' => Str::uuid(),
        ]);

        return redirect()->route('admin.cbrand.index')->with('success', 'Success Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($uuid)
    {
        Helpers::read_json();
        $cbrandFind = CarBrand::where('uuid', $uuid)->first();
        return view('admin.setting.car.brand.edit',compact('cbrandFind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request, $uuid)
    {
        $cbrandId = CarBrand::where('uuid', $uuid)->first();
        $cbrandId->name = $request->name;
        $cbrandId->update();
        return redirect()->route('admin.cbrand.index')->with('success', 'Success Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy($uuid)
    {
        $cbrandDelete = CarBrand::where('uuid', $uuid)->first();
        $cbrandDelete->delete();
        return redirect()->route('admin.cbrand.index')->with('success', 'Success Deleted!');

    }
}
