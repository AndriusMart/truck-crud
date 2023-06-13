@extends('layout')

@section('content')
<h1>Truck Details</h1>

<p>Unit number: {{ $truck->unit_number }}</p>
<p>Year: {{ $truck->year }}</p>

<h2>Subunits</h2>

@if ($subunits->isEmpty())
<p>No subunits found for this truck.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Subunit </th>
            <th>Start Date </th>
            <th>End Date </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subunits as $subunit)
        <tr>
            <td>{{ $subunit->subTruck->unit_number }}</td>
            <td>{{ $subunit->start_date }}</td>
            <td>{{ $subunit->end_date }}</td>
            <td>
                <a href="{{ route('subunits.edit', $subunit) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('subunits.destroy', $subunit) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this subunit?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection