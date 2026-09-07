<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('creatifs', function (Blueprint $table) {
            $table->unsignedInteger('builder_score')->default(0)->after('couverture');
            $table->string('builder_level')->default('new_builder')->after('builder_score');
            $table->boolean('available_for_work')->default(true)->after('builder_level');
        });
    }

    public function down(): void
    {
        Schema::table('creatifs', function (Blueprint $table) {
            $table->dropColumn(['builder_score', 'builder_level', 'available_for_work']);
        });
    }
};
