<?php

namespace App\Http\Controllers;

use App\Models\Downloadable;
use Illuminate\Support\Facades\Storage;

class FileDownloadable extends Controller
{
    public function __invoke($slug)
    {
        $downloadable = Downloadable::where('slug', $slug)->firstOrFail();

        return response()->file(Storage::path($downloadable->file_path));
    }
}
