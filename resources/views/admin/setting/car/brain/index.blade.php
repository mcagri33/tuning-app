@extends('admin.admin_master')
@section('title')
    {{Car_Brains}}
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
                                <form class="row g-3" action="{{route('admin.cbrain.store')}}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">{{Car_Brands}}</label>
                                        <select id="brand-dd" class="form-select mb-3" name="brand_id">
                                            <option value="">{{Car_Brand_Select}}</option>
                                            @foreach($brands as $brand )
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error("brand_id")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Car_Models}}</label>
                                        <select id="model-dd" class="form-select mb-3" name="model_id">

                                        </select>
                                        @error("model_id")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Car_Brain_Name}}</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                               placeholder="{{Car_Brand_Name}}">
                                        @error("name")
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
                                        @if(count($cbrains)>0)
                                            <thead class="table-light">
                                            <tr>
                                                <th>{{Id}}</th>
                                                <th>{{Car_Brain_Name}}</th>
                                                <th>{{Car_Model_Name}}</th>
                                                <th>{{Action}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($cbrains as $cbrain)
                                                <tr>
                                                    <td>{{$cbrains ->perPage()*($cbrains->currentPage()-1)+$count}}</td>
                                                    <?php $count++; ?>
                                                    <td>{{$cbrain->name}}</td>
                                                    <td>
                                                        @if($cbrain->model)
                                                        {{$cbrain->model->name}}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3 fs-6">
                                                            <a href="{{route('admin.cbrain.edit',$cbrain->uuid)}}"
                                                               class="text-warning" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Edit info" aria-label="{{Edit}}"><i
                                                                    class="bi bi-pencil-fill"></i></a>
                                                            <a href="{{route('admin.cbrain.delete',$cbrain->uuid)}}"
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
                                    {!! $cbrains->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#brand-dd').on('change', function () {
                var idBrand = this.value;
                $("#model-dd").html('');
                $.ajax({
                    url: "{{url('panel/cbrain/fetch-models')}}",
                    type: "POST",
                    data: {
                        brand_id: idBrand,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#model-dd').html('<option value="">{{Car_Model_Select}}</option>');
                        $.each(result.models, function (key, value) {
                            $("#model-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
