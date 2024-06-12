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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('nota');
            $table->string('tahun_ajaran', 100);
            $table->date('tanggal_bayar');
            $table->foreignId('student_id')->constrained(
                table: 'students',
                indexName: 'transactions_student_id'
            );
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
        Schema::dropIfExists('transactions');
    }
};
