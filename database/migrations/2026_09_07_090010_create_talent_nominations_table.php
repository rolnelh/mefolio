<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talent_nominations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('creatif_name');
            $table->string('contact_email')->nullable();
            $table->text('reason');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talent_nominations');
    }
};
