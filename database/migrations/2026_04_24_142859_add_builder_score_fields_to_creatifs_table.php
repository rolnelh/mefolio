<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('creatifs', function (Blueprint $table) {
            if (!Schema::hasColumn('creatifs', 'builder_score'))
                $table->integer('builder_score')->default(0);
            if (!Schema::hasColumn('creatifs', 'builder_level'))
                $table->string('builder_level')->default('new_builder');
            if (!Schema::hasColumn('creatifs', 'available_for_work'))
                $table->boolean('available_for_work')->default(true);
            if (!Schema::hasColumn('creatifs', 'streak_days'))
                $table->integer('streak_days')->default(0);
            if (!Schema::hasColumn('creatifs', 'skills'))
                $table->json('skills')->nullable();
            if (!Schema::hasColumn('creatifs', 'visibility'))
                $table->string('visibility')->default('public');
        });

        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'views_count'))
                $table->integer('views_count')->default(0);
            if (!Schema::hasColumn('projects', 'likes_count'))
                $table->integer('likes_count')->default(0);
            if (!Schema::hasColumn('projects', 'is_trending'))
                $table->boolean('is_trending')->default(false);
        });

        if (!Schema::hasTable('project_likes')) {
            Schema::create('project_likes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('project_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['user_id', 'project_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('creatifs', function (Blueprint $table) {
            $table->dropColumn(['builder_score', 'builder_level', 'available_for_work', 'streak_days', 'skills', 'visibility']);
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['views_count', 'likes_count', 'is_trending']);
        });
        Schema::dropIfExists('project_likes');
    }
};