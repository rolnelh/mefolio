<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Une visite de page, créée par App\Http\Middleware\TrackPageView.
 *
 * Volontairement minimaliste (voir CLAUDE.md § Analytics) : pas
 * d'utilisateur associé, pas de géolocalisation — juste de quoi
 * répondre à "combien de visites, sur quelles pages, depuis où" dans
 * le dashboard admin (Admin\DashboardController).
 */
class PageView extends Model
{
    protected $fillable = ['path', 'referrer_host'];
}
