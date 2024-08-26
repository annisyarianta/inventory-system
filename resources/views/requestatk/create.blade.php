@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Request ATK</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('requests.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="masteratk_id" class="col-sm-2 col-form-label">Nama ATK</label>
                        <div class="col-sm-10">
                            <div class="searchable-dropdown">
                                <input type="text" id="search" placeholder="-- Pilih ATK --" onkeyup="filterFunction()" class="form-control">
                                <div id="dropdownList" class="dropdown-content">
                                    <a href="#" onclick="selectOption('', '-- Pilih ATK --')"></a>
                                    @foreach ($masteratk as $brg)
                                        <a href="#" onclick="selectOption('{{ $brg->id }}', '{{ $brg->namabarang }}')">
                                            {{ $brg->namabarang }}
                                        </a>
                                    @endforeach
                                </div>
                                <input type="hidden" name="masteratk_id" id="masteratk_id">
                            </div>
                            {{-- <select name="masteratk_id" id="masteratk_id" class="form-control">
                                @foreach ($masteratk as $item)
                                    <option value="{{ $item->id }}">{{ $item->kodebarang }} - {{ $item->namabarang }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_request" class="col-sm-2 col-form-label">Tanggal Request</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_request" id="tanggal_request" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit_id" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <select name="unit_id" id="unit_id" class="form-control">
                                @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaunit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label">Jumlah Request</label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" id="quantity" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <span class="text">Submit</span>
                        </button>
                    </div>                
                </form>
            </div>
        </div>
    </div>
@endsection
