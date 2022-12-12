@extends ('App')

@section('content-header')

@php
@endphp

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Kategori</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Asset</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Non-asset</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">200</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- assets update --}}
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Asset Update</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th>Nama barang</th>
                        <th>Kode Barang</th>
                        <th>Responsible</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assets as $x)
                    <tr>
                        <td>{{ $x->created }}</td>
                        <td>{{ $x->item->kind->label }}</td>
                        <td>{{ $x->item->merk->label }}</td>
                        <td>{{ $x->item->name }}</td>
                        <td>{{ $x->item->code }}</td>
                        <td>{{ $x->item->stock->responsible->name }}</td>
                        <td><span class="badge badge-{{ $x->item->status == true ? 'success' : 'danger' }}">{{ $x->item->status == true ? 'Masuk' : 'Keluar'  }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    </div>
    <!-- /.card-footer -->
</div>

{{-- non asset update --}}
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Non-Asset Update</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
         <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th>Nama barang</th>
                        <th>Jumlah</th>
                        <th>Responsible</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nonAssets as $x)
                        <tr>
                            <td>{{ $x->moved_at }}</td>
                            <td>{{ $x->item->kind->label }}</td>
                            <td>{{ $x->item->merk->label }}</td>
                            <td>{{ $x->item->name }}</td>
                            <td>{{ (int) $x->amount }}</td>
                            <td>{{ $x->item->stock->responsible->name }}</td>
                            <td><span class="badge badge-{{ $x->type == 'in' ? 'success' : 'danger' }}">{{  $x->type == 'in' ? 'Masuk' : 'Keluar'  }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    </div>
    <!-- /.card-footer -->
</div>

<!-- /.card -->


@endsection

@endsection
