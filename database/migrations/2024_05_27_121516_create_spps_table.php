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
        Schema::create('spps', function (Blueprint $table) {
            $table->id();
            $table->integer('spp1')->default(0);
            $table->integer('spp2')->default(0);
            $table->integer('spp3')->default(0);
            $table->string('tahun_ajaran', 5);
            $table->string('tahun_ajaran1', 5);
            $table->string('tahun_ajaran2', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spps');
    }
};
