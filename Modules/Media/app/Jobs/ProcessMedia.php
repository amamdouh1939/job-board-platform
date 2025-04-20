<?php

namespace Modules\Media\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\Media;

class ProcessMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Model $model;

    protected string $filePath;

    protected string $collectionName;

    /**
     * Create a new job instance.
     */
    public function __construct(Model $model, string $filePath, string $collectionName)
    {
        $this->model = $model;
        $this->filePath = $filePath;
        $this->collectionName = $collectionName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $newPath = str_replace('temp/', 'media/', $this->filePath);
        Storage::disk('public')->move($this->filePath, $newPath);
        $media = Media::query()->create([
            'original_name' => str_replace('media/', '', $newPath),
            'file_name' => str_replace('media/', '', $newPath),
            'file_path' => $newPath,
            'mime_type' => Storage::disk('public')->mimeType($newPath),
            'size' => Storage::disk('public')->size($newPath),
        ]);

        $this->model->syncMedia($media, $this->collectionName);
    }
}
