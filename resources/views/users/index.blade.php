@extends('layouts.master')
{{-- @section('cari')
<form class="navbar-form navbar-left">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/barangga">
        <input name="carimasterdata" class="form-control mr-sm-2" type="search" placeholder="Cari Master Data"
            aria-label="Search">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</form>
@endsection --}}
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
        <h1 class="h2 mb-2 text-gray-800" style="font-weight: 600">Daftar User</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    <span class="text">Tambah Data</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc text-center" tabindex="0"
                                                aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                                style="width: 30px;">No.</th>
                                            <th class="sorting text-xl-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Nama: activate to sort column ascending" style="width: 50px;">
                                                Nama</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Email: activate to sort column ascending" style="width: 50px;">
                                                Email</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Role: activate to sort column ascending" style="width: 30px;">
                                                Role</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Created_at: activate to sort column ascending"
                                                style="width: 50px;">Created_at</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Updated_at: activate to sort column ascending"
                                                style="width: 50px;">Updated_at</th>
                                            <th class="text-center" style="width: 62.2px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = 0; ?>
                                    @foreach ($users as $user)
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?= $no ?></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                            <td class="text-center">
                                                {{-- <a href="/barangga/{{ $barang->id }}/edit" class="btn btn-warning btn-sm"><i
                                                    class="lnr lnr-pencil"></i></a> --}}
                                                <button type="button" data-toggle="modal" data-target="#editmodal"
                                                    data-name="{{ $user->name }}" data-id="{{ $user->id }}"
                                                    data-email="{{ $user->email }}" data-role="{{ $user->role }}"
                                                    data-password="{{ $user->password }}"
                                                    class="btn btn-warning btn-circle mr-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href="/users/{{ $user->id }}/delete"
                                                    class="btn btn-danger btn-circle"
                                                    onclick="return confirm('Yakin ingin menghapus {{ $user->name }}?')"><i
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

    {{-- Modal Form EDIT --}}
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="exampleModalLabel">Edit User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="aksi" action="/users/{{ $user->id }}/update" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error ' : '' }}">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control" id="name"
                                value="{{ old('name', $user->name) }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error ' : '' }}">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                value="{{ old('email', $user->email) }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error ' : '' }}">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="lainnya" {{ $user->role == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Form EDIT --}}

    {{-- Modal Form ADD --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="exampleModalLabel">Tambah Data User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/users/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error ' : '' }}">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control" id="name"
                                placeholder="Masukkan Nama Pengguna" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error ' : '' }}">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                placeholder="Masukkan Email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error ' : '' }}">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error ' : '' }}">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password"
                                placeholder="Masukkan Password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                            <small>*Password minimal 8 karakter</small>
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
    {{-- End Modal Form ADD --}}
@endsection
