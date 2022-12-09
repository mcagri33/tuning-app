@extends('admin.admin_master')
@section('title')
    {{Car_Models}}
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
                            <form class="row g-3" action="{{route('admin.cmodel.update',$cmodelFind->uuid)}}" method="post" >
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">{{Name}}</label>
                                    <input type="text" name="name" class="form-control" value="{{$cmodelFind->name}}" placeholder="{{Name}}">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">{{Car_Model_Select}}</label>
                                    <select class="form-select mb-3" name="brand_id">
                                        <option value="">{{Select}}</option>
                                        @foreach($brands as $brand )
                                            <option value="{{$brand->id}}" {{$brand->id == $cmodelFind->brand_id ? "selected" : "" }}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @error("brand_id")
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
        </div><!--end row-->

    </main>

@endsection
