<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Image;
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        Helpers::read_json();
        $languages = Language::where('is_default', 'yes')
            ->orderBy('created_at','desc')
            ->union(Language::where('is_default', 'no')->orderBy('created_at', 'desc'))
            ->paginate(10);
        return view('admin.language.index',compact('languages'));
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
            'short_name' => 'required',
            'flag' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        if ($request->is_default == 'Yes') {
            DB::table('languages')->update(['is_default' => 'No']);
        }

        $image = $request->file('flag');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 400)->save('upload/flag/' . $name_gen);

        $save_url = 'upload/flag/' . $name_gen;

        Language::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'short_name' => $request->short_name,
            'is_default' => $request->is_default,
            'status' => $request->status,
            'flag' => $save_url
        ]);

        $test_file = file_get_contents(resource_path('language/sample.json'));
        file_put_contents(resource_path('language/' . $request->short_name . '.json'), $test_file);

        return redirect()->route('admin.language.index')->with('success', 'Success Created!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($uuid)
    {
        Helpers::read_json();
        $languageFind = Language::where('uuid', $uuid)->first();
        return view('admin.language.edit',compact('languageFind'));
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
            'name' => 'required',
            'short_name' => 'required',
        ]);

        $langId = Language::where('uuid', $uuid)->first();
        $old_img = $request->old_image;

        if ($request->is_default == 'Yes') {
            DB::table('languages')->update(['is_default' => 'No']);
        }

        if ($request->short_name) {
            unlink(resource_path('language/' . $langId->short_name . '.json'));
            $test_file = file_get_contents(resource_path('language/sample.json'));
            file_put_contents(resource_path('language/' . $request->short_name . '.json'), $test_file);
        }

        if ($request->file('flag')) {
            $image = $request->file('flag');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 400)->save('upload/slider/' . $name_gen);

            $save_url = 'upload/flag/' . $name_gen;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            $langId->name = $request->name;
            $langId->short_name = $request->short_name;
            $langId->is_default = $request->is_default;
            $langId->status = $request->status;
            $langId->flag = $save_url;
            $langId->update();
        }else{
            $langId->name = $request->name;
            $langId->short_name = $request->short_name;
            $langId->is_default = $request->is_default;
            $langId->status = $request->status;
            $langId->update();
        }

        return redirect()->route('admin.language.index')->with('success', 'Success Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request, $uuid)
    {

        $langDelete =  Language::where('uuid', $uuid)->first();
        $id = $langDelete['id'];
        $langDelete->delete();
        /*$logData = $fileJson::update([
            'proccess_id' => $id,
            'user_id' => Auth::user()->id,
            'proccess' => 'Destroy'
        ]);*/
        if ($request->is_default == 'Yes') {
            DB::table('languages')->update(['is_default' => 'No']);
        }
        return redirect()->route('admin.language.index')->with('success', 'Success Deleted!');
    }

    public function translation($uuid)
    {
        Helpers::read_json();
        $language_data = Language::where('uuid', $uuid)->first();
        $lang_id = $language_data->id;
        $lang_name = $language_data->name;
        $json_data = json_decode(file_get_contents(resource_path('language/' . $language_data->short_name . '.json')));
        return view('admin.language.translation', compact('json_data', 'lang_id', 'lang_name'));
    }

    public function translation_update(Request $request, $uuid)
    {
        $language_data = Language::where('uuid', $uuid)->first();

        $arr1 = [];
        $arr2 = [];

        foreach ($request->arr_key as $val) {
            $arr1[] = $val;
        }

        foreach ($request->arr_value as $val) {
            $arr2[] = $val;
        }

        for ($i = 0; $i < count($arr1); $i++) {
            $data[$arr1[$i]] = $arr2[$i];
        }

        $after_encode = json_encode($data, JSON_UNESCAPED_UNICODE);
        file_put_contents(resource_path('language/' . $language_data->short_name . '.json'), $after_encode);
        return redirect()->route('admin.language.index')->with('success', 'Success Updated!');

    }

    public function admin_swich_language(Request $request)
    {
        session()->put('session_short_name',$request->short_name);

        return redirect()->back();
    }
}
