@extends('layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Edit ATK Masuk</h1>
        <br>
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit ATK Masuk</h6>
            </div>
            <div class="card-body">
                <form id="aksi" action="/atkmasuk/{{ $barangmasuk->id }}/update" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="masteratk_id" class="col-sm-2 col-form-label">Nama ATK</label>
                            <div class="col-sm-10">
                                <div class="searchable-dropdown">
                                    <input type="text" id="search" placeholder="-- Pilih ATK --" onkeyup="filterFunction()" class="form-control">
                                    <div id="dropdownList" class="dropdown-content">
                                        <a href="#" onclick="selectOption('', '-- Pilih ATK --')"></a>
                                        @foreach ($masteratk as $brg)
                                            <a href="#" onclick="selectOption('{{ $brg->id }}', '{{ $brg->namabarang }}')">
                                                {{ $brg->namabarang }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="masteratk_id" id="masteratk_id">
                                </div>
                                {{-- <select name="masteratk_id" class="form-control" id="masteratk_id">
                                    @foreach ($masteratk as $brg)
                                        <option value="{{ $brg->id }}"
                                            @if ($barangmasuk->masteratk_id == $brg->id) selected @endif>
                                            {{ $brg->namabarang }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggalmasuk" class="col-sm-2 col-form-label">Tanggal ATK Masuk</label>
                            <div class="col-sm-10">
                                <input name="tanggalmasuk" type="date" class="form-control" id="tanggalmasuk"
                                    value="{{ $barangmasuk->tanggalmasuk }}">
                                @if ($errors->has('tanggalmasuk'))
                                    <span class="help-block">{{ $errors->first('tanggalmasuk') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlahmasuk" class="col-sm-2 col-form-label">Jumlah ATK Masuk</label>
                            <div class="col-sm-10">
                                <input name="jumlahmasuk" type="number" class="form-control" id="jumlahmasuk"
                                    value="{{ $barangmasuk->jumlahmasuk }}">
                                @if ($errors->has('jumlahmasuk'))
                                    <span class="help-block">{{ $errors->first('jumlahmasuk') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hargasatuan" class="col-sm-2 col-form-label">Harga Satuan</label>
                            <div class="col-sm-10">
                                <input name="hargasatuan" type="number" class="form-control" id="hargasatuan"
                                    value="{{ $barangmasuk->hargasatuan }}">
                                @if ($errors->has('hargasatuan'))
                                    <span class="help-block">{{ $errors->first('hargasatuan') }}</span>
                                @endif
                            </div>
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
