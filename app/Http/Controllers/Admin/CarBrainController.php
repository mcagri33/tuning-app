<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\CarBrain;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CarBrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        Helpers::read_json();
        $cbrains = CarBrain::paginate(10);
        $brands = CarBrand::all();
        return view('admin.setting.car.brain.index',compact('cbrains','brands'));
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
            'model_id' => 'required',
        ]);

        CarBrain::create([
            'name' => $request->name,
            'uuid' => Str::uuid(),
            'model_id' => $request->model_id
        ]);

        return redirect()->route('admin.cbrain.index')->with('success', 'Success Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($uuid)
    {
        Helpers::read_json();
        $cbrainFind = CarBrain::where('uuid', $uuid)->first();
        return view('admin.setting.car.brain.edit',compact('cbrainFind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request, $uuid)
    {
        $cbrainId = CarBrain::where('uuid', $uuid)->first();
        $cbrainId->name = $request->name;
        $cbrainId->update();
        return redirect()->route('admin.cbrain.index')->with('success', 'Success Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy($uuid)
    {
        $cbrainDelete = CarBrain::where('uuid', $uuid)->first();
        $cbrainDelete->delete();
        return redirect()->route('admin.cbrain.index')->with('success', 'Success Deleted!');
    }

    public function fetchModel(Request $request)
    {
        $data['models'] = CarModel::where("brand_id",$request->brand_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
