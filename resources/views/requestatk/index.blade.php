<!-- resources/views/requestatk/index.blade.php -->

@extends('layouts.master')

@section('content')
@if (session('sukses'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('sukses') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('gagal') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif

<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Request ATK</h1>
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
        <a href="{{ url('/requests/create') }}" class="btn btn-primary btn-sm">Tambah Request ATK</a>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc text-center" tabindex="0"
                                                aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                                style="width: 10px;">No.</th>
                                            <th class="sorting text-xl-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Kode Barang: activate to sort column ascending"
                                                style="width: 40px;">Kode ATK</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Nama Barang: activate to sort column ascending"
                                                style="width: 200px;">Nama ATK</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Request: activate to sort column ascending"
                                                style="width: 100px;">Tanggal Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Validasi: activate to sort column ascending"
                                                style="width: 100px;">Tanggal Validasi</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jumlah Request: activate to sort column ascending"
                                                style="width: 50px;">Jumlah Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Unit: activate to sort column ascending"
                                                style="width: 50px;">Unit</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Status: activate to sort column ascending"
                                                style="width: 50px;">Status</th>
                                        </tr>
                                    </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $request->barangga->kodebarang }}</td>
                    <td>{{ $request->barangga->namabarang }}</td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($request->tanggal_request)) }}</td>
                    <td class="text-center">{{ $request->validation ? date('d/m/Y', strtotime($request->validation_id->created_at)) : '-' }}</td>
                    <td class="text-center">{{ $request->quantity }}</td>
                    <td class="text-center">{{ $request->unit->namaunit }}</td>
                    <td class="text-center">
                        @if($request->status == 'pending')
                            <span class="badge badge-secondary">Pending</span>
                        @elseif($request->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($request->status == 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            {{ $request->status }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $requests->links() }}
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
