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
                <form action="/inventory/{{$barang->id}}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('nama') ? ' has-error ' : ''}}">
                        <label for="nama">Nama Barang</label>
                        <input name="nama" type="text" class="form-control" id="nama" value="{{$barang->nama}}">
                        @if ($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('ok') ? ' has-error ' : ''}}">
                        <label for="ok">OK</label>
                        <input name="ok" type="number" class="form-control" id="ok" value="{{$barang->ok}}">
                        @if ($errors->has('ok'))
                        <span class="help-block">{{$errors->first('ok')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('us') ? ' has-error ' : ''}}">
                        <label for="us">U/S</label>
                        <input name="us" type="number" class="form-control" id="us" value="{{$barang->us}}">
                        @if ($errors->has('us'))
                        <span class="help-block">{{$errors->first('us')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="lokasi_id">Lokasi Penyimpanan Barang</label>
                        <select name="lokasi_id" class="form-control" id="lokasi_id">
                            @foreach ($lokasi_barang as $lokasi)
                            <option value="{{$lokasi->id}}" @if ($barang->lokasi_id == $lokasi->id)
                                selected
                                @endif>
                                {{$lokasi->NamaLokasi}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input name="keterangan" type="text" class="form-control" id="keterangan"
                            value="{{$barang->keterangan}}">
                        <small>*Boleh kosong</small>
                    </div>

                    <div class="form-group{{$errors->has('gambar') ? ' has-error ' : ''}}">
                        <label for="gambar">Gambar</label>
                        <input name="gambar" type="file" class="form-control-file" id="gambar">
                        @if ($errors->has('gambar'))
                        <span class="help-block">{{$errors->first('gambar')}}</span>
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