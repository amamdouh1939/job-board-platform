<?php

namespace Modules\Candidate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Candidate\Database\Factories\CandidateFactory;

class Candidate extends Authenticatable
{

    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country_code',
        'phone',
        'password',
        'occupation',
    ];


    protected static function newFactory()
    {
        return CandidateFactory::new();
    }

}


