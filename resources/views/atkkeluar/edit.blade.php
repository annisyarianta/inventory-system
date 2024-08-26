@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Edit Barang Keluar</h1>
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Barang Keluar</h6>
            </div>
            <div class="card-body">
                <form id="aksi" action="/atkkeluar/{{ $barangkeluar->id }}/update" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="masteratk_id" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <select name="masteratk_id" class="form-control" id="masteratk_id">
                                @foreach ($masteratk as $brg)
                                    <option value="{{ $brg->id }}" @if ($barangkeluar->masteratk_id == $brg->id) selected @endif>
                                        {{ $brg->namabarang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('tanggalkeluar') ? ' has-error ' : '' }}">
                        <label for="tanggalkeluar" class="col-sm-2 col-form-label">Tanggal Barang Keluar</label>
                        <div class="col-sm-10">
                            <input name="tanggalkeluar" type="date" class="form-control" id="tanggalkeluar"
                                value="{{ $barangkeluar->tanggalkeluar }}">
                            @if ($errors->has('tanggalkeluar'))
                                <span class="help-block">{{ $errors->first('tanggalkeluar') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('jumlahkeluar') ? ' has-error ' : '' }}">
                        <label for="jumlahkeluar" class="col-sm-2 col-form-label">Jumlah Barang Keluar</label>
                        <div class="col-sm-10">
                            <input name="jumlahkeluar" type="number" class="form-control" id="jumlahkeluar"
                                value="{{ $barangkeluar->jumlahkeluar }}">
                            @if ($errors->has('jumlahkeluar'))
                                <span class="help-block">{{ $errors->first('jumlahkeluar') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <select name="unit" class="form-control" id="unit">
                                @foreach ($unit as $unt)
                                    <option value="{{ $unt->id }}" @if ($barangkeluar->unit_id == $unt->id) selected @endif>
                                        {{ $unt->namaunit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-warning btn-icon-split btn-sm"><span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Update</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection