@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h1 class="h2 mb-2 text-gray-800" style="font-weight: 600">Buat Request ATK</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('requests.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="barangga_id">Barang</label>
                        <select name="barangga_id" id="barangga_id" class="form-control">
                            @foreach ($barangga as $item)
                                <option value="{{ $item->id }}">{{ $item->kodebarang }} - {{ $item->namabarang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_request">Tanggal Request</label>
                        <input type="date" name="tanggal_request" id="tanggal_request" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="unit_id">Unit</label>
                        <select name="unit_id" id="unit_id" class="form-control">
                            @foreach ($unit as $item)
                                <option value="{{ $item->id }}">{{ $item->namaunit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Jumlah Request</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
