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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 10)->unique();
            $table->string('name', 50);
            $table->foreignId('class_id')->constrained(
                table: 'class_rooms',
                indexName: 'class_id'
            );
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->string('telp', 20);
            $table->integer('tahun_masuk');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->integer('spp1')->default(0);
            $table->integer('spp2')->default(0);
            $table->integer('spp3')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
