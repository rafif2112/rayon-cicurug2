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
        Schema::table('siswa_models', function (Blueprint $table) {
            $table->text('deskripsi')->nullable();
            $table->json('sertifikat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_models', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('sertifikat');
        });
    }
};
