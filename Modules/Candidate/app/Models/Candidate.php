<?php

namespace Modules\Candidate\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Candidate\Database\Factories\CandidateFactory;

class Candidate extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country_code',
        'phone',
        'password',
        'occupation',
    ];

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value)
        );
    }

    protected static function newFactory()
    {
        return CandidateFactory::new();
    }
}


