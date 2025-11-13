<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_path')->nullable();

            // NAMA (asli + terjemahan)
            $table->string('nama');           // Input admin (ID)
            $table->string('nama_en')->nullable();
            $table->string('nama_jp')->nullable();

            // DESKRIPSI (asli + terjemahan)
            $table->text('deskripsi');        // Input admin (ID)
            $table->text('deskripsi_en')->nullable();
            $table->text('deskripsi_jp')->nullable();

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};