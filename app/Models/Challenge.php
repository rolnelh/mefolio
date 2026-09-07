<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'slug',
        'description',
        'sponsor',
        'prize',
        'category',
        'deadline',
        'image',
        'status',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants()
    {
        return $this->hasMany(ChallengeParticipant::class);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    protected static function booted(): void
    {
        static::creating(function (Challenge $challenge) {
            if (empty($challenge->slug)) {
                $challenge->slug = Str::slug($challenge->title) . '-' . uniqid();
            }
        });
    }
}
