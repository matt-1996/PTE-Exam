<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        "color",
        "type",
        "user_id",
        "practice_id"
    ] ;

    public function read_alouds(): MorphToMany
    {
        return $this->morphedByMany(Reading::class, 'bookmarkable');
    }
}
