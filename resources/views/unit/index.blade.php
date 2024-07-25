@extends('layouts.master')
{{-- @section('cari')
<form class="navbar-form navbar-left">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/masukga">
        <input id="tanggalawalmasuk" name="tanggalawalmasuk" class="form-control mr-sm-2" type="search" placeholder="Tanggal Awal"
            aria-label="Search">
        <input id="tanggalakhirmasuk" name="tanggalakhirmasuk" class="form-control mr-sm-2" type="search" placeholder="Tanggal Akhir"
            aria-label="Search">
        <button class="btn btn-primary" type="submit">Filter</button>
    </form>
</form>
@endsection --}}
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
                <h3 class="panel-title">UNIT</h3>
                <div class="right">
                    <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#unitModal">Tambah Unit</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Unit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $no=0; ?>
                    @foreach ($unit as $unt) <?php $no++; ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        {{-- <td><a href="/lokasi/{{$lokasi->id}}/list">{{$lokasi->NamaLokasi}}</a></td> --}}
                        <td>{{$unt->namaunit}}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#editunit"
                                data-namaunit="{{$unt->namaunit}}" data-id="{{$unt->id}}"
                                class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button>
                            <a href="/unit/{{$unt->id}}/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus {{$unt->namaunit}}? ')"><i
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
<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Tambah Unit</h3>
            </div>

            <form action="/unit/create" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaunit">Unit</label>
                        <input name="namaunit" type="text" class="form-control" id="namaunit"
                            placeholder="Unit">
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
<div class="modal fade" id="editunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Edit Unit</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form id="aksi" action="" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaunit">Unit</label>
                        <input id="namaunit" name="namaunit" type="text" class="form-control" value="">
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