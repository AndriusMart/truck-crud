<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

// use Carbon\Carbon;

class TruckController extends Controller
{
    public function show($id)
    {
        $truck = Truck::findOrFail($id);
        $subunits = $truck->subunits;
        return view('trucks.show', compact('truck', 'subunits'));
    }

    public function index()
    {
        $trucks = Truck::all();
        return view('trucks.index', compact('trucks'));
    }

    public function create()
    {
        return view('trucks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_number' => 'required|string|max:255|unique:trucks',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'notes' => 'nullable|string',
        ]);

        Truck::create($request->all());
        return redirect()->route('trucks.index')->with('success', 'Truck created successfully.');
    }

    public function edit(Truck $truck)
    {
        return view('trucks.edit', compact('truck'));
    }

    public function update(Request $request, Truck $truck)
    {
        $request->validate([
            'unit_number' => 'required|string|max:255|unique:trucks,unit_number,' . $truck->id,
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'notes' => 'nullable|string',
        ]);

        $truck->update($request->all());
        return redirect()->route('trucks.index')->with('success', 'Truck updated successfully.');
    }

    public function destroy(Truck $truck)
    {
        $truck->subunits()->delete();
        $truck->delete();
        return redirect()->route('trucks.index')->with('success', 'Truck deleted successfully.');
    }
}
