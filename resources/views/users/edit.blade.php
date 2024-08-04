@extends('layouts.master')
@section('content')

<!-- MAIN -->
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h2>Edit User</h2>
            </div>
            <div class="panel-body">
                <form id="aksi" action="/users/{{ $user->id }}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('name') ? ' has-error ' : ''}}">
                        <label for="name">Nama</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{$user->name}}">
                        @if ($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('email') ? ' has-error ' : ''}}">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" value="{{$user->email}}">
                        @if ($errors->has('email'))
                        <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('role') ? ' has-error ' : ''}}">
                        <label for="rple">Role</label>
                        <select name="role" class="form-control" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="lainnya" {{ $user->role == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>                        
                        @if ($errors->has('role'))
                        <span class="help-block">{{$errors->first('role')}}</span>
                        @endif
                    </div>
    
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END MAIN -->

@endsection