<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relacionamento com roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Propostas submetidas pelo usuário
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
