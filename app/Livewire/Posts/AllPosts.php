<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    public $selectedCategory;

    public $selectedYear;

    public function render()
    {
        $categories = Category::pluck('name', 'id');

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

        $posts = Post::with('category')
            ->where('published', true)
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_published', $this->selectedYear);
            })
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.posts.all-posts', compact('posts', 'categories', 'years'))
            ->layout('layouts.guest')
            ->title('News - DLL-CRDS');
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
