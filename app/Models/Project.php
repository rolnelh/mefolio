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
        'fichiers', // Pour stocker les chemins des fichiers multiples
        'technologies', // Si tu l'utilises dans ton formulaire
    ];

    protected $casts = [
    'fichiers' => 'array',
];

    /**
     * Utiliser le slug à la place de l'ID pour le Route Model Binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relations
     */
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

    /**
     * Boot : Génération automatique du slug unique à la création
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title) . '-' . uniqid();
            }
        });

        // Optionnel : Mettre à jour le slug si le titre change
        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title) . '-' . uniqid();
            }
        });
    }

    /**
     * Accessors
     */
    public function getUrlAttribute()
    {
        return route('projects.show', $this->slug);
    }
}