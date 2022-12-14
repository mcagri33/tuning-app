@extends('admin.admin_master')
@section('title')
    {{Credit_History}}
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
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">{{Credit_Total}}</p>
                                <h4 class="mb-0">{{$ucredits->where('status',1)->sum('amount')}} </h4>
                            </div>
                            <div class="ms-auto widget-icon bg-primary text-white">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">{{Credit_Status_Pending}}</p>
                                <h4 class="mb-0">{{$ucredits->where('status',2)->sum('amount')}} </h4>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           {{-- <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">{{Credit_Status_Pending}}</p>
                                <h4 class="mb-0">875</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>12.3% from last week</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-orange text-white">
                                <i class="bi bi-emoji-heart-eyes"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">New Clients</p>
                                <h4 class="mb-0">9853</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>32.7% from last week</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-info text-white">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}

        </div><!--end row-->

        @include('admin.layouts.alert')
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-8 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(Auth::check() && Auth::user()->hasRole('admin'))
                                    <table class="table align-middle">
                                            <thead class="table-light">
                                            <tr>
                                                <th>{{Id}}</th>
                                                <th>{{User_Name}}</th>
                                                <th>{{Create_Date}}</th>
                                                <th>{{Amount}}</th>
                                                <th>{{Currency}}</th>
                                                <th>{{Payment_Type}}</th>
                                                <th>{{Status}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($userAlls as $data)
                                                <tr>
                                                    <td>{{$userAlls ->perPage()*($userAlls->currentPage()-1)+$count}}</td>
                                                    <?php $count++; ?>
                                                    <td>{{$data->user->name}}</td>
                                                    <td>{{$data->created_at->format('d-m-Y')}}</td>
                                                    <td>{{$data->amount}}</td>
                                                    <td>
                                                        @if($data->currency)
                                                            {{$data->currency->symbol}}
                                                        @else
                                                           -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->type == 1)
                                                            {{Bank_Transfer}}
                                                        @else
                                                            {{Credit_Cart}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->status == 1)
                                                        <span class="badge rounded-pill bg-success">
                                                            {{Payment_Done}}
                                                            </span>
                                                        @elseif($data->status == 2)
                                                            <span class="badge rounded-pill bg-warning">
                                                            {{Payment_Pending}}
                                                            </span>
                                                        @elseif($data->status == 3)
                                                            <span class="badge rounded-pill bg-danger">
                                                            {{Payment_Cancel}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $userAlls->links() !!}
                                </div>
                                        @else
                                    <table class="table align-middle">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>{{Id}}</th>
                                                    <th>{{Create_Date}}</th>
                                                    <th>{{Amount}}</th>
                                                    <th>{{Currency}}</th>
                                                    <th>{{Payment_Type}}</th>
                                                    <th>{{Status}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $count = 1; ?>
                                                @foreach($ucredits as $ucredit)
                                                    <tr>
                                                        <td>{{$ucredits ->perPage()*($ucredits->currentPage()-1)+$count}}</td>
                                                        <?php $count++; ?>
                                                        <td>{{$ucredit->created_at->format('d-m-Y')}}</td>
                                                        <td>{{$ucredit->amount}}</td>
                                                        <td>
                                                            @if($ucredit->currency)
                                                                {{$ucredit->currency->symbol}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($ucredit->type == 1)
                                                                {{Bank_Transfer}}
                                                            @else
                                                                {{Credit_Cart}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($ucredit->status == 1)
                                                                <span class="badge rounded-pill bg-success">
                                                            {{Payment_Done}}
                                                            </span>
                                                            @elseif($ucredit->status == 2)
                                                                <span class="badge rounded-pill bg-warning">
                                                            {{Payment_Pending}}
                                                            </span>
                                                            @elseif($ucredit->status == 3)
                                                                <span class="badge rounded-pill bg-danger">
                                                            {{Payment_Cancel}}
                                                            </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                        @endif
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $ucredits->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>

    </main>
@endsection
