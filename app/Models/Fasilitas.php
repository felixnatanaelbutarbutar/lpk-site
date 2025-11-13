<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class Fasilitas extends Model
{
    protected $fillable = [
        'gambar_path',
        'nama', 'nama_en', 'nama_jp',
        'deskripsi', 'deskripsi_en', 'deskripsi_jp',
        'created_by', 'updated_by', 'is_active'
    ];

    // === ACCESSOR: Nama & Deskripsi Multibahasa ===
    public function getNamaAttribute($value)
    {
        $locale = App::getLocale();
        return $this->{"nama_{$locale}"} ?? $value;
    }

    public function getDeskripsiAttribute($value)
    {
        $locale = App::getLocale();
        return $this->{"deskripsi_{$locale}"} ?? $value;
    }

    // === RELASI ===
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // === AUTO TRANSLATE SAAT CREATE & UPDATE ===
    public function getTranslated(string $field, string $lang = 'id'): ?string
    {
        $translatable = ['nama', 'deskripsi'];

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
        $fields = ['nama', 'deskripsi'];

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
