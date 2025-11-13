<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_alumni_table.php
public function up()
{
    Schema::create('alumni', function (Blueprint $table) {
        $table->id();
        $table->string('foto_path')->nullable();
        $table->string('nama');
        $table->enum('program', [
            'GINOU JISSHUUSEI',
            'TOKUTEI GINOU (MANDIRI)'
        ])->default('GINOU JISSHUUSEI');
        $table->year('tahun_lulus');
        $table->text('pesan')->nullable();
        $table->text('pesan_en')->nullable();
        $table->text('pesan_jp')->nullable();
        $table->foreignId('created_by')->constrained('users');
        $table->foreignId('updated_by')->nullable()->constrained('users');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
