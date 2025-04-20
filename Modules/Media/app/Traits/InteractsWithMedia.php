<?php

namespace Modules\Media\Traits;

use Illuminate\Support\Collection;
use Modules\Media\Models\Media;

trait InteractsWithMedia
{
    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable', 'media_collections', 'mediable_id', 'media_id')->withPivot(['collection']);
    }

    public function syncMedia(Media $media, string $collectionName)
    {
        $this->media()->attach($media, [
            'collection' => $collectionName
        ]);
    }

    public function getSingleMediaByCollectionName(string $collectionName): Media
    {
        return $this->media()
            ->wherePivot('collection', $collectionName)
            ->first();
    }

    public function getMultipleMediaByCollectionName(string $collectionName): Collection
    {
        return $this->media()
            ->wherePivot('collection', $collectionName)
            ->get();
    }
}
