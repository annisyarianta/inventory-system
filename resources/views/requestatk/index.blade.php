@extends('layouts.master')

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('sukses') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @endif

    @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('gagal') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    @endif

    <div class="container-fluid">
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Request ATK</h1>
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="#" class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#cetakba">
                    <span class="text">Cetak BA</span>
                </a>
                <a href="{{ url('/requests/create') }}" class="btn btn-primary btn-sm">Tambah Request ATK</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc text-center" style="width: 10px;">No.</th>
                                            <th class="sorting text-center" style="width: 40px;">Kode ATK</th>
                                            <th class="sorting text-center" style="width: 200px;">Nama ATK</th>
                                            <th class="sorting text-center" style="width: 100px;">Tanggal Request</th>
                                            <th class="sorting text-center" style="width: 50px;">Jumlah Request</th>
                                            <th class="sorting text-center" style="width: 50px;">Unit</th>
                                            <th class="sorting text-center" style="width: 50px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requests as $request)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $request->masteratk->kodebarang }}</td>
                                                <td>{{ $request->masteratk->namabarang }}</td>
                                                <td class="text-center">{{ date('d/m/Y', strtotime($request->tanggal_request)) }}</td>
                                                <td class="text-center">{{ $request->quantity }}</td>
                                                <td class="text-center">{{ $request->unit->namaunit }}</td>
                                                <td class="text-center">
                                                    @if ($request->status == 'pending')
                                                        <span class="badge badge-secondary">Pending</span>
                                                    @elseif($request->status == 'approved')
                                                        <span class="badge badge-success">Approved</span>
                                                    @elseif($request->status == 'rejected')
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @else
                                                        {{ $request->status }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $requests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cetak BA --}}
    <div class="modal fade" id="cetakba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="exampleModalLabel">Cetak Berita Acara</h3>
                </div>

                <form action="/atkkeluar/exportpdfba" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggalba">Tanggal Berita Acara</label>
                            <input name="tanggalba" type="date" class="form-control" id="tanggalba" value="{{ old('tanggalba') }}">
                        </div>

                        <div class="form-group">
                            <label for="referensi">Referensi</label>
                            <input name="referensi" type="text" class="form-control" id="referensi" placeholder="No. Nota Dinas" value="{{ old('referensi') }}">
                        </div>

                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit" class="form-control" id="unit">
                                @if(isset($unit) && count($unit) > 0)
                                    @foreach ($unit as $unt)
                                        <option value="{{ $unt->id }}" {{ old('unit_id') == $unt->id ? 'selected' : '' }}>
                                            {{ $unt->namaunit }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="diketahui">Diketahui</label>
                            <input name="diketahui" type="text" class="form-control" id="diketahui" placeholder="Diketahui Oleh..." value="{{ old('diketahui') }}">
                        </div>

                        <div class="form-group">
                            <label for="penerima">Penerima</label>
                            <input name="penerima" type="text" class="form-control" id="penerima" placeholder="Penerima" value="{{ old('penerima') }}">
                        </div>

                        <div class="form-group">
                            <label for="jabatanpenerima">Jabatan Penerima</label>
                            <input name="jabatanpenerima" type="text" class="form-control" id="jabatanpenerima" placeholder="Jabatan Penerima" value="{{ old('jabatanpenerima') }}">
                        </div>

                        <div class="form-group{{ $errors->has('tanggalbaawal') ? ' has-error ' : '' }}">
                            <label for="tanggalbaawal">Periode Barang Keluar</label>
                            <input name="tanggalbaawal" type="date" class="form-control" id="tanggalbaawal" value="{{ old('tanggalbaawal') }}">
                            @if ($errors->has('tanggalbaawal'))
                                <span class="help-block">*Kolom ini harus diisi</span>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Cetak BA --}}
@endsection
