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
        Schema::table('masyarakat', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('nik');
            $table->string('agama', 50)->nullable()->after('tanggal_lahir');
            $table->string('pekerjaan')->nullable()->after('agama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masyarakat', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'agama', 'pekerjaan']);
        });
    }
};
