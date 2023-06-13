@extends('layout')

@section('content')
<div class="container">
    <h2>Assign Subunit for Truck: {{ $mainTruck->unit_number }}</h2>

    <form action="{{ route('subunits.assign-subunit', $mainTruck->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="subunit_truck_id">Subunit Truck:</label>
            <select name="subunit_truck_id" id="subunit_truck_id" class="form-control">
                <option value="">Select Truck</option>
                @foreach ($trucks as $truck)
                <option value="{{ $truck->id }}">{{ $truck->unit_number }}</option>
                @endforeach
            </select>
            @error('subunit_truck_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

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

        <button type="submit" class="btn btn-primary">Assign Subunit</button>
    </form>
</div>
@endsection