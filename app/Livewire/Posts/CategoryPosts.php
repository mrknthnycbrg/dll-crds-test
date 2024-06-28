<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPosts extends Component
{
    use WithPagination;

    public $category;

    #[Url()]
    public $search = '';

    public $selectedYear;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        if (empty($this->search)) {
            $latestPublished = Post::where('published', true)
                ->where('category_id', $this->category->id)
                ->max('date_published');

            $earliestPublished = Post::where('published', true)
                ->where('category_id', $this->category->id)
                ->min('date_published');

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
                ->where('category_id', $this->category->id)
                ->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_published', $this->selectedYear);
                })
                ->latest('date_published')
                ->paginate(6);
        } else {
            $posts = Post::search(trim($this->search))
                ->query(function ($query) {
                    $query->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
                        ->leftJoin('authors', 'posts.author_id', '=', 'authors.id')
                        ->select(
                            'posts.*',
                            'categories.name as category_name',
                        )
                        ->with('category')
                        ->where('published', true)
                        ->where('category_id', $this->category->id)
                        ->latest('date_published');
                })
                ->paginate(6);

            return view('livewire.posts.category-posts', compact('posts'));
        }

        return view('livewire.posts.category-posts', compact('posts', 'years'))
            ->title($this->category->name.' - News - DLL-CRDS');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
