<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

/**
 * Compte de connexion (email/mot de passe ou Google OAuth).
 *
 * Un User a un rôle (creatif|client|admin, voir ROLES) et, s'il est
 * créatif, un profil public associé via la relation creatif() vers
 * \App\Models\Creatif — c'est ce modèle Creatif, pas User, qui porte la
 * bio, la spécialité, le portfolio, etc. affichés publiquement.
 *
 * Un compte créé via Google (google_id non nul) reçoit un mot de passe
 * aléatoire côté serveur : personne ne le connaît, la connexion classique
 * par email/mot de passe est donc censée échouer pour ces comptes (voir
 * App\Http\Requests\Auth\LoginRequest::authenticate()).
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Rôles disponibles pour un utilisateur.
     */
    public const ROLE_CREATIF = 'creatif';
    public const ROLE_CLIENT = 'client';
    public const ROLE_ADMIN = 'admin';

    public const ROLES = [
        self::ROLE_CREATIF,
        self::ROLE_CLIENT,
        self::ROLE_ADMIN,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'google_id',
        'role',
        'avatar',
        'bio',
        'location',
        'social_links',
        'is_banned',
        'payment_methods',
        'payment_phone_prefix',
        'payment_phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'social_links' => 'array',
        'is_banned' => 'boolean',
        'payment_methods' => 'array',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    // Pour récupérer tous les projets d'un utilisateur
    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function creatif()
    {
        return $this->hasOne(Creatif::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class, 'user_id');
    }

    public function missionApplications()
    {
        return $this->hasMany(MissionApplication::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function talentNominations()
    {
        return $this->hasMany(TalentNomination::class, 'nominated_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isCreatif(): bool
    {
        return $this->role === self::ROLE_CREATIF;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }
}
