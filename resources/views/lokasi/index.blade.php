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
                <h3 class="panel-title">LOKASI PENYIMPANAN</h3>
                <div class="right">
                    <button type="button" class="btn" data-toggle="modal" data-target="#lokasiModal"><i
                            class="lnr lnr-plus-circle"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Lokasi Penyimpanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $no=0; ?>
                    @foreach ($lokasi_barang as $lokasi) <?php $no++; ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        {{-- <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                        data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                        </td> --}}
                        <td><a href="/lokasi/{{$lokasi->id}}/list">{{$lokasi->NamaLokasi}}</a></td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#editmodal"
                                data-lokasi="{{$lokasi->NamaLokasi}}" data-id="{{$lokasi->id}}"
                                class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button>
                            <a href="/lokasi/{{$lokasi->id}}/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus {{$lokasi->NamaLokasi}}? Pastikan tidak ada barang di dalam lokasi tersebut!')"><i
                                    class="lnr lnr-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


{{-- Modal Form TAMBAH --}}
<div class="modal fade" id="lokasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Tambah Lokasi Penyimpanan</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="/lokasi/create" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="NamaLokasi">Lokasi Penyimpanan</label>
                        <input name="NamaLokasi" type="text" class="form-control" id="NamaLokasi"
                            placeholder="Lokasi Penyimpanan">
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
{{-- End Modal Form TAMBAH --}}

{{-- Modal Form EDIT --}}
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Edit Lokasi Penyimpanan</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form id="aksi" action="/lokasi/{{$lokasi->id}}/update" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="NamaLokasi">Lokasi Penyimpanan</label>
                        <input id="NamaLokasi" name="NamaLokasi" type="text" class="form-control" id="NamaLokasi"
                            value="">
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
{{-- End Modal Form EDIT --}}

@endsection