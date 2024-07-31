@extends('layouts.master')
@section('content')

<!-- MAIN -->

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h2>Edit Barang Masuk</h2>
            </div>
            <div class="panel-body">
                <form id="aksi" action="/masukga/{{$barangmasuk->id}}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="barangga_id">Nama Barang</label>
                        <select name="barangga_id" class="form-control" id="barangga_id">
                            @foreach ($barangga as $brg)
                            <option value="{{$brg->id}}" @if ($barangmasuk->barangga_id == $brg->id)
                                selected
                                @endif>
                                {{$brg->namabarang}}
                            </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group{{$errors->has('tanggalmasuk') ? ' has-error ' : ''}}">
                        <label for="tanggalmasuk">Tanggal Barang Masuk</label>
                            <input name="tanggalmasuk" type="date" class="form-control" id="tanggalmasuk" value="{{$barangmasuk->tanggalmasuk}}">
                        @if ($errors->has('tanggalmasuk'))
                        <span class="help-block">{{$errors->first('tanggalmasuk')}}</span>
                        @endif
                    </div>
    
                    <div class="form-group{{$errors->has('jumlahmasuk') ? ' has-error ' : ''}}">
                        <label for="jumlahmasuk">Jumlah Barang Masuk</label>
                        <input name="jumlahmasuk" type="number" class="form-control" id="jumlahmasuk" value="{{$barangmasuk->jumlahmasuk}}">
                        @if ($errors->has('jumlahmasuk'))
                        <span class="help-block">{{$errors->first('jumlahmasuk')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('satuan') ? ' has-error ' : ''}}">
                        <label for="satuan">Satuan</label>
                        <input name="satuan" type="text" class="form-control" id="satuan" value="{{$barangmasuk->satuan}}">
                        @if ($errors->has('satuan'))
                        <span class="help-block">{{$errors->first('satuan')}}</span>
                        @endif
                    </div>
    
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END MAIN -->

@endsection