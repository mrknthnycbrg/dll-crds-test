<?php

namespace App\Observers;

use App\Models\Research;
use Illuminate\Support\Facades\Storage;

class ResearchObserver
{
    /**
     * Handle the Research "saved" event.
     */
    public function saved(Research $research): void
    {
        if (! is_null($research->getOriginal('file_path')) && $research->isDirty('file_path')) {
            Storage::delete($research->getOriginal('file_path'));
        }
    }

    /**
     * Handle the Research "force deleted" event.
     */
    public function forceDeleted(Research $research): void
    {
        if (! is_null($research->file_path)) {
            Storage::delete($research->file_path);
        }
    }
}
