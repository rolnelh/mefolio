<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mission_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('message');
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->timestamps();
            $table->unique(['mission_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_applications');
    }
};
