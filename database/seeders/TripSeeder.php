<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trips = config('trips_db.trips');

        foreach ($trips as $trip) {
            $newTrip = new Trip();
            $newTrip->user_id = $trip['user_id'];
            $newTrip->name = $trip['name'];
            $newTrip->slug = Str::slug($trip['name'], '-');
            $newTrip->destination = $trip['destination'];
            $newTrip->departure_date = $trip['departure_date'];
            $newTrip->trip_duration = $trip['trip_duration'];
            $newTrip->number_of_people = $trip['number_of_people'];
            $newTrip->available_budget = $trip['available_budget'];
            $newTrip->save();
        }
    }
}
