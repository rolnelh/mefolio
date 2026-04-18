<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'creatif_id',
        'title',
        'description',
        'image',
        'slug',
        // 'category',
        'fichiers', 
        'technologies',
    ];

    protected $casts = [
    'fichiers' => 'array',
];

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creatif()
    {
        return $this->belongsTo(Creatif::class, 'creatif_id'); 
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

   
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title) . '-' . uniqid();
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title) . '-' . uniqid();
            }
        });
    }


    public function getUrlAttribute()
    {
        return route('projects.show', $this->slug);
    }
}