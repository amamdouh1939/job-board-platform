<?php

namespace Modules\Job\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Candidate\Models\Candidate;
use Modules\Company\Models\Company;
use Modules\Media\Traits\InteractsWithMedia;

class JobApplication extends Model
{

    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'candidate_id',
        'company_id',
        'job_id',
        'application_date',
    ];

    protected $casts = [
        'application_date' => 'date',
    ];

    protected $appends = [
        'resume',
        'cover_letter',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getResumeAttribute()
    {
        return $this->getSingleMediaByCollectionName('resume');
    }

    public function getCoverLetterAttribute()
    {
        return $this->getSingleMediaByCollectionName('cover_letter');
    }
}
