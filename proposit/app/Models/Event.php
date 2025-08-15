<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'end_date'];

    // Propostas submetidas para este evento
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }
}
