<?php

namespace App\Services;

use App\Models\Creatif;

class BuilderScoreService
{
    const LEVELS = [
        ['min' => 0,    'max' => 100,  'slug' => 'new_builder',    'label' => 'New Builder',    'emoji' => '🌱'],
        ['min' => 100,  'max' => 300,  'slug' => 'active_builder', 'label' => 'Active Builder', 'emoji' => '⚡'],
        ['min' => 300,  'max' => 700,  'slug' => 'rising_builder', 'label' => 'Rising Builder', 'emoji' => '🚀'],
        ['min' => 700,  'max' => 1500, 'slug' => 'pro_builder',    'label' => 'Pro Builder',    'emoji' => '🔥'],
        ['min' => 1500, 'max' => PHP_INT_MAX, 'slug' => 'elite_builder', 'label' => 'Elite Builder', 'emoji' => '👑'],
    ];

    public function getLevel(Creatif $creatif): array
    {
        $score = $creatif->builder_score ?? 0;
        foreach (self::LEVELS as $level) {
            if ($score >= $level['min'] && $score < $level['max']) {
                return $level;
            }
        }
        return self::LEVELS[count(self::LEVELS) - 1];
    }

    public function getNextLevel(Creatif $creatif): ?array
    {
        $score = $creatif->builder_score ?? 0;
        foreach (self::LEVELS as $i => $level) {
            if ($score >= $level['min'] && $score < $level['max']) {
                return self::LEVELS[$i + 1] ?? null;
            }
        }
        return null;
    }

    public function getProgress(Creatif $creatif): int
    {
        $current = $this->getLevel($creatif);
        $next = $this->getNextLevel($creatif);
        if (!$next) return 100;
        $range = $next['min'] - $current['min'];
        $progress = ($creatif->builder_score ?? 0) - $current['min'];
        return min(100, (int)(($progress / $range) * 100));
    }

    public function getTopPercentage(Creatif $creatif): int
    {
        $total = Creatif::count();
        if ($total === 0) return 100;
        $rank = Creatif::where('builder_score', '>', $creatif->builder_score ?? 0)->count() + 1;
        return max(1, (int)(($rank / $total) * 100));
    }

    public function addPoints(Creatif $creatif, string $action): void
    {
        $points = [
            'new_project'      => 20,
            'update_project'   => 5,
            'demo_added'       => 10,
            'github_added'     => 8,
            'project_like'     => 1,
            'project_comment'  => 3,
            'project_trending' => 10,
            'mission_done'     => 50,
            'streak_7_days'    => 10,
            'streak_30_days'   => 50,
            'profile_complete' => 30,
        ][$action] ?? 0;

        if ($points > 0) {
            $creatif->increment('builder_score', $points);
            $this->refreshLevel($creatif->fresh());
        }
    }

    private function refreshLevel(Creatif $creatif): void
    {
        $level = $this->getLevel($creatif);
        $creatif->update(['builder_level' => $level['slug']]);
    }
}