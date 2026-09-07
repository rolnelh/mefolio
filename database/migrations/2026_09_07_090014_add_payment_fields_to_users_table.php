<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('payment_methods')->nullable()->after('social_links');
            $table->string('payment_phone_prefix')->nullable()->after('payment_methods');
            $table->string('payment_phone')->nullable()->after('payment_phone_prefix');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['payment_methods', 'payment_phone_prefix', 'payment_phone']);
        });
    }
};
