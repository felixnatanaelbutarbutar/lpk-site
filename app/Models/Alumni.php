<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'foto_path',
        'nama',
        'program',
        'tahun_lulus',
        'pesan', 'pesan_en', 'pesan_jp',
        'created_by', 'updated_by', 'is_active'
    ];

    protected $casts = [
        'program' => 'string',
        'tahun_lulus' => 'integer',
        'is_active' => 'boolean',
    ];

    // === RELASI ===
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // === TRANSLATE FIELD (HANYA PESAN) ===
    public function getTranslated(string $field, string $lang = null): ?string
    {
        $lang = $lang ?? app()->getLocale();

        // Hanya pesan yang diterjemahkan
        if ($field !== 'pesan') {
            return $this->{$field};
        }

        $suffix = $lang === 'en' ? '_en' : ($lang === 'ja' ? '_jp' : '');
        $column = $field . $suffix;

        return $this->{$column} ?? $this->{$field};
    }

    // === AUTO TRANSLATE HANYA PESAN ===
    protected static function booted()
    {
        static::saving(function ($model) {
            $model->translatePesan();
        });
    }

    private function translatePesan()
    {
        $translator = app(\App\Services\TranslationService::class);
        $value = $this->pesan;

        if ($value) {
            $this->pesan_en = $translator->translate($value, 'en');
            $this->pesan_jp = $translator->translate($value, 'ja');
        } else {
            $this->pesan_en = null;
            $this->pesan_jp = null;
        }
    }

    // === HELPER: PROGRAM TERJEMAHAN ===
    public function getProgramLabelAttribute(): string
    {
        $locale = app()->getLocale();
        $map = [
            'GINOU JISSHUUSEI' => [
                'id' => 'Ginou Jisshuusei',
                'en' => 'Technical Intern Training',
                'ja' => '技能実習生'
            ],
            'TOKUTEI GINOU (MANDIRI)' => [
                'id' => 'Tokutei Ginou (Mandiri)',
                'en' => 'Specified Skilled Worker (Independent)',
                'ja' => '特定技能（独立）'
            ],
        ];

        return $map[$this->program][$locale] ?? $map[$this->program]['id'] ?? $this->program;
    }
}