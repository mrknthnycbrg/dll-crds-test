<?php

namespace App\Models;

use App\Observers\DownloadableObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
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
        'name',
        'slug',
        'file_path',
        'description',
        'published',
        'date_published',
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

    #[SearchUsingPrefix(['name'])]
    #[SearchUsingFullText(['description'])]
    public function toSearchableArray()
    {
        return [
            'name' => '',
            'description' => '',
        ];
    }

    public function formattedDescription()
    {
        return Str::words(strip_tags($this->description), 20);
    }

    public function formattedDate()
    {
        return $this->date_published->format('F j, Y');
    }
}
