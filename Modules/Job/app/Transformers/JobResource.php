<?php

namespace Modules\Job\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company?->name,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'salary_range' => $this->salary_range,
            'is_remote' => $this->is_remote,
            'published_at' => $this->published_at->toDateString(),
        ];
    }
}
