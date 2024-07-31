@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Validate Request</h1>
    <form action="{{ route('validations.update', $requestItem->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <div class="form-group">
            <label for="validated_quantity">Validated Quantity</label>
            <input type="number" class="form-control" id="validated_quantity" name="validated_quantity">
        </div>
        <div class="form-group">
            <label for="comments">Comments</label>
            <textarea class="form-control" id="comments" name="comments"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection