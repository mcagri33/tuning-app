<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        Helpers::read_json();
        $users = User::paginate(10);
        $roles = Role::all();
        return view('admin.user.index',compact('users','roles'));
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
        $user = User::create([
            'name' => $request->name,
            'uuid' => Str::uuid(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);
        $user->assignRole($request->role);

        return redirect()->route('admin.user.index')->with('success', 'Success Created!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($uuid)
    {
        Helpers::read_json();
        $userFind =User::where('uuid', $uuid)->first();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.user.edit',compact('userFind','roles','permissions'));
    }


    public function update(Request $request,$uuid)
    {
        $userId = User::where('uuid', $uuid)->first();
        $userId->name = $request->name;
        $userId->email = $request->name;
        $userId->password = Hash::make($request->password);
        $userId->status =$request->status;
        $userId->save();
        return redirect()->route('admin.user.index')->with('success', 'Success Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy($uuid)
    {
        $userDelete = User::where('uuid', $uuid)->first();
        $userDelete->delete();
        return redirect()->route('admin.user.index')->with('success', 'Success Deleted!');
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }
}
