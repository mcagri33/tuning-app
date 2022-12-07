<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {


        Helpers::read_json();
        $cmodels = CarModel::paginate(10);
        $brands = CarBrand::all();
        return view('admin.setting.car.model.index',compact('cmodels','brands'));
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

       CarModel::create([
            'name' => $request->name,
            'uuid' => Str::uuid(),
            'brand_id' => $request->brand_id
        ]);

        return redirect()->route('admin.cmodel.index')->with('success', 'Success Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($uuid)
    {
        Helpers::read_json();
        $cmodelFind = CarModel::where('uuid', $uuid)->first();
        return view('admin.setting.car.model.edit',compact('cmodelFind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request, $uuid)
    {
        $cmodelId = CarModel::where('uuid', $uuid)->first();
        $cmodelId->name = $request->name;
        $cmodelId->brand_id = $request->brand_id;
        $cmodelId->update();
        return redirect()->route('admin.cmodel.index')->with('success', 'Success Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy($uuid)
    {
        $cmodelDelete = CarModel::where('uuid', $uuid)->first();
        $cmodelDelete->delete();
        return redirect()->route('admin.cmodel.index')->with('success', 'Success Deleted!');

    }
}
