<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model {
    protected $fillable = ['title', 'slug'];

    public function posts(): BelongsToMany {
        return $this->belongsToMany(Post::class);
    }
}
