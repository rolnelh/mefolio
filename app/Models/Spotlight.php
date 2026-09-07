<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spotlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'creatif_id',
        'created_by',
        'week_label',
        'note',
        'is_current',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];

    public function creatif()
    {
        return $this->belongsTo(Creatif::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
