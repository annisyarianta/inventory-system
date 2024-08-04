@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <form action="/inventory/{{$barang->id}}/update" method="POST">
            {{csrf_field()}}
            <h1>Edit Data Inventory</h1>
            <div class="form-group">
                <label for="nama">Nama ATK</label>
                <input name="nama" type="text" class="form-control" id="nama" value="{{$barang->nama}}">
            </div>

            <div class="form-group">
                <label for="ok">OK</label>
                <input name="ok" type="number" class="form-control" id="ok" value="{{$barang->ok}}">
            </div>

            <div class="form-group">
                <label for="us">U/S</label>
                <input name="us" type="number" class="form-control" id="us" value="{{$barang->us}}">
            </div>

            <div class="form-group">
                <label for="gudang">Lokasi Penyimpanan ATK</label>
                <select name="gudang" class="form-control" id="gudang">
                    <option value="Ruang Server" @if ($barang->gudang == "Ruang Server") selected @endif>Ruang Server
                    </option>
                    <option value="Gudang Kedatangan" @if ($barang->gudang == "Gudang Kedatangan") selected
                        @endif>Gudang Kedatangan</option>
                    <option value="Gudang Bersama" @if ($barang->gudang == "Gudang Bersama") selected @endif>Gudang
                        Bersama</option>
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input name="keterangan" type="text" class="form-control" id="keterangan"
                    value="{{$barang->keterangan}}">
                <small>*Boleh kosong</small>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input name="gambar" type="file" class="form-control-file" id="gambar">
                <small>*Upload gambar jika ada</small>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>
@endsection