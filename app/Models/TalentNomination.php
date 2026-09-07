<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentNomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominated_by',
        'creatif_name',
        'contact_email',
        'reason',
        'status',
    ];

    public function nominator()
    {
        return $this->belongsTo(User::class, 'nominated_by');
    }
}
