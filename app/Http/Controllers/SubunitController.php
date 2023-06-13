<?php

namespace App\Http\Controllers;

use App\Services\SubunitService;
use App\Models\TruckSubunit;
use App\Models\Truck;
use Illuminate\Http\Request;
// use Carbon\Carbon;

class SubunitController extends Controller
{
    private $subunitService;

    public function __construct(SubunitService $subunitService)
    {
        $this->subunitService = $subunitService;
    }

    public function showAssignSubunitForm($id)
    {
        $mainTruck = Truck::findOrFail($id);
        $trucks = Truck::get();
        return view('subunits.assign-subunit', compact('mainTruck', 'trucks'));
    }

    public function assignSubunit(Request $request, $id)
    {

        if ($request->subunit_truck_id == $id) {
            return redirect()->back()->with('error', 'Same truck can not be assign as subunit to it self');
        }
        $request->validate([
            'subunit_truck_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ],);

        $subunits = TruckSubunit::all();
        foreach ($subunits as $subunit) {
            //checking if any subunit is already assigned as for those days for this truck
            if ($subunit->main_truck_id == $id) {
                if ($this->subunitService->checkDateOverlap($subunit->start_date, $subunit->end_date, $request->start_date, $request->end_date)) {
                    return redirect()->back()->with('error', 'Dates are overlapping with others subunits for this truck');
                }
            }
            //checking if subunit is already assigned as subunit for those days
            if ($request->subunit_truck_id == $subunit->subunit_truck_id) {
                if ($this->subunitService->checkDateOverlap($subunit->start_date, $subunit->end_date, $request->start_date, $request->end_date)) {
                    return redirect()->back()->with('error', 'Subunits dates overlapping');
                }
            }
            //checking if truck is already assigned as subunit for those days
            if ($id == $subunit->subunit_truck_id) {
                if ($this->subunitService->checkDateOverlap($subunit->start_date, $subunit->end_date, $request->start_date, $request->end_date)) {
                    return redirect()->back()->with('error', 'Main truck is already assigned for those dates');
                }
            }
        }

        TruckSubunit::create([
            'main_truck_id' => $request->id,
            'subunit_truck_id' => $request->subunit_truck_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('trucks.index')->with('success', 'Subunit assigned successfully.');
    }


    public function edit(TruckSubunit $subunit)
    {
        return view('subunits.edit', compact('subunit'));
    }

    public function update(Request $request, TruckSubunit $subunit)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ],);


        $subunit->update($request->all());
        return redirect()->route('trucks.index')->with('success', 'Truck updated successfully.');
    }

    public function destroy(TruckSubunit $subunit)
    {
        $subunit->delete();

        return redirect()->back()->with('success', 'Subunit deleted successfully.');
    }
}
