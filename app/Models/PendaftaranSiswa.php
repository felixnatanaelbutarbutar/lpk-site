<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranSiswa extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_siswa';

    protected $fillable = [
        // Program & Status
        'program',
        'status',

        // Data dasar (asli)
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan_terakhir',

        // Alamat (asli)
        'alamat_ktp',

        // Bahasa Jepang
        'pernah_belajar_bahasa_jepang',
        'tempat_belajar_bahasa',

        // Ke Jepang
        'pernah_ke_jepang',

        // Tujuan & sumber info (diterjemahkan)
        'tujuan_ke_jepang',
        'tujuan_ke_jepang_en',
        'tujuan_ke_jepang_jp',
        'sumber_info',
        'sumber_info_en',
        'sumber_info_jp',

        // Kontak & file
        'nomor_whatsapp',
        'foto_ktp_path',

        // Tracking
        'created_by',
        'updated_by',
        'is_active',
    ];

    // Relasi
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Hanya tujuan & sumber info yang diterjemahkan
     */
    public function getTranslated(string $field, string $lang = 'id'): ?string
    {
        $translatable = ['tujuan_ke_jepang', 'sumber_info'];

        if (!in_array($field, $translatable)) {
            return $this->{$field};
        }

        $suffix = $lang === 'en' ? '_en' : ($lang === 'ja' ? '_jp' : '');
        $column = $field . $suffix;

        return $this->{$column} ?? $this->{$field};
    }

    // === AUTO TRANSLATE SAAT CREATE & UPDATE ===
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->translateFields();
        });

        static::updating(function ($model) {
            $model->translateFields();
        });
    }

    private function translateFields()
    {
        $translator = app(\App\Services\TranslationService::class);
        $fields = ['tujuan_ke_jepang', 'sumber_info'];

        foreach ($fields as $field) {
            $value = $this->{$field};
            if ($value) {
                $this->{"{$field}_en"} = $translator->translate($value, 'en');
                $this->{"{$field}_jp"} = $translator->translate($value, 'ja');
            } else {
                $this->{"{$field}_en"} = null;
                $this->{"{$field}_jp"} = null;
            }
        }
    }
}