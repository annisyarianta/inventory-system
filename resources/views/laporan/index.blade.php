@extends('layouts.master')
@section('content')
    @if (session('sukses'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('sukses') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('gagal') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Cetak Laporan Transaksi</h1>
        <br>
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Cetak Laporan</h6>
            </div>
            <div class="card-body">
                <!-- Tambahkan id ke form untuk mempermudah manipulasi JavaScript -->
                <form id="formCetakLaporan" action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="jenislaporan" class="col-sm-2 col-form-label">Jenis Laporan</label>
                            <div class="col-sm-10">
                                <select name="jenislaporan" class="form-control" id="jenislaporan">
                                    <option value="">-- Pilih Jenis Laporan --</option>
                                    <option value="barangmasuk">Barang Masuk</option>
                                    <option value="barangkeluar">Barang Keluar</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('tanggalawal') ? ' has-error ' : '' }}">
                            <label for="tanggalawal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-10">
                                <input name="tanggalawal" type="date" class="form-control" id="tanggalawal"
                                    placeholder="Tanggal Awal" value="{{ old('tanggalawal') }}">
                                @if ($errors->has('tanggalawal'))
                                    <span class="help-block">*Kolom ini harus diisi</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('tanggalakhir') ? ' has-error ' : '' }}">
                            <label for="tanggalakhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-10">
                                <input name="tanggalakhir" type="date" class="form-control" id="tanggalakhir"
                                    placeholder="Tanggal Akhir" value="{{ old('tanggalakhir') }}">
                                @if ($errors->has('tanggalakhir'))
                                    <span class="help-block">*Kolom ini harus diisi</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="formatdokumen" class="col-sm-2 col-form-label">Format Dokumen</label>
                            <div class="col-sm-10">
                                <select name="formatdokumen" class="form-control" id="formatdokumen"
                                    onchange="updateFormAction()">
                                    <option value="">-- Pilih Format Dokumen --</option>
                                    <option value="excel">Excel</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">Cetak Laporan</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function updateFormAction() {
            var format = document.getElementById('formatdokumen').value;
            var form = document.getElementById('formCetakLaporan');

            if (format === 'excel') {
                form.action = '/laporan/exportexcellaporan';
            } else if (format === 'pdf') {
                form.action = '/laporan/exportpdflaporan';
            } else {
                form.action = ''; // Set default atau kosong jika tidak ada format yang dipilih
            }
        }
    </script>
@endsection
