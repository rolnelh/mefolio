<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Enregistre une visite de page dans page_views, pour alimenter la
 * section "Visites" du dashboard admin (voir Admin\DashboardController).
 *
 * Volontairement minimaliste : pas de géolocalisation, pas de suivi
 * cross-page (pas de cookie visiteur), juste un compteur par page et par
 * référent externe. Exclut : tout ce qui n'est pas un GET de page classique
 * (requêtes AJAX/JSON), les assets et l'espace admin lui-même (pour ne pas
 * gonfler les stats avec l'activité de l'équipe), et les robots connus via
 * une détection basique du User-Agent.
 */
class TrackPageView
{
    /**
     * Premier segment d'URL à ne jamais compter comme une visite.
     */
    private const EXCLUDED_FIRST_SEGMENTS = ['admin', 'build', 'storage', 'sanctum'];

    /**
     * Signatures grossières de robots/monitoring dans le User-Agent. Ce
     * n'est pas un filtre anti-bot fiable (le User-Agent est déclaratif et
     * spoofable) — juste de quoi éviter que les crawlers connus et les
     * moniteurs d'uptime gonflent artificiellement les chiffres.
     */
    private const BOT_SIGNATURES = [
        'bot', 'spider', 'crawl', 'slurp', 'facebookexternalhit',
        'bingpreview', 'pingdom', 'uptimerobot', 'monitor',
        'curl/', 'wget/', 'python-requests', 'headlesschrome',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request)) {
            PageView::create([
                'path' => '/'.ltrim($request->path(), '/'),
                'referrer_host' => $this->refererHost($request),
            ]);
        }

        return $response;
    }

    private function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('get') || $request->ajax() || $request->wantsJson()) {
            return false;
        }

        $firstSegment = $request->segment(1);
        if ($firstSegment && in_array($firstSegment, self::EXCLUDED_FIRST_SEGMENTS, true)) {
            return false;
        }

        $userAgent = strtolower((string) $request->userAgent());
        if ($userAgent === '') {
            return false;
        }

        foreach (self::BOT_SIGNATURES as $signature) {
            if (str_contains($userAgent, $signature)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Nom d'hôte du référent externe, ou null pour un accès direct ou une
     * navigation interne au site (seuls les référents externes disent
     * vraiment "d'où" viennent les visiteurs).
     */
    private function refererHost(Request $request): ?string
    {
        $referer = $request->headers->get('referer');
        if (! $referer) {
            return null;
        }

        $host = parse_url($referer, PHP_URL_HOST);
        if (! $host) {
            return null;
        }

        if ($host === $request->getHost()) {
            return null;
        }

        return strtolower(preg_replace('/^www\./', '', $host));
    }
}
