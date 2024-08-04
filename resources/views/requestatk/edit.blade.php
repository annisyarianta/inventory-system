@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h1 class="h2 mb-2 text-gray-800" style="font-weight: 600">Edit Request ATK</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('requests.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="barangga_id">ATK</label>
                        <select name="barangga_id" id="barangga_id" class="form-control">
                            @foreach ($barang as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $request->barangga_id ? 'selected' : '' }}>{{ $item->kodebarang }} - {{ $item->namabarang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_request">Jumlah Request</label>
                        <input type="number" name="jumlah_request" id="jumlah_request" class="form-control" value="{{ $request->jumlah_atk }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
