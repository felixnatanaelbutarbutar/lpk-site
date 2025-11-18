<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_en')->nullable();
            $table->string('nama_jp')->nullable();

            $table->text('visi')->nullable();
            $table->text('visi_en')->nullable();
            $table->text('visi_jp')->nullable();

            $table->text('misi')->nullable();
            $table->text('misi_en')->nullable();
            $table->text('misi_jp')->nullable();

            $table->longText('sejarah')->nullable();
            $table->longText('sejarah_en')->nullable();
            $table->longText('sejarah_jp')->nullable();

            $table->string('direktur')->nullable();
            $table->date('tanggal_pendirian')->nullable();
            $table->string('akta_perubahan')->nullable();
            $table->string('sk')->nullable();
            $table->string('izin_dinas_sosial')->nullable();
            $table->string('izin_dinas_ketenagakerjaan')->nullable();
            $table->string('perizinan_berusaha')->nullable(); // NIB
            $table->string('akreditasi')->nullable();
            $table->string('kementrian_ketenagakerjaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('website')->nullable();

            $table->text('alamat')->nullable();
            $table->text('alamat_en')->nullable();
            $table->text('alamat_jp')->nullable();

            $table->string('logo_path')->nullable();
            
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        // Insert 1 data default
        DB::table('profile')->insert([
            'nama' => 'Nama LKP Anda',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('profile');
    }
};