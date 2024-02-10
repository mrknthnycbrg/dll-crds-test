<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

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
        'image_path',
        'abstract',
        'department_id',
        'adviser_id',
        'category_id',
        'client_id',
        'award_id',
        'published',
        'date_submitted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'date_submitted' => 'date',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class);
    }

    #[SearchUsingFullText(['abstract'])]
    public function toSearchableArray()
    {
        return [
            'title' => '',
            'author' => '',
            'keyword' => '',
            'abstract' => '',
            'departments.name' => '',
            'advisers.name' => '',
            'categories.name' => '',
            'clients.name' => '',
            'awards.name' => '',
        ];
    }

    public function formattedImage()
    {
        return Storage::url($this->image_path);
    }

    public function formattedAbstract()
    {
        return Str::words(strip_tags($this->abstract), 50);
    }

    public function formattedDate()
    {
        return $this->date_submitted->format('F j, Y');
    }
}
