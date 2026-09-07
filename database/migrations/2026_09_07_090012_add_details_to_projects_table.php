<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('technologies')->nullable()->after('image');
            $table->string('lien_site')->nullable()->after('technologies');
            $table->string('lien_github')->nullable()->after('lien_site');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['category', 'technologies', 'lien_site', 'lien_github']);
        });
    }
};
