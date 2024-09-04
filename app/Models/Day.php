<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Stop;

class Day extends Model
{
    use HasFactory;
    protected $fillable = ['trip_id', 'title', 'weather', 'day_number', 'rating', 'notes'];

    /**
     * Get the trip that owns the Day
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Get all of the stops for the Day
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stops(): HasMany
    {
        return $this->hasMany(Stop::class);
    }
}
