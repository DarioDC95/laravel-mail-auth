<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $fillable = ['name', 'slug'];

    use HasFactory;

    public static function generateSlug($title) {
        return Str::slug($title, '-');
    }

    public function projects(): HasMany 
    {
        return $this->hasMany(Project::class);
    }
}
