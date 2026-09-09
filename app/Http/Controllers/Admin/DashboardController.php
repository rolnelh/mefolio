<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Comment;
use App\Models\Creatif;
use App\Models\Mission;
use App\Models\NewsletterSubscriber;
use App\Models\PageView;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use App\Models\TalentNomination;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Nombre de jours affichés dans l'histogramme "Visites" du dashboard.
     */
    private const VISITS_CHART_DAYS = 14;

    public function index()
    {
        $stats = [
            'users' => User::count(),
            'creatifs' => Creatif::count(),
            'projects' => Project::count(),
            'comments' => Comment::count(),
            'posts' => Post::count(),
            'missions' => Mission::count(),
            'challenges' => Challenge::count(),
            'programs' => Program::count(),
            'newsletter' => NewsletterSubscriber::count(),
            'pending_nominations' => TalentNomination::where('status', 'pending')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentProjects = Project::with('user')->latest()->take(5)->get();
        $recentComments = Comment::with(['user', 'project'])->latest()->take(5)->get();

        $visits = $this->visitsSummary();

        return view('admin.dashboard', compact(
            'stats', 'recentUsers', 'recentProjects', 'recentComments', 'visits'
        ));
    }

    /**
     * Calcule les métriques de fréquentation affichées dans la section
     * "Visites" du dashboard admin, à partir de la table page_views
     * (voir App\Http\Middleware\TrackPageView).
     *
     * @return array{today: int, last7Days: int, last30Days: int,
     *     dailyCounts: \Illuminate\Support\Collection<string, int>,
     *     topPages: \Illuminate\Support\Collection,
     *     topReferrers: \Illuminate\Support\Collection, directCount: int}
     */
    private function visitsSummary(): array
    {
        $today = now()->toDateString();
        $last30Days = now()->subDays(30);

        $dailyRaw = PageView::where('created_at', '>=', now()->subDays(self::VISITS_CHART_DAYS - 1)->startOfDay())
            ->select(DB::raw('DATE(created_at) as day'), DB::raw('COUNT(*) as total'))
            ->groupBy('day')
            ->pluck('total', 'day');

        // On complète les jours sans aucune visite à 0, pour un histogramme
        // continu plutôt que des barres manquantes.
        $dailyCounts = collect(range(self::VISITS_CHART_DAYS - 1, 0))->mapWithKeys(
            fn ($daysAgo) => [
                ($date = now()->subDays($daysAgo)->toDateString()) => (int) $dailyRaw->get($date, 0),
            ]
        );

        $topPages = PageView::where('created_at', '>=', $last30Days)
            ->select('path', DB::raw('COUNT(*) as total'))
            ->groupBy('path')
            ->orderByDesc('total')
            ->take(8)
            ->get();

        $topReferrers = PageView::where('created_at', '>=', $last30Days)
            ->whereNotNull('referrer_host')
            ->select('referrer_host', DB::raw('COUNT(*) as total'))
            ->groupBy('referrer_host')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        return [
            'today' => (int) $dailyCounts->last(),
            'last7Days' => $dailyCounts->slice(-7)->sum(),
            'last30Days' => PageView::where('created_at', '>=', $last30Days)->count(),
            'dailyCounts' => $dailyCounts,
            'topPages' => $topPages,
            'topReferrers' => $topReferrers,
            'directCount' => PageView::where('created_at', '>=', $last30Days)->whereNull('referrer_host')->count(),
        ];
    }
}
