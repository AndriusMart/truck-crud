@extends('layout')

@section('content')
    <h1>Trucks</h1>

    <a href="{{ route('trucks.create') }}" class="btn btn-primary mb-3">Create New Truck</a>

    <table class="table">
        <thead>
            <tr>
                <th>Unit Number</th>
                <th>Year</th>
                <th>Notes</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($trucks as $truck)
                <tr>
                    <td>{{ $truck->unit_number }}</td>
                    <td>{{ $truck->year }}</td>
                    <td>{{ $truck->notes }}</td>
                    <td>
                        <a href="{{ route('trucks.edit', $truck) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('trucks.destroy', $truck) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this truck?')">Delete</button>
                        </form>
                        <a href="{{ route('trucks.show', $truck->id) }}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('subunits.assign-subunit', $truck->id) }}" class="btn btn-sm btn-primary">Assign Subunit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
