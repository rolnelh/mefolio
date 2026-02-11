<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('creatifs', function (Blueprint $table) {
        // On ajoute le champ après la photo, il peut être nul (nullable)
        $table->string('couverture')->nullable()->after('photo');
    });
}

public function down(): void
{
    Schema::table('creatifs', function (Blueprint $table) {
        $table->dropColumn('couverture');
    });
}
};
