@extends('admin.admin_master')
@section('title')
    {{Language_Management}}
@endsection
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
                            <form class="row g-3" action="{{route('admin.language.update',$languageFind->uuid)}}" method="post">
                                @csrf
                                <img src="{{asset($languageFind->flag)}}" style="height: 100px; width: 100px;">
                                <div class="col-12">
                                    <label class="form-label">{{Flag}}</label>
                                    <input type="file" class="form-control" name="flag">
                                    @error("flag")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">{{Language_Name}}</label>
                                    <input type="text" class="form-control" name="name" value="{{$languageFind->name}}"
                                           placeholder="Language Name">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">{{Short_Name}}</label>
                                    <input type="text" class="form-control" name="short_name" value="{{$languageFind->short_name}}"
                                           placeholder="Short Name">
                                    @error("short_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">{{Is_Default}}</label>
                                    <select class="form-select" name="is_default">
                                        <option value="Yes" {{$languageFind->is_default == "Yes" ? "selected" : ""}}>
                                            {{Yes}}
                                        </option>
                                        <option value="No" {{$languageFind->is_default ==  "No"  ? "selected" : ""}}>
                                            {{No}}
                                        </option>
                                    </select>
                                    @error("is_default")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">{{Status}}</label>
                                    <select class="form-select" name="status">
                                        <option value="1" {{$languageFind->status == 1 ? "selected" : ""}}>Active</option>
                                        <option value="0" {{$languageFind->status == 0 ? "selected" : ""}}>Passive</option>
                                    </select>
                                    @error("status")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">{{Update}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
