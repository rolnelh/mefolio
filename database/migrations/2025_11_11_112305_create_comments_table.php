<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // auteur du commentaire
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // projet concerné
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // pour les réponses
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
