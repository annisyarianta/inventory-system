<!-- resources/views/requestatk/index.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Request ATK</h1>
    <a href="{{ url('/requests/create') }}" class="btn btn-primary mb-3">Tambah Request ATK</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Request</th>
                <th>Tanggal ACC</th>
                <th>Jumlah ATK</th>
                <th>Unit</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->barangga->kodebarang }}</td>
                    <td>{{ $request->barangga->namabarang }}</td>
                    <td>{{ $request->tanggal_request }}</td>
                    <td>{{ $request->validation ? $request->validation->tanggal_validasi : '-' }}</td>
                    <td>{{ $request->quantity }}</td>
                    <td>{{ $request->unit->namaunit }}</td>
                    <td>{{ $request->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $requests->links() }}
</div>
@endsection
