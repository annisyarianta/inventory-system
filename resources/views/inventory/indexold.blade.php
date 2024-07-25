@extends('layouts.master')
@section('content1')
@if (session('sukses'))
<div class="alert alert-success" role="alert">
    {{session('sukses')}}
</div>
@endif

<div class="row">
    <div class="col">
        <h1>Inventory Barang</h1>
    </div>

    <div class="col align-self-center">
        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
            data-target="#exampleModal">
            Tambah Inventory
        </button>
    </div>

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
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no=0; ?>
            @foreach ($inventory_barang as $barang) <?php $no++; ?>
            <tr>
                <th scope="row"><?= $no; ?></th>
                <td>{{$barang->nama}}</td>
                <td>{{$barang->ok}}</td>
                <td>{{$barang->us}}</td>
                <td>{{$barang->ok + $barang->us}}</td>
                <td>{{$barang->gudang}}</td>
                <td>{{$barang->keterangan}}</td>
                <td>{{$barang->gambar}}</td>
                <td>
                    <a href="/inventory/{{$barang->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/inventory/{{$barang->id}}/delete" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus {{$barang->nama}}?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/inventory/create" method="POST">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Barang">
                    </div>

                    <div class="form-group">
                        <label for="ok">OK</label>
                        <input name="ok" type="number" class="form-control" id="ok" placeholder="Jumlah OK">
                    </div>

                    <div class="form-group">
                        <label for="us">U/S</label>
                        <input name="us" type="number" class="form-control" id="us" placeholder="Jumlah U/S">
                    </div>

                    <div class="form-group">
                        <label for="gudang">Lokasi Penyimpanan Barang</label>
                        <select name="gudang" class="form-control" id="gudang">
                            <option value="Ruang Server">Ruang Server</option>
                            <option value="Gudang Kedatangan">Gudang Kedatangan</option>
                            <option value="Gudang Bersama">Gudang Bersama</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input name="keterangan" type="text" class="form-control" id="keterangan"
                            placeholder="Keterangan">
                        <small>*Boleh kosong</small>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input name="gambar" type="file" class="form-control-file" id="gambar">
                        <small>*Upload gambar jika ada</small>
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
{{-- END MODAL --}}
@endsection