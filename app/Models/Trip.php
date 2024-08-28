<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Day;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'slug', 'image', 'destination', 'departure_date', 'trip_duration', 'number_of_people', 'available_budget'];

    /**
     * Get the user that owns the Trip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the days for the Trip
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }
}
