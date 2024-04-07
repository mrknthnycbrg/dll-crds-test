<?php

namespace App\Observers;

use App\Models\Downloadable;
use Illuminate\Support\Facades\Storage;

class DownloadableObserver
{
    /**
     * Handle the Downloadable "saved" event.
     */
    public function saved(Downloadable $downloadable): void
    {
        if (! is_null($downloadable->getOriginal('file_path')) && $downloadable->isDirty('file_path')) {
            Storage::delete($downloadable->getOriginal('file_path'));
        }
    }

    /**
     * Handle the Downloadable "force deleted" event.
     */
    public function forceDeleted(Downloadable $downloadable): void
    {
        if (! is_null($downloadable->file_path)) {
            Storage::delete($downloadable->file_path);
        }
    }
}
