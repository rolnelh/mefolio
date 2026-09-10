<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'project_id', 'parent_id'];

    /**
     * Délai après publication pendant lequel l'auteur peut encore modifier
     * ou supprimer son propre commentaire (en minutes) — voir
     * CommentController::update()/destroy() et estModifiable() ci-dessous.
     */
    const DELAI_MODIFICATION_MINUTES = 5;

    /**
     * Le commentaire est-il encore dans la fenêtre où son auteur peut le
     * modifier ou le supprimer ? Ne dépend que de l'heure de création : une
     * modification ne prolonge pas le délai.
     */
    public function estModifiable(): bool
    {
        return $this->created_at->diffInMinutes(now()) < self::DELAI_MODIFICATION_MINUTES;
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

     public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}

