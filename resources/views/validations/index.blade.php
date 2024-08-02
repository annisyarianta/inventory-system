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

<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Validasi Barang</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc text-center" tabindex="0"
                                                aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                                style="width: 10px;">No.</th>
                                            <th class="sorting text-xl-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Kode Barang: activate to sort column ascending"
                                                style="width: 40px;">Kode Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Nama Barang: activate to sort column ascending"
                                                style="width: 200px;">Nama Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jumlah Request: activate to sort column ascending"
                                                style="width: 200px;">Jumlah Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Unit: activate to sort column ascending"
                                                style="width: 200px;">Unit</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Request: activate to sort column ascending"
                                                style="width: 200px;">Tanggal Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Keterangan: activate to sort column ascending"
                                                style="width: 200px;">Keterangan</th>
                                            <th class="text-center" style="width: 62.2px;">Aksi</th>
                                        </tr>
                                    </thead>
        <tbody>
            @foreach($validations as $validation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $validation->requestmodel ? $validation->requestmodel->barangga->kodebarang : '-' }}</td>
                    <td>{{ $validation->requestmodel ? $validation->requestmodel->barangga->namabarang : '-' }}</td>
                    <td>{{ $validation->requestmodel ? (is_numeric($validation->requestmodel->quantity) ? (int) $validation->requestmodel->quantity : '-') : '-' }}</td>
                    <td>{{ $validation->requestmodel ? $validation->requestmodel->unit->namaunit : '-' }}</td>
                    <td>{{ $validation->requestmodel ? $validation->requestmodel->tanggal_request : '-' }}</td>
                    <td>{{ $validation->requestmodel ? $validation->requestmodel->status : '-'  }}</td>
                    <td>
                        @if($validation->status == 'pending')
                            <form action="{{ route('validations.update', $validation->id) }}" method="POST" id="form-{{ $validation->id }}">                            
                                @csrf
                                @method('PUT')
                                <button type="button" onclick="submitForm('approved', {{ $validation->id }})" class="btn btn-success">ACC</button>
                                <button type="button" onclick="submitForm('rejected', {{ $validation->id }})" class="btn btn-danger">Tolak</button>
                                <button type="button" onclick="showKurangiModal({{ $validation->id }}, {{ $validation->requestmodel->quantity }})" class="btn btn-warning">Edit</button>
                            </form>
                        @else
                            <span>Status: {{ ucfirst($validation->status) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $validations->links() }}
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal untuk Form Kurangi -->
<div class="modal fade" id="modalKurangi" tabindex="-1" role="dialog" aria-labelledby="modalKurangiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKurangiLabel">Kurangi Jumlah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formKurangi" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="quantity">Jumlah yang Disetujui</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
          </div>
          <input type="hidden" name="status" value="modified">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
    function submitForm(status, id) {
        var form = document.getElementById('form-' + id);
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'status';
        input.value = status;
        form.appendChild(input);
        
        form.submit();
    }

    function showKurangiModal(id, quantity) {
    // Set form action
    var formKurangi = document.getElementById('formKurangi');
    formKurangi.action = "/validations/" + id;

    // Set the initial quantity value
    document.getElementById('quantity').value = quantity;

    // Show modal
    $('#modalKurangi').modal('show');
}

</script>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection
