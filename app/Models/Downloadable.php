<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Downloadable extends Model
{
    use HasFactory;
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'date_published' => 'date',
    ];

    public function formattedDescription()
    {
        return Str::words(strip_tags($this->description), 25);
    }

    public function formattedDate()
    {
        return $this->date_published->format('F j, Y');
    }
}
