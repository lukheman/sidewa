<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('anggaran_desas', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_anggaran');
            $table->enum('kategori', ['pendapatan', 'belanja']);
            $table->string('uraian');
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggaran_desas');
    }
};
