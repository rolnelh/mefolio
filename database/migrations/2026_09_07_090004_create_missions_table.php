<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('domaine')->nullable();
            $table->unsignedInteger('budget_min')->nullable();
            $table->unsignedInteger('budget_max')->nullable();
            $table->string('duree')->nullable();
            $table->string('niveau')->nullable();
            $table->string('lieu')->nullable();
            $table->boolean('remote')->default(true);
            $table->boolean('urgent')->default(false);
            $table->json('tags')->nullable();
            $table->string('status')->default('open'); // open, in_progress, completed, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
