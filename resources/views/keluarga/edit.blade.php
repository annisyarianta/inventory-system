@extends('layouts.master')
@section('content')

<!-- MAIN -->

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h2>Edit Barang Keluar</h2>
            </div>
            <div class="panel-body">
                <form id="aksi" action="/keluarga/{{$barangkeluar->id}}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="barangga_id">Nama Barang</label>
                        <select name="barangga_id" class="form-control" id="barangga_id">
                            @foreach ($barangga as $brg)
                            <option value="{{$brg->id}}" @if ($barangkeluar->barangga_id == $brg->id)
                                selected
                                @endif>
                                {{$brg->namabarang}}
                            </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group{{$errors->has('tanggalkeluar') ? ' has-error ' : ''}}">
                        <label for="tanggalkeluar">Tanggal Barang Keluar</label>
                            <input name="tanggalkeluar" type="text" class="form-control" id="tanggalkeluar" value="{{$barangkeluar->tanggalkeluar}}">
                        @if ($errors->has('tanggalkeluar'))
                        <span class="help-block">{{$errors->first('tanggalkeluar')}}</span>
                        @endif
                    </div>
    
                    <div class="form-group{{$errors->has('jumlahkeluar') ? ' has-error ' : ''}}">
                        <label for="jumlahkeluar">Jumlah Barang Keluar</label>
                        <input name="jumlahkeluar" type="number" class="form-control" id="jumlahkeluar" value="{{$barangkeluar->jumlahkeluar}}">
                        @if ($errors->has('jumlahkeluar'))
                        <span class="help-block">{{$errors->first('jumlahkeluar')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" class="form-control" id="unit">
                            @foreach ($unit as $unt)
                            <option value="{{$unt->id}}" @if ($barangkeluar->unit_id == $unt->id)
                                selected
                                @endif>
                                {{$unt->namaunit}}
                            </option>
                            @endforeach
                        </select>
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