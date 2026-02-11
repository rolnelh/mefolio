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
    ];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($creatif) {
            $creatif->slug = Str::slug($creatif->prenom . ' ' . $creatif->nom);
        });

        static::updating(function ($creatif) {
            $creatif->slug = Str::slug($creatif->prenom . ' ' . $creatif->nom);
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'creatif_id');
    }


}
