@extends('layout')

@section('content')
    <h1>Truck Details</h1>

    <p>Unit number: {{ $truck->unit_number }}</p>
    <p>Year: {{ $truck->year }}</p>

    <h2>Subunits</h2>

    @if ($subunits->isEmpty())
        <p>No subunits found for this truck.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Subunit |</th>
                    <th>Start Date |</th>
                    <th>End Date |</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subunits as $subunit)
                    <tr>
                        <td>{{ $subunit->subTruck->unit_number }}</td>
                        <td>{{ $subunit->start_date }}|</td>
                        <td>{{ $subunit->end_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection