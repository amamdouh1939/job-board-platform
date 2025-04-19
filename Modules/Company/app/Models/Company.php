<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Company\Database\Factories\CompanyFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value)
        );
    }

     protected static function newFactory(): CompanyFactory
     {
          return CompanyFactory::new();
     }
}
