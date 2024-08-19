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
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Edit Master Data</h1>
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Master Data</h6>
            </div>
            <div class="card-body">
                <form id="aksi" action="/barangga/{{ $barang->id }}/update" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row{{ $errors->has('namabarang') ? ' has-error ' : '' }}">
                        <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input name="namabarang" type="text" class="form-control" id="namabarang"
                                value="{{ $barang->namabarang }}">
                            @if ($errors->has('namabarang'))
                                <span class="help-block">{{ $errors->first('namabarang') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('kodebarang') ? ' has-error ' : '' }}">
                        <label for="kodebarang" class="col-sm-2 col-form-label">Kode ATK</label>
                        <div class="col-sm-10">
                            <input name="kodebarang" type="text" class="form-control" id="kodebarang"
                                value="{{ $barang->kodebarang }}">
                            @if ($errors->has('kodebarang'))
                                <span class="help-block">{{ $errors->first('kodebarang') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('jenisbarang') ? ' has-error ' : '' }}">
                        <label for="jenisbarang" class="col-sm-2 col-form-label">Jenis ATK</label>
                        <div class="col-sm-10">
                            <select name="jenisbarang" class="form-control" id="jenisbarang">
                                <option value="">Pilih Jenis ATK</option>
                                <option value="Habis Pakai" {{ $barang->jenisbarang == 'Habis Pakai' ? 'selected' : '' }}>
                                    Habis Pakai</option>
                                <option value="Tidak Habis Pakai"
                                    {{ $barang->jenisbarang == 'Tidak Habis Pakai' ? 'selected' : '' }}>Tidak Habis Pakai
                                </option>
                            </select>
                            @if ($errors->has('jenisbarang'))
                                <span class="help-block">{{ $errors->first('jenisbarang') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('satuan') ? ' has-error ' : '' }}">
                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <input name="satuan" type="text" class="form-control" id="satuan"
                                value="{{ $barang->satuan }}">
                            @if ($errors->has('satuan'))
                                <span class="help-block">{{ $errors->first('satuan') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('gambar') ? ' has-error ' : '' }}">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input name="gambar" type="file" class="form-control-file" id="gambar"
                                value="{{ $barang->gambar }}">
                            @if ($errors->has('gambar'))
                                <span class="help-block">{{ $errors->first('gambar') }}</span>
                            @endif
                            <small>Upload gambar jika ada (.jpg, *.jpeg, *.png), up to 2 MB</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-warning btn-icon-split btn-sm"><span
                                class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Update</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection