<!-- resources/views/requestatk/index.blade.php -->

@extends('layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Request ATK</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="{{ url('/requests/create') }}" class="btn btn-primary btn-sm">Tambah Request</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting text-xl-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Kode Barang: activate to sort column ascending"
                                                style="width: 40px;">Kode Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Nama Barang: activate to sort column ascending"
                                                style="width: 150px;">Nama Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Request: activate to sort column ascending"
                                                style="width: 70px;">Tanggal Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal ACC: activate to sort column ascending"
                                                style="width: 70px;">Tanggal ACC</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jumlah Request: activate to sort column ascending" style="width: 50px;">
                                                Jumlah Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Unit: activate to sort column ascending" style="width: 30px;">
                                                Unit</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Status: activate to sort column ascending" style="width: 30px;">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr>
                                                <td>{{ $request->barangga->kodebarang }}</td>
                                                <td>{{ $request->barangga->namabarang }}</td>
                                                <td>{{ $request->tanggal_request }}</td>
                                                <td>{{ $request->validation ? $request->validation->tanggal_validasi : '-' }}
                                                </td>
                                                <td>{{ $request->quantity }}</td>
                                                <td>{{ $request->unit->namaunit }}</td>
                                                <td>{{ $request->status }}</td>
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
