<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa_models', function (Blueprint $table) {
            $table->string('slug')->unique()->after('nama')->nullable();
        });
    }

    public function down()
    {
        Schema::table('siswa_models', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};