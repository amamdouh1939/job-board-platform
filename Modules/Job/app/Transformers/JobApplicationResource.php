<?php

namespace Modules\Job\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Media\Transformers\MediaResource;

class JobApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company?->name,
            'job' => new JobResource($this->job),
            'resume' => new MediaResource($this->resume),
            'cover_letter' => new MediaResource($this->cover_letter),
        ];
    }
}
