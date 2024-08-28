<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stop extends Model
{
    use HasFactory;
    protected $fillable = ['day_id', 'location', 'slug', 'type', 'address', 'visited', 'rating', 'notes'];

    /**
     * Get the day that owns the Stop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }
}
