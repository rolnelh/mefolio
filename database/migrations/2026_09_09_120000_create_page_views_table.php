<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            // Chemin visité (ex. "/projects"), sans le domaine ni la query string.
            $table->string('path');
            // Nom d'hôte du référent externe (ex. "google.com"), null si accès
            // direct ou navigation interne au site — voir TrackPageView::refererHost().
            $table->string('referrer_host')->nullable();
            $table->timestamps();

            $table->index('path');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
