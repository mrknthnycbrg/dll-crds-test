<?php

use App\Http\Controllers\FileDownloadable;
use App\Http\Controllers\FileResearch;
use App\Livewire\Collections\CollectionsPage;
use App\Livewire\Downloadables\AllDownloadables;
use App\Livewire\Downloadables\ShowDownloadable;
use App\Livewire\Home\HomePage;
use App\Livewire\Posts\ShowPost;
use App\Livewire\Researches\AllResearches;
use App\Livewire\Researches\DepartmentResearches;
use App\Livewire\Researches\ShowResearch;
use App\Livewire\Submit\SubmitPage;
use App\Livewire\Tools\ToolsPage;
use App\Livewire\Welcome\WelcomePage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomePage::class)->name('welcome');
Route::get('/news/{slug}', ShowPost::class)->name('show-post');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', HomePage::class)->name('home');
    Route::get('/researches', AllResearches::class)->name('all-researches');
    Route::get('/researches/{slug}', ShowResearch::class)->name('show-research');
    Route::get('/researches/departments/{slug}', DepartmentResearches::class)->name('department-researches');
    Route::get('/researches/files/{slug}', FileResearch::class)->name('file-research');
    Route::get('/resources', AllDownloadables::class)->name('all-downloadables');
    Route::get('/resources/{slug}', ShowDownloadable::class)->name('show-downloadable');
    Route::get('/resources/files/{slug}', FileDownloadable::class)->name('file-downloadable');
    Route::get('/collections', CollectionsPage::class)->name('collections');
    Route::get('/tools', ToolsPage::class)->name('tools');
    Route::get('/submit', SubmitPage::class)->name('submit')->middleware(['password.confirm']);
});
