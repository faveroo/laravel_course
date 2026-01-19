<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory, SoftDeletes;

    protected $hidden = [
        'token'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }

    public function scopeVerified(Builder $query)
    {
        return $query->whereNotNull('verified_at');
    }

    public function scopeNotBlocked(Builder $query)
    {
        return $query->where(function ($q) {
            $q->whereNull('blocked_until')
              ->orWhere('blocked_until', '<=', now());
        });
    }

}
