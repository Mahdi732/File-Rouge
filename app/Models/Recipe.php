<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'title',
        'etap',
        'description',
        'note',
        'video',
        'image',
        'ingredients',
        'timepreparation',
        'levelPreparation'
    ];

    protected $casts = [
        'etap' => 'array',
        'ingredients' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe');
    }

    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
