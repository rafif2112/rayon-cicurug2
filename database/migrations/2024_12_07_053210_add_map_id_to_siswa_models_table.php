<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa_models', function (Blueprint $table) {
            $table->unsignedBigInteger('map_id')->nullable()->after('id');
            $table->foreign('map_id')->references('id')->on('maps')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('siswa_models', function (Blueprint $table) {
            $table->dropForeign(['map_id']);
            $table->dropColumn('map_id');
        });
    }
};