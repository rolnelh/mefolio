<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('full_name')->nullable();
            $table->string('country')->nullable();
            $table->string('type')->nullable();
            $table->text('description');
            $table->json('tags')->nullable();
            $table->string('url')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('active'); // active, archived
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
