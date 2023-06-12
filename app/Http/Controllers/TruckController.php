<?php

namespace App\Http\Controllers;
use App\Models\TruckSubunit;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class TruckController extends Controller
{
    public function showAssignSubunitForm($id)
    {
        $mainTruck = Truck::findOrFail($id);
        $trucks = Truck::get();
        return view('trucks.assign-subunit', compact('mainTruck', 'trucks'));
    }
    function isDateRangeOverlapping($start1, $end1, $start2, $end2)
{
    $start1 = Carbon::parse($start1);
    $end1 = Carbon::parse($end1);
    $start2 = Carbon::parse($start2);
    $end2 = Carbon::parse($end2);

    return $start1->lt($end2) && $end1->gt($start2);
}
    public function assignSubunit(Request $request, $id)
    {
        if ($request->subunit_truck_id == $id) {
            return redirect()->back()->with('error', 'Same truck can not be assign as subunit to it self');
        }
        $request->validate([
            'subunit_truck_id' => 'nullable|integer',
            'subunit' => 'required|integer|exists:trucks,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $subunits = TruckSubunit::all();
        foreach ($subunits as $subunit) {
            if ($subunit->main_truck_id == $id){
                $start1 = $subunit->start_date;
                $end1 = $subunit->end_date;
                $start2 = $request->start_date;
                $end2 = $request->end_date;
                if ($this->isDateRangeOverlapping($start1, $end1, $start2, $end2)) {
                    return redirect()->back()->with('error', 'Dates are overlapping with others subunits for this truck');
                }
            }
            if ($subunit->main_truck_id == $request->subunit_truck_id) {
                $start1 = $subunit->start_date;
                $end1 = $subunit->end_date;
                $start2 = $request->start_date;
                $end2 = $request->end_date;
                if ($this->isDateRangeOverlapping($start1, $end1, $start2, $end2)) {
                    return redirect()->back()->with('error', 'Subunits dates overlapping');
                }
            }
        }

    
        // Logic to assign subunit to the main truck
        TruckSubunit::create([
            'main_truck_id' => $request->id,
            'subunit_truck_id' => $request->subunit_truck_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return redirect()->route('trucks.index')->with('success', 'Subunit assigned successfully.');
    }
    

    public function show($id)
    {
        $truck = Truck::findOrFail($id);
        $subunits = $truck->subunits; // Assuming you have defined the relationship in the Truck model
        // dd($subunits);
    
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
        $truck->delete();
        return redirect()->route('trucks.index')->with('success', 'Truck deleted successfully.');
    }
}
