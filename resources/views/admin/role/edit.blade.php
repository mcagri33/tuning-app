@extends('admin.admin_master')
@section('title','Role Edit')
@section('admin')

    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@yield('title')</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('admin.role.update')}}" method="post" >
                                @csrf
                                <input type="hidden" name="id" value="{{$roleFind->id}}">
                                <div class="col-12">
                                    <label class="form-label">{{Name}}</label>
                                    <input type="text" name="name" class="form-control" value="{{$roleFind->name}}" placeholder="Name">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">{{Update}}</button>
                                </div>
                            </form>
                                <div class="mt-6 p-2 bg-slate-100">
                                    <h2 class="text-2xl font-semibold">{{Role_Permissions}}</h2>
                                    <div class="flex space-x-2 mt-4 p-2">
                                        @if ($roleFind->permissions)
                                            @foreach ($roleFind->permissions as $role_permission)
                                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                                      action="{{ route('admin.roles.permissions.revoke', [$roleFind->id, $role_permission->id]) }}"
                                                      onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">{{ $role_permission->name }}</button>
                                                </form>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="max-w-xl mt-6">
                                        <form method="POST" action="{{ route('admin.role.permissions', $roleFind->id) }}">
                                            @csrf
                                            <div class="sm:col-span-6">
                                                <label for="permission"
                                                       class="block text-sm font-medium text-gray-700">Permission</label>
                                                <select id="permission" name="permission" autocomplete="permission-name"
                                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('name')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </main>

@endsection
