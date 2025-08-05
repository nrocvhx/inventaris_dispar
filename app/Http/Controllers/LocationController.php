<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $gpsData = Location::create($data);

        return response()->json([
            'message' => 'GPS data saved successfully!',
            'data' => $gpsData
        ]);
    }
    
    public function latest()
    {
        return response()->json(Location::latest()->take(10)->get());
    }
}
