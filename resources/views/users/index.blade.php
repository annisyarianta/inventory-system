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
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Daftar User</h1>
        <br>
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
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
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
                                            <td class="text-center">
                                                @if ($user->role == 'admin')
                                                    <span class="badge badge-info badge-pill">Admin</span>
                                                @elseif($user->role == 'staff')
                                                    <span class="badge badge-orange badge-pill">Staff</span>
                                                @else
                                                    <span
                                                        class="badge badge-secondary badge-pill">{{ $user->role }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->created_at }}</td>
                                            <td class="text-center">{{ $user->updated_at }}</td>
                                            <td class="text-center">
                                                @if ($user->role != 'admin' || $users->where('role', 'admin')->count() > 1)
                                                    <a href="/users/{{ $user->id }}/edit"
                                                        class="btn btn-warning btn-circle btn-sm mr-1"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <a href="/users/{{ $user->id }}/delete"
                                                        class="btn btn-danger btn-circle btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus {{ $user->name }}?')"><i
                                                            class="fas fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Form ADD --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static">
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
                                placeholder="Masukkan nama pengguna" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error ' : '' }}">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                placeholder="Masukkan email pengguna" value="{{ old('email') }}">
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
                                placeholder="Masukkan password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                            <small>*Password minimal 8 karakter</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Form ADD --}}
@endsection
