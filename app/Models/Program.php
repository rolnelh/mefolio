<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'name',
        'slug',
        'full_name',
        'country',
        'type',
        'description',
        'tags',
        'url',
        'featured',
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'featured' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    protected static function booted(): void
    {
        static::creating(function (Program $program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->name) . '-' . uniqid();
            }
        });
    }
}
