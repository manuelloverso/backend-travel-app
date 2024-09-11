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

        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = 'storage/' . $img_path;
        } else {
            $data['image'] = 'images/default.jpg';
        }

        /* attach the user_id */
        $data['user_id'] = $user->id;

        $trip = Trip::create($data);

        if ($trip) {
            return response()->json([
                'success' => true,
                'message' => 'Trip created successfully',
                'trip' => $trip
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
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, $id)
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

        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        if ($request->has('image')) {
            /* delete the old img */
            if (str_starts_with($trip->image, 'storage')) {
                Storage::delete(str_replace('storage/', '', $trip->image));
            }

            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = 'storage/' . $img_path;
        }

        $was_updated = $trip->update($data);

        if ($was_updated) {
            $trip->refresh();
            return response()->json([
                'success' => true,
                'response' => 'Trip updated successfully',
                'trip' => $trip
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => "Trip wasn't updated, try again later.",
            ]);
        }
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

        if (str_starts_with($trip->image, 'storage')) {
            Storage::delete(str_replace('storage/', '', $trip->image));
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
