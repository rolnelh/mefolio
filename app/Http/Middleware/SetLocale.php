<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Langues disponibles sur le site : interface uniquement (menus,
     * boutons, formulaires) — le contenu publié par les utilisateurs
     * (bios, projets, missions, articles) reste dans sa langue d'origine.
     */
    public const AVAILABLE_LOCALES = ['fr', 'en'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale');

        if (in_array($locale, self::AVAILABLE_LOCALES, true)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
