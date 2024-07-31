<!-- resources/views/validasiatk/index.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Validasi ATK</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Request</th>
                <th>Unit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($validations as $validation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $validation->request->barangga->kodebarang }}</td>
                    <td>{{ $validation->request->barangga->namabarang }}</td>
                    <td>{{ $validation->request->quantity }}</td>
                    <td>{{ $validation->request->unit->namaunit }}</td>
                    <td>
                        <form action="{{ url('/validasiatk/' . $validation->id . '/validate') }}" method="POST">
                            @csrf
                            <button type="submit" name="status" value="approved" class="btn btn-success">ACC</button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger">Tolak</button>
                            <button type="submit" name="status" value="modified" class="btn btn-warning">Kurangi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $validations->links() }}
</div>
@endsection
