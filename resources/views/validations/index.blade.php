<!-- resources/views/validasiatk/index.blade.php -->

@extends('layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Validasi ATK</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h3>Validasi ATK</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
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
                                                aria-label="Jumlah Request: activate to sort column ascending"
                                                style="width: 50px;">
                                                Jumlah Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Unit: activate to sort column ascending" style="width: 30px;">
                                                Unit</th>
                                            <th class="text-center" style="width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($validations as $validation)
                                            <tr>
                                                <td>{{ $validation->request->barangga->kodebarang }}</td>
                                                <td>{{ $validation->request->barangga->namabarang }}</td>
                                                <td>{{ $validation->request->quantity }}</td>
                                                <td>{{ $validation->request->unit->namaunit }}</td>
                                                <td>
                                                    <form
                                                        action="{{ url('/validasiatk/' . $validation->id . '/validate') }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" name="status" value="approved"
                                                            class="btn btn-success">ACC</button>
                                                        <button type="submit" name="status" value="rejected"
                                                            class="btn btn-danger">Tolak</button>
                                                        <button type="submit" name="status" value="modified"
                                                            class="btn btn-warning">Kurangi</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $validations->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
