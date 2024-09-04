<?php

namespace App\Http\Controllers\Api;

use App\Models\Day;
use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDayRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Your session expired, please login and try again.'
            ], 401);
        }

        $data = $request->validated();

        $day = Day::create($data);

        if ($day) {
            return response()->json([
                'success' => true,
                'message' => 'Day created successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Sorry, the day wasn't created, try again later."
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDayRequest $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Your session expired, please login and try again.'
            ], 401);
        }

        $day = Day::find($id);

        if (!$day) {
            return response()->json([
                'success' => false,
                'response' => 'Day not found.'
            ]);
        }

        $data = $request->validated();

        $was_updated = $day->update($data);

        if ($was_updated) {
            return response()->json([
                'success' => true,
                'response' => 'Day updated successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => "Day wasn't updated, try again later.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        //
    }
}
