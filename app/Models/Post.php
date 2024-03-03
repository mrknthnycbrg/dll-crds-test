<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'date_published' => 'date',
    ];

    public function formattedImage()
    {
        return Storage::url($this->image_path);
    }

    public function formattedContent()
    {
        return Str::words(strip_tags($this->content), 20);
    }

    public function formattedDate()
    {
        return $this->date_published->format('F j, Y');
    }
}
