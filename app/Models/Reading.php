<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Reading extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'context',
        'code'
    ];

    public function bookmarks():MorphToMany
    {
        return $this->morphToMany(Bookmark::class, 'bookmarkable');
    }
}
