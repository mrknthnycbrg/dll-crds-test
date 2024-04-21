<?php

namespace App\Models;

use App\Observers\ResearchObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

#[ObservedBy([ResearchObserver::class])]
class Research extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'researches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'author',
        'keyword',
        'file_path',
        'abstract',
        'published',
        'date_submitted',
        'department_id',
        'year_section_id',
        'adviser_id',
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
            'date_submitted' => 'date',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function yearSection(): BelongsTo
    {
        return $this->belongsTo(YearSection::class);
    }

    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }

    #[SearchUsingPrefix(['title', 'author', 'keyword', 'departments.name', 'departments.abbreviation', 'year_sections.name', 'advisers.name'])]
    #[SearchUsingFullText(['abstract'])]
    public function toSearchableArray()
    {
        return [
            'title' => '',
            'author' => '',
            'keyword' => '',
            'abstract' => '',
            'departments.name' => '',
            'departments.abbreviation' => '',
            'year_sections.name' => '',
            'advisers.name' => '',
        ];
    }

    public function formattedAbstract()
    {
        return Str::words(strip_tags($this->abstract), 20);
    }

    public function formattedDate()
    {
        return $this->date_submitted->format('F j, Y');
    }
}
