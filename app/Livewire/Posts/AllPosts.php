<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    public $selectedYear;

    public function render()
    {
        $latestPublished = Post::where('published', true)->max('date_published');

        $earliestPublished = Post::where('published', true)->min('date_published');

        if ($latestPublished && $earliestPublished) {
            $latestYear = Carbon::parse($latestPublished)->year;
            $earliestYear = Carbon::parse($earliestPublished)->year;

            $yearRange = range($latestYear, $earliestYear);
            $years = array_combine($yearRange, $yearRange);
        } else {
            $years = null;
        }

        $posts = Post::where('published', true)
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_published', $this->selectedYear);
            })
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.all-posts', compact('posts', 'years'))
            ->title('News - DLL-CRDS');
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
