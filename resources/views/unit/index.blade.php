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
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Unit</h1>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <a type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#unitModal">
                <span class="text">Tambah Unit</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc text-center" tabindex="0" aria-controls="dataTable"
                                            rowspan="1" colspan="1"
                                            aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                            style="width: 10px;">No.</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Unit: activate to sort column ascending"
                                            style="width: 150px;">Unit</th>
                                        <th class="text-center"
                                            style="width: 50px;">Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no=0; ?>
                                @foreach ($unit as $unt) <?php $no++; ?>
                                <tr>
                                    <td scope="row" class="text-center"><?= $no; ?></td>
                                    {{-- <td><a href="/lokasi/{{$lokasi->id}}/list">{{$lokasi->NamaLokasi}}</a></td> --}}
                                    <td>{{$unt->namaunit}}</td>
                                    <td class="text-center">
                                        <button type="button" data-toggle="modal" data-target="#editunit"
                                            data-namaunit="{{$unt->namaunit}}" data-id="{{$unt->id}}"
                                            class="btn btn-warning btn-circle btn-sm mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <a href="/unit/{{$unt->id}}/delete" class="btn btn-danger btn-circle btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus {{$unt->namaunit}}? ')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
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
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Edit Unit</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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