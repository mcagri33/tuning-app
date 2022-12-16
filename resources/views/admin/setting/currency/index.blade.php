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
                                <form class="row g-3" action="{{route('admin.currency.store')}}" method="post">
                                    @csrf
                                    <div class="col-6">
                                        <label class="form-label">{{Currency_name}}</label>
                                        <input type="text" name="name" value="{{old('name')}}" placeholder="{{Currency_name}}">
                                        @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">{{Currency_code}}</label>
                                        <input type="text" name="code" value="{{old('code')}}" placeholder="{{Currency_code}}">
                                        @error("code")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">{{Currency_symbol}}</label>
                                        <input type="text" name="symbol" value="{{old('symbol')}}" placeholder="{{Currency_symbol}}">
                                        @error("symbol")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">{{Currency_value}}</label>
                                        <input type="text" name="value" value="{{old('value')}}" placeholder="{{Currency_value}}">
                                        @error("value")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Language_Select}}</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" name="language_id[]" multiple="multiple">
                                            @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                        @error("language_id")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Status}}</label>
                                        <select class="form-select" name="status">
                                            <option value="1">{{Active}}</option>
                                            <option value="0">{{Passive}}</option>
                                        </select>
                                        @error("status")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary" type="submit">{{Add}}</button>
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
                                        @if(count($currentcies)>0)
                                            <thead class="table-light">
                                            <tr>
                                                <th>{{Id}}</th>
                                                <th>{{Currency_name}}</th>
                                                <th>{{Currency_code}}</th>
                                                <th>{{Currency_symbol}}</th>
                                                <th>{{Currency_value}}</th>
                                                <th>{{Status}}</th>
                                                <th>{{Action}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($currentcies as $data)
                                                <tr>
                                                    <td>{{$currentcies ->perPage()*($currentcies->currentPage()-1)+$count}}</td>
                                                    <?php $count++; ?>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->code}}</td>
                                                    <td>{{$data->symbol}}</td>
                                                    <td>{{$data->value}}</td>
                                                    @if($data->status == 1)
                                                        <td><span class="badge rounded-pill bg-success">{{Active}}</span>
                                                        </td>
                                                    @else
                                                        <td><span class="badge rounded-pill bg-warning">{{Passive}}</span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3 fs-6">
                                                            <a href="{{route('admin.currency.edit',$data->uuid)}}"
                                                               class="text-warning" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Edit info" aria-label="{{Edit}}"><i
                                                                    class="bi bi-pencil-fill"></i></a>
                                                            <a href="{{route('admin.currency.delete',$data->uuid)}}"
                                                               class="text-danger" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Delete" aria-label="{{Delete}}"><i
                                                                    class="bi bi-trash-fill"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        @else
                                            {{Found_Text}}
                                        @endif
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $currentcies->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>

    </main>
@endsection
