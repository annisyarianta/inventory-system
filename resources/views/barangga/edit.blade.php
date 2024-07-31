@extends('layouts.master')
@section('content')
    <!-- MAIN -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h2>Edit Data Inventory</h2>
                </div>
                <div class="panel-body">
                    <form action="/barangga/{{ $barang->id }}/update" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('namabarang') ? ' has-error ' : '' }}">
                            <label for="namabarang">Nama Barang</label>
                            <input name="namabarang" type="text" class="form-control" id="namabarang"
                                value="{{ $barang->namabarang }}">
                            @if ($errors->has('namabarang'))
                                <span class="help-block">{{ $errors->first('namabarang') }}</span>
                            @endif
                        </div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h2>Edit Data Inventory</h2>
            </div>
            <div class="panel-body">
                <form action="/barangga/{{$barang->id}}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('kodebarang') ? ' has-error ' : ''}}">
                        <label for="kodebarang">Kode Barang</label>
                        <input name="kodebarang" type="text" class="form-control" id="kodebarang" value="{{$barang->kodebarang}}">
                        @if ($errors->has('kodebarang'))
                        <span class="help-block">{{$errors->first('kodebarang')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('namabarang') ? ' has-error ' : ''}}">
                        <label for="namabarang">Nama Barang</label>
                        <input name="namabarang" type="text" class="form-control" id="namabarang" value="{{$barang->namabarang}}">
                        @if ($errors->has('namabarang'))
                        <span class="help-block">{{$errors->first('namabarang')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('jenisbarang') ? ' has-error ' : ''}}">
                        <label for="jenisbarang">Jenis Barang</label>
                        <input name="jenisbarang" type="text" class="form-control" id="jenisbarang" value="{{$barang->jenisbarang}}">
                        @if ($errors->has('jenisbarang'))
                        <span class="help-block">{{$errors->first('jenisbarang')}}</span>
                        @endif
                    </div>

                        <div class="form-group{{ $errors->has('gambar') ? ' has-error ' : '' }}">
                            <label for="gambar">Gambar</label>
                            <input name="gambar" type="file" class="form-control-file" id="gambar">
                            @if ($errors->has('gambar'))
                                <span class="help-block">{{ $errors->first('gambar') }}</span>
                            @endif
                            <small>*Upload gambar jika ada (*.jpg, *.jpeg, *.png)</small>
                        </div>

                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- END MAIN -->
@endsection
