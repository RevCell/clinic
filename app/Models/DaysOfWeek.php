<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DaysOfWeek extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class,
            "doctors_days","days_id");
    }
}
