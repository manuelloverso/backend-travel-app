<?php

namespace App\Http\Controllers\Api;

use App\Models\Trip;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'response' => 'Your session expired, please login and try again.'
            ], 401);
        }
        $trips = DB::table('trips')->where('user_id', $user->id)->orderBy('departure_date')->get();
        if (count($trips) > 0) {
            return response()->json([
                'success' => true,
                'response' => $trips
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => 'No trips were found',
            ]);
        }
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
                'message' => 'Your session expired, please login and try again.'
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
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'response' => 'Your session expired, please login and try again.'
            ], 401);
        }

        $trip = Trip::with('days.stops')->where('id', $id)->where('user_id', $user->id)->first();

        if ($trip) {
            return response()->json([
                'success' => true,
                'response' => $trip
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => 'No trip found'
            ]);
        }
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
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'response' => 'Your session expired, please login and try again.'
            ], 401);
        }

        $trip = Trip::find($id);

        if (!$trip) {
            return response()->json([
                'success' => false,
                'response' => 'Trip not found.'
            ]);
        }

        if ($trip->image) {
            Storage::delete($trip->image);
        }


        $was_deleted = $trip->delete();

        if ($was_deleted) {
            return response()->json([
                'success' => true,
                'response' => 'Trip deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => 'Failed to delete the trip. Please try again later.'
            ]);
        }
    }
}
