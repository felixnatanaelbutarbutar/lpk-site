<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pendaftaran_siswa', function (Blueprint $table) {
            $table->id();

            // --- Program yang dipilih ---
            $table->enum('program', [
                'GINOU JISSHUUSEI',
                'TOKUTEI GINOU (MANDIRI)'
            ])->default('GINOU JISSHUUSEI');

            // --- Data dasar (hanya asli, tidak diterjemahkan) ---
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('pendidikan_terakhir', ['SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1']);

            // --- Alamat (hanya asli) ---
            $table->text('alamat_ktp');

            // --- Belajar bahasa Jepang ---
            $table->enum('pernah_belajar_bahasa_jepang', ['Pernah', 'Tidak Pernah']);
            $table->string('tempat_belajar_bahasa')->nullable();

            // --- Pengalaman ke Jepang ---
            $table->enum('pernah_ke_jepang', ['Pernah', 'Tidak Pernah']);
            
            // --- Tujuan dan sumber info (diterjemahkan) ---
            $table->string('tujuan_ke_jepang');
            $table->string('tujuan_ke_jepang_en')->nullable();
            $table->string('tujuan_ke_jepang_jp')->nullable();

            $table->string('sumber_info');
            $table->string('sumber_info_en')->nullable();
            $table->string('sumber_info_jp')->nullable();

            // --- Kontak dan file ---
            $table->string('nomor_whatsapp');
            $table->string('foto_ktp_path')->nullable();

            // --- Status pendaftaran (Admin) ---
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->index(); // untuk performa filter

            // --- Tracking ---
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_siswa');
    }
};