<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware("auth");
    }

    public function index()
    {
        $permissions = $this->permission::paginate(10);
       // dd($permissions);
        return view('admin.permission.index',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $this->permission->create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Success Created!');

    }

    public function edit($id)
    {
        $perFind = $this->permission->find($id);
        return view('admin.permission.edit',compact('perFind'));
    }

    public function update(Request $request)
    {
        $perId = $this->permission->findOrFail($request->id);
        $perId->name = $request->name;
        $perId->update();
        return redirect()->route('admin.permissions.index')->with('success', 'Success Created!');
    }

    public function destroy($id)
    {
        $perDelete = $this->permission->findOrFail($id);
        $perDelete->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Success Created!');
    }
}
