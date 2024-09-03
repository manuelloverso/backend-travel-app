<?php

namespace App\Http\Controllers\Api;

use App\Models\Stop;
use App\Http\Requests\StoreStopRequest;
use App\Http\Requests\UpdateStopRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class StopController extends Controller
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
    public function store(StoreStopRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Your session expired, please login and try again.'
            ], 401);
        }

        $data = $request->validated();

        $stop = Stop::create($data);

        if ($stop) {
            return response()->json([
                'success' => true,
                'message' => 'Stop created successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Sorry, the stop wasn't created, try again later."
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stop $stop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stop $stop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStopRequest $request, Stop $stop)
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

        $stop = Stop::find($id);

        if (!$stop) {
            return response()->json([
                'success' => false,
                'response' => 'Stop not found.'
            ]);
        }


        $was_deleted = $stop->delete();

        if ($was_deleted) {
            return response()->json([
                'success' => true,
                'response' => 'Stop deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => 'Failed to delete the stop. Please try again later.'
            ]);
        }
    }
}
