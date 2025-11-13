<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_galeri_table.php
public function up()
{
    Schema::create('galeri', function (Blueprint $table) {
        $table->id();
        $table->string('gambar_path');
        $table->string('caption')->nullable();
        $table->string('caption_en')->nullable();
        $table->string('caption_jp')->nullable();
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
        Schema::dropIfExists('galeri');
    }
};
