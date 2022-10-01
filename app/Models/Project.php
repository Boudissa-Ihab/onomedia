<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'client',
        'url',
        'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_project");
    }

    public function images()
    {
        return $this->hasMany(ProjectImages::class);
    }
}
