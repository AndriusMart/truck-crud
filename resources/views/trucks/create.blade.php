@extends('layout')

@section('content')
    <h1>Create Truck</h1>

    <form action="{{ route('trucks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="unit_number" class="form-label">Unit Number</label>
            <input type="text" class="form-control @error('unit_number') is-invalid @enderror" id="unit_number"
                name="unit_number" value="{{ old('unit_number') }}" required>
            @error('unit_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year"
                value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 5 }}">
            @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes"
                rows="3">{{ old('notes') }}</textarea>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
