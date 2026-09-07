<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Creatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'specialite',
        'localisation',
        'bio',
        'portfolio_url',
        'photo',
        'couverture',
        'slug',
        'builder_score',
        'builder_level',
        'available_for_work',
        'is_paused',
    ];

    protected $casts = [
        'available_for_work' => 'boolean',
        'is_paused' => 'boolean',
        'builder_score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function (Creatif $creatif) {
            $creatif->slug = static::uniqueSlug($creatif->prenom . ' ' . $creatif->nom);
        });

        static::updating(function (Creatif $creatif) {
            if ($creatif->isDirty(['prenom', 'nom']) && ! $creatif->isDirty('slug')) {
                $creatif->slug = static::uniqueSlug($creatif->prenom . ' ' . $creatif->nom, $creatif->id);
            }
        });
    }

    protected static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Str::slug($base) ?: 'talent';
        $original = $slug;
        $i = 1;
        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . (++$i);
        }
        return $slug;
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'creatif_id');
    }

    public function spotlights()
    {
        return $this->hasMany(Spotlight::class);
    }
}
