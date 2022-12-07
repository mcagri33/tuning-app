@extends('admin.admin_master')
@section('title','Language')
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
                                <form class="row g-3" action="{{route('admin.language.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">{{Flag}}</label>
                                        <input type="file" class="form-control" name="flag">
                                        @error("flag")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Language_Name}}</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                               placeholder="Language Name">
                                        @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Short_Name}}</label>
                                        <input type="text" class="form-control" name="short_name" value="{{old('short_name')}}"
                                               placeholder="Short Name">
                                        @error("short_name")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{Is_Default}}</label>
                                        <select class="form-select" name="is_default">
                                            <option value="Yes">{{Yes}}</option>
                                            <option value="No">{{No}}</option>
                                        </select>
                                        @error("is_default")
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
                                        @if(count($languages)>0)
                                            <thead class="table-light">
                                            <tr>
                                                <th>{{Id}}</th>
                                                <th>{{Language_Name}}</th>
                                                <th>{{Short_Name}}</th>
                                                <th>{{Translation}}</th>
                                                <th>{{Is_Default}}</th>
                                                <th>{{Status}}</th>
                                                @if(count($languages)>1)
                                                <th>{{Action}}</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($languages as $language)
                                                <tr>
                                                    <td>{{$languages ->perPage()*($languages->currentPage()-1)+$count}}</td>
                                                    <?php $count++; ?>
                                                    <td>{{$language->name}}</td>
                                                    <td>{{$language->short_name}}</td>
                                                    <td>
                                                        <a href="{{route('admin.translation.index',$language->uuid)}}" class="btn-primary">{{Translation}}</a>
                                                    </td>
                                                    @if($language->is_default == "Yes")
                                                        <td><span class="badge rounded-pill bg-success">{{Yes}}</span>
                                                        </td>
                                                    @else
                                                        <td><span class="badge rounded-pill bg-warning">{{No}}</span>
                                                        </td>
                                                    @endif

                                                    @if($language->status == 1)
                                                        <td><span class="badge rounded-pill bg-success">{{Active}}</span>
                                                        </td>
                                                    @else
                                                        <td><span class="badge rounded-pill bg-warning">{{Passive}}</span>
                                                        </td>
                                                    @endif
                                                    @if(count($languages)>1)
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3 fs-6">
                                                          {{--  <a href="{{route('admin.language.edit',$language->uuid)}}"
                                                               class="text-warning" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Edit info" aria-label="{{Edit}}"><i
                                                                    class="bi bi-pencil-fill"></i></a>--}}

                                                            <a href="{{route('admin.language.delete',$language->uuid)}}"
                                                               class="text-danger" data-bs-toggle="tooltip"
                                                               data-bs-placement="bottom" title=""
                                                               data-bs-original-title="Delete" aria-label="{{Delete}}"><i
                                                                    class="bi bi-trash-fill"></i></a>
                                                            @endif
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
                                    {!! $languages->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>

    </main>
@endsection
