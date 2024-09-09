<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    // Display a listing of the agency resources
    public function index() {
        $allAgencies = Agency::all();
        return view('library.agency.index', ['allAgencies' => $allAgencies]);
    }

    // Store a newly created agency resource in storage
    public function store(Request $request) {
        $data = $request->validate([
            'Agencies' => 'required',
            'Acronym' => 'required',
            'Agency_Group' => 'required',
            'Contact' => 'required',
            'Website' => 'required|url', // Ensure Website is a valid URL
        ]);

        Agency::create($data);
        return redirect()->route('agency.index');
    }

    // Update the specified agency resource in storage
    public function update(Agency $agency, Request $request) {
        $data = $request->validate([
            'Agencies' => 'required',
            'Acronym' => 'required',
            'Agency_Group' => 'required',
            'Contact' => 'required',
            'Website' => 'required|url', // Ensure Website is a valid URL
        ]);

        $agency->update($data);
        return redirect()->route('agency.index');
    }

    // Remove the specified agency resource from storage
    public function destroy(Agency $agency) {
        $agency->delete();
        return redirect()->route('agency.index');
    }
}
