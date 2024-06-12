<?php

namespace App\Models;

use App\Observers\DownloadableObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

#[ObservedBy([DownloadableObserver::class])]
class Downloadable extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'downloadables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'file_path',
        'description',
        'published',
        'date_published',
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

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function toSearchableArray()
    {
        return [
            'title' => '',
            'description' => '',
            'authors.name' => '',
        ];
    }

    public function shortenedTitle()
    {
        return Str::of($this->title)->words(10);
    }

    public function shortenedDescription()
    {
        return Str::of($this->description)->stripTags()->words(20);
    }

    public function formattedDate()
    {
        return Carbon::parse($this->date_published)->format('F j, Y');
    }
}
