<?php

namespace Modules\Job\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Models\Company;
use Modules\Job\Database\Factories\JobFactory;
use Modules\Job\Models\Scopes\OwnerCompanyScope;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'location',
        'salary_range',
        'is_remote',
        'published_at',
    ];

    protected $casts = [
        'is_remote' => 'bool',
        'published_at' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

     protected static function newFactory(): JobFactory
     {
          return JobFactory::new();
     }

     protected static function booted()
     {
         static::addGlobalScope(new OwnerCompanyScope);
     }
}
