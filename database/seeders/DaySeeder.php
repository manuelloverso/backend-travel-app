<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = config('days_db.days');

        // Insert each day record into the database
        foreach ($days as $day) {
            $newDay = new  Day();
            $newDay->trip_id = $day['trip_id'];
            $newDay->day_number = $day['day_number'];
            $newDay->title = $day['title'];
            $newDay->weather = $day['weather'];
            $newDay->rating = $day['rating'];
            $newDay->notes = $day['notes'];
            $newDay->save();
        }
    }
}
