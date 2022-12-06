@extends('admin.admin_master')
@section('title','Translation' )
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

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">{{$lang_name}}</h5>
                    <form class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                        <input class="form-control ps-5" type="text" placeholder="search">
                    </form>
                </div>
                <div class="table-responsive mt-3">
                    <form action="{{route('admin.translation.update',$lang_id)}}" method="post">
                        @csrf
                    <table class="table align-middle">
                        <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Key</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($json_data as $key => $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$key}}</td>
                                    <td>
                                        <input type="hidden" name="arr_key[]" class="form-control" value="{{$key}}">
                                        <input type="text" name="arr_value[]" class="form-control" value="{{$value}}">

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>

@endsection
