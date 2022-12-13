@extends('admin.admin_master')
@section('title')
    {{Currency}}
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
                            <form class="row g-3" action="{{route('admin.currency.update',$curFind->uuid)}}" method="post" >
                                @csrf
                                <div class="col-6">
                                    <label class="form-label">{{Currency_name}}</label>
                                    <input type="text" name="name" value="{{$curFind->name}}"  placeholder="{{Currency_name}}">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">{{Currency_code}}</label>
                                    <input type="text" name="code" value="{{$curFind->code}}" placeholder="{{Currency_code}}">
                                    @error("code")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">{{Currency_symbol}}</label>
                                    <input type="text" name="symbol" value="{{$curFind->symbol}}" placeholder="{{Currency_symbol}}">
                                    @error("symbol")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">{{Currency_value}}</label>
                                    <input type="text" name="value" value="{{$curFind->value}}" placeholder="{{Currency_value}}">
                                    @error("value")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">{{Status}}</label>
                                    <select class="form-select" name="status">
                                        <option value="1" {{$curFind->status == 1 ? "selected" : ""}}>{{Active}}</option>
                                        <option value="0" {{$curFind->status == 0 ? "selected" : ""}}>{{Passive}}</option>
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
        </div><!--end row-->

    </main>

@endsection
