<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'domaine',
        'budget_min',
        'budget_max',
        'duree',
        'niveau',
        'lieu',
        'remote',
        'urgent',
        'tags',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'remote' => 'boolean',
        'urgent' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(MissionApplication::class);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    protected static function booted(): void
    {
        static::creating(function (Mission $mission) {
            if (empty($mission->slug)) {
                $mission->slug = Str::slug($mission->title) . '-' . uniqid();
            }
        });
    }
}
