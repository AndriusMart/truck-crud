@extends('layout')

@section('content')
<h1>Edit Subunit</h1>
<form action="{{ route('subunits.update', $subunit) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" class="form-control">
        @error('start_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" class="form-control">
        @error('end_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">edit</button>
</form>

@endsection