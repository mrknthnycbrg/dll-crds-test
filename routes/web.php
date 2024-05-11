<?php

use App\Http\Controllers\DownloadableFile;
use App\Http\Controllers\ResearchFile;
use App\Livewire\About\AboutPage;
use App\Livewire\Downloadables\AllDownloadables;
use App\Livewire\Downloadables\ShowDownloadable;
use App\Livewire\Home\HomePage;
use App\Livewire\Posts\AllPosts;
use App\Livewire\Posts\CategoryPosts;
use App\Livewire\Posts\ShowPost;
use App\Livewire\Researches\AllResearches;
use App\Livewire\Researches\DepartmentResearches;
use App\Livewire\Researches\ShowResearch;
use App\Livewire\Tools\ToolsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/news', AllPosts::class)->name('all-posts');
Route::get('/news/categories/{slug}', CategoryPosts::class)->name('category-posts');
Route::get('/news/{slug}', ShowPost::class)->name('show-post');
Route::get('/researches', AllResearches::class)->name('all-researches');
Route::get('/researches/departments/{slug}', DepartmentResearches::class)->name('department-researches');
Route::get('/researches/{slug}', ShowResearch::class)->name('show-research');
Route::get('/resources', AllDownloadables::class)->name('all-downloadables');
Route::get('/resources/{slug}', ShowDownloadable::class)->name('show-downloadable');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/researches/files/{slug}', ResearchFile::class)->name('research-file');
    Route::get('/resources/files/{slug}', DownloadableFile::class)->name('downloadable-file');
    Route::get('/tools', ToolsPage::class)->name('tools');
});
