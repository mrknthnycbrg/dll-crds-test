<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $selectedCategory;

    public $selectedYear;

    public function render()
    {
        if (empty($this->search)) {
            $categoriesQuery = Category::whereHas('posts', function ($query) {
                $query->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_published', $this->selectedYear);
                });
            });

            $categories = $categoriesQuery->pluck('name', 'id');

            $latestPublished = Post::where('published', true)
                ->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })
                ->max('date_published');

            $earliestPublished = Post::where('published', true)
                ->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })
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
                ->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })
                ->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_published', $this->selectedYear);
                })
                ->latest('date_published')
                ->paginate(6);
        } else {
            $posts = Post::search(trim($this->search))
                ->query(function ($query) {
                    $query->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
                        ->select(
                            'posts.*',
                            'categories.name as category_name',
                        )
                        ->with('category')
                        ->where('published', true)
                        ->latest('date_published');
                })
                ->paginate(6);

            return view('livewire.posts.all-posts', compact('posts'));
        }

        return view('livewire.posts.all-posts', compact('posts', 'categories', 'years'))
            ->title('News - DLL-CRDS');
    }

    public function updatedSearch()
    {
        $this->resetPage();
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
