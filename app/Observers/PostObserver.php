<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "saved" event.
     */
    public function saved(Post $post): void
    {
        if (! is_null($post->getOriginal('image_path')) && $post->isDirty('image_path')) {
            Storage::delete($post->getOriginal('image_path'));
        }
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        if (! is_null($post->image_path)) {
            Storage::delete($post->image_path);
        }
    }
}
