<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password');
            $t->string('phone')->nullable();
            $t->string('nik')->nullable();
            $t->string('birth_place')->nullable();
            $t->date('birth_date')->nullable();
            $t->enum('gender', ['male', 'female', 'other'])->nullable();
            $t->text('address')->nullable();
            $t->string('city')->nullable();
            $t->string('province')->nullable();
            $t->string('postal_code')->nullable();
            $t->string('education_level')->nullable();
            $t->string('emergency_contact_name')->nullable();
            $t->string('emergency_contact_phone')->nullable();

            // kontrol aktif/nonaktif akun
            $t->boolean('is_active')->default(true);
            $t->foreignId('deleted_by')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $t->rememberToken();
            $t->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
