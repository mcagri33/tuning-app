@extends('admin.admin_master')
@section('title','User')
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

        @include('admin.layouts.alert')
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('admin.user.store')}}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                               placeholder="User Name">
                                        @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}"
                                               placeholder="Email">
                                        @error("email")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                        @error("password")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="role" class="form-label">Roles</label>
                                        <select id="role" name="role" autocomplete="role-name"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Passive</option>
                                        </select>
                                        @error("status")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary" type="submit">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        @if(count($users)>0)
                                            <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$users ->perPage()*($users->currentPage()-1)+$count}}</td>
                                                    <?php $count++; ?>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->getRoleNames()->implode(',')}}</td>
                                                    @if($user->status == 1)
                                                        <td><span class="badge rounded-pill bg-success">Active</span>
                                                        </td>
                                                    @else
                                                        <td><span class="badge rounded-pill bg-warning">Passive</span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3 fs-6">
                                                            <a href="{{route('admin.user.edit',$user->uuid)}}"
                                                               class="text-warning" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Edit info" aria-label="Edit"><i
                                                                    class="bi bi-pencil-fill"></i></a>
                                                            <a href="{{route('admin.user.delete',$user->uuid)}}"
                                                               class="text-danger" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Delete" aria-label="Delete"><i
                                                                    class="bi bi-trash-fill"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        @else
                                            No Data Found !
                                        @endif
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>

    </main>
@endsection
