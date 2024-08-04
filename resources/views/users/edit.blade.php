@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Edit User</h1>
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit User</h6>
            </div>
            <div class="card-body">
                <form id="aksi" action="/users/{{ $user->id }}/update" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row{{ $errors->has('name') ? ' has-error ' : '' }}">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" id="name"
                                value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('email') ? ' has-error ' : '' }}">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="text" class="form-control" id="email"
                                value="{{ $user->email }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('role') ? ' has-error ' : '' }}">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="lainnya" {{ $user->role == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @if ($errors->has('role'))
                                <span class="help-block">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-warning btn-icon-split btn-sm"><span
                                class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Update</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
