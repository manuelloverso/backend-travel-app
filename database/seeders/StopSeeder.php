<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stop;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stops = config('stops_db.stops');

        foreach ($stops as $stopData) {
            $newStop = new Stop();
            $newStop->day_id = $stopData['day_id'];
            $newStop->location = $stopData['location'];
            $newStop->type = $stopData['type'];
            $newStop->address = $stopData['address'];
            $newStop->visited = $stopData['visited'];
            $newStop->notes = $stopData['notes'];
            $newStop->save();
        }
    }
}
