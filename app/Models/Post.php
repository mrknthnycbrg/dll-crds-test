<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

#[ObservedBy([PostObserver::class])]
class Post extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'content',
        'published',
        'date_published',
        'category_id',
        'author_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published' => 'boolean',
            'date_published' => 'date',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function toSearchableArray()
    {
        return [
            'title' => '',
            'content' => '',
            'categories.name' => '',
            'authors.name' => '',
        ];
    }

    public function formattedImage()
    {
        return Storage::url($this->image_path);
    }

    public function shortenedTitle()
    {
        return Str::of($this->title)->words(10);
    }

    public function shortenedContent()
    {
        return Str::of($this->content)->stripTags()->words(20);
    }

    public function formattedDate()
    {
        return Carbon::parse($this->date_published)->format('F j, Y');
    }
}
