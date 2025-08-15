<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProposalStatus extends Model
{
    protected $fillable = ['name'];

    // Propostas que possuem este status
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }
}
