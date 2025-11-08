<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\TranslationService;

class PendaftaranSiswa extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_siswa';

    protected $fillable = [
        // Data utama
        'nama_lengkap',
        'nama_lengkap_en',
        'nama_lengkap_jp',

        'tempat_lahir',
        'tempat_lahir_en',
        'tempat_lahir_jp',

        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan_terakhir',

        // Alamat
        'alamat_ktp',
        'alamat_ktp_en',
        'alamat_ktp_jp',

        // Bahasa Jepang
        'pernah_belajar_bahasa_jepang',
        'tempat_belajar_bahasa',

        // Ke Jepang
        'pernah_ke_jepang',

        // Tujuan dan sumber info
        'tujuan_ke_jepang',
        'tujuan_ke_jepang_en',
        'tujuan_ke_jepang_jp',

        'sumber_info',
        'sumber_info_en',
        'sumber_info_jp',

        // Lainnya
        'nomor_whatsapp',
        'foto_ktp_path',
        'created_by',
        'updated_by',
        'is_active',
    ];

    // Relasi: siapa yang membuat
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi: siapa yang mengubah terakhir
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Helper untuk mendapatkan teks berdasarkan bahasa yang aktif
     * contoh: $pendaftaran->getTranslated('nama_lengkap', 'jp');
     */
    // app/Models/PendaftaranSiswa.php
    // app/Models/PendaftaranSiswa.php
        public function getTranslated(string $field, string $lang = 'id'): ?string
    {
            // Hanya terjemahkan field yang memang punya kolom _en / _jp
            $translatable = ['tujuan_ke_jepang', 'sumber_info'];

            if (!in_array($field, $translatable)) {
                return $this->{$field};
            }

            $suffix = $lang === 'en' ? '_en' : ($lang === 'ja' ? '_jp' : '');
            $column = $field . $suffix;

            return $this->{$column} ?? $this->{$field};
        }
    protected static function booted()
{
    static::creating(function ($model) {
        $translator = new TranslationService();

        // Field yang perlu diterjemahkan
        $translatable = [
            'nama_lengkap',
            'tempat_lahir',
            'alamat_ktp',
            'tujuan_ke_jepang',
            'sumber_info',
        ];

        foreach ($translatable as $field) {
            $value = $model->{$field};
            if ($value) {
                // English
                $model->{"{$field}_en"} = $translator->translate($value, 'en');
                // Japanese
                $model->{"{$field}_jp"} = $translator->translate($value, 'ja');
            }
        }   
    });

    static::updating(function ($model) {
        $translator = new TranslationService();
        $translatable = [
            'nama_lengkap',
            'tempat_lahir',
            'alamat_ktp',
            'tujuan_ke_jepang',
            'sumber_info',
        ];

        foreach ($translatable as $field) {
            if ($model->isDirty($field)) {
                $value = $model->{$field};
                if ($value) {
                    $model->{"{$field}_en"} = $translator->translate($value, 'en');
                    $model->{"{$field}_jp"} = $translator->translate($value, 'ja');
                } else {
                    $model->{"{$field}_en"} = null;
                    $model->{"{$field}_jp"} = null;
                }
            }
        }
    });
}
}
