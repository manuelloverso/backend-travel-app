<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You are not logged in!'
            ], 401);
        }

        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        /* attach the user_id */
        $data['user_id'] = $user->id;

        $trip = Trip::create($data);

        if ($trip) {
            return response()->json([
                'success' => true,
                'message' => 'Trip created successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Sorry, the trip wasn't created, try again later."
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
