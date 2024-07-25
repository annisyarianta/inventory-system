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
                <h3 class="panel-title">INVENTORY BARANG</h3>
                <div class="right">
                    <a href="/lokasi/{{$lokasi->id}}/exportpdfid" class="btn btn-danger btn-sm">Export PDF</a>
                    <a href="/lokasi/{{$lokasi->id}}/exportexcelid" class="btn btn-success btn-sm">Export Excel</a>
                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i
                            class="lnr lnr-plus-circle"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>OK</th>
                            <th>U/S</th>
                            <th>Jumlah</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $no=0; ?>
                    @foreach ($lokasi->inventory as $barang) <?php $no++; ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                        <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                                data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                        </td>
                        <td>{{$barang->ok}}</td>
                        <td>{{$barang->us}}</td>
                        <td>{{$barang->ok + $barang->us}}</td>
                        <td>{{$lokasi->NamaLokasi}}</td>
                        <td>{{$barang->keterangan}}</td>
                        <td>
                            <a href="/inventory/{{$barang->id}}/edit" class="btn btn-warning btn-sm"><i
                                    class="lnr lnr-pencil"></i></a>
                            <a href="/inventory/{{$barang->id}}/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus {{$barang->nama}}?')"><i
                                    class="lnr lnr-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


{{-- Modal Gambar --}}
<div class="modal fade" id="modalgambar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="NamaBarang"></h3>
            </div>
            <div class="modal-body text-center">
                <img id="previewgambar" src="" class="rounded" style="max-width: 550px; max-height: 400px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Gambar --}}

{{-- Modal Form --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Tambah Data Inventory</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="/inventory/create" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group{{$errors->has('nama') ? ' has-error ' : ''}}">
                        <label for="nama">Nama Barang</label>
                        <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Barang"
                            value="{{old('nama')}}">
                        @if ($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('ok') ? ' has-error ' : ''}}">
                        <label for="ok">OK</label>
                        <input name="ok" type="number" class="form-control" id="ok" placeholder="Jumlah OK"
                            value="{{old('ok')}}">
                        @if ($errors->has('ok'))
                        <span class="help-block">{{$errors->first('ok')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('us') ? ' has-error ' : ''}}">
                        <label for="us">U/S</label>
                        <input name="us" type="number" class="form-control" id="us" placeholder="Jumlah U/S"
                            value="{{old('us')}}">
                        @if ($errors->has('us'))
                        <span class="help-block">{{$errors->first('us')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('gudang') ? ' has-error ' : ''}}">
                        <label for="gudang">Lokasi Penyimpanan Barang</label>
                        <select name="gudang" class="form-control" id="gudang">
                            @foreach ($lokasi_barang as $lokasi)
                            <option value="{{$lokasi->NamaLokasi}}"
                                {{(old('gudang') == $lokasi->NamaLokasi) ? ' selected ' : ''}}>{{$lokasi->NamaLokasi}}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('gudang'))
                        <span class="help-block">{{$errors->first('gudang')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input name="keterangan" type="text" class="form-control" id="keterangan"
                            placeholder="Keterangan" value="{{old('keterangan')}}">
                        <small>*Boleh kosong</small>
                    </div>

                    <div class="form-group{{$errors->has('gambar') ? ' has-error ' : ''}}">
                        <label for="gambar">Gambar</label>
                        <input name="gambar" type="file" class="form-control-file" id="gambar"
                            value="{{old('gambar')}}">
                        @if ($errors->has('gambar'))
                        <span class="help-block">{{$errors->first('gambar')}}</span>
                        @endif
                        <small>*Upload gambar jika ada (*.jpg, *.jpeg, *.png)</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Form --}}

@endsection