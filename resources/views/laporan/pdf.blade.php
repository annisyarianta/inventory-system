@extends('layouts.master')
@section('content')
@if (session('sukses'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{session('sukses')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
@endif
@if (session('gagal'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {{session('gagal')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h2>Laporan</h2>
            </div>
            <div class="panel-body">
                <form action="/laporan/exportpdflaporan" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenislaporan">Nama ATK</label>
                            <select name="jenislaporan" class="form-control" id="jenislaporan">
                                <option value="barangmasuk">ATK Masuk</option>
                                <option value="barangkeluar">ATK Keluar</option>
                            </select>
                        </div>
    
                        <div class="form-group{{$errors->has('tanggalawal') ? ' has-error ' : ''}}">
                            <label for="tanggalawal">Tanggal Awal</label>
                                <input name="tanggalawal" type="text" class="form-control" id="tanggalawal"
                                    placeholder="Tanggal Awal" value="{{old('tanggalawal')}}">
                            @if ($errors->has('tanggalawal'))
                            <span class="help-block">*Kolom ini harus diisi</span>
                            @endif
                        </div>
    
                        <div class="form-group{{$errors->has('tanggalakhir') ? ' has-error ' : ''}}">
                            <label for="tanggalakhir">Tanggal Akhir</label>
                            <input name="tanggalakhir" type="text" class="form-control" id="tanggalakhir" placeholder="Tanggal Akhir"
                                value="{{old('tanggalakhir')}}">
                            @if ($errors->has('tanggalakhir'))
                            <span class="help-block">*Kolom ini harus diisi</span>
                            @endif
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection