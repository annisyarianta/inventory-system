@extends('layouts.master')
@section('content')

<!-- MAIN -->

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Edit ATK Keluar</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit ATK Keluar</h6>
        </div>
        <div class="card-body">
                <form id="aksi" action="/keluarga/{{$barangkeluar->id}}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="barangga_id">Nama ATK</label>
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
                        <label for="tanggalkeluar">Tanggal ATK Keluar</label>
                            <input name="tanggalkeluar" type="date" class="form-control" id="tanggalkeluar" value="{{$barangkeluar->tanggalkeluar}}">
                        @if ($errors->has('tanggalkeluar'))
                        <span class="help-block">{{$errors->first('tanggalkeluar')}}</span>
                        @endif
                    </div>
    
                    <div class="form-group{{$errors->has('jumlahkeluar') ? ' has-error ' : ''}}">
                        <label for="jumlahkeluar">Jumlah ATK Keluar</label>
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