<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'gambar_path',
        'caption', 'caption_en', 'caption_jp',
        'created_by', 'updated_by', 'is_active'
    ];

    // === ACCESSOR ===
    public function getCaptionAttribute($value)
    {
        $locale = App::getLocale();
        return $this->{"caption_{$locale}"} ?? $value;
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

    // === AUTO TRANSLATE ===
    public function getTranslated(string $field, string $lang = 'id'): ?string
    {
        $translatable = ['caption'];
        if (!in_array($field, $translatable)) return $this->{$field};

        $suffix = $lang === 'en' ? '_en' : ($lang === 'ja' ? '_jp' : '');
        $column = $field . $suffix;
        return $this->{$column} ?? $this->{$field};
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->translateFields();
        });
    }

    private function translateFields()
    {
        $translator = app(\App\Services\TranslationService::class);
        $value = $this->caption;

        if ($value) {
            $this->caption_en = $translator->translate($value, 'en');
            $this->caption_jp = $translator->translate($value, 'ja');
        } else {
            $this->caption_en = null;
            $this->caption_jp = null;
        }
    }
}