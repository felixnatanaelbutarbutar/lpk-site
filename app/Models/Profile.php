<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'nama','nama_en','nama_jp',
        'visi','visi_en','visi_jp',
        'misi','misi_en','misi_jp',
        'sejarah','sejarah_en','sejarah_jp',
        'direktur','tanggal_pendirian','akta_perubahan','sk',
        'izin_dinas_sosial','izin_dinas_ketenagakerjaan','perizinan_berusaha',
        'akreditasi','kementrian_ketenagakerjaan','npwp','website',
        'alamat','alamat_en','alamat_jp',
        'logo_path',
        'created_by','updated_by'
    ];

    protected $dates = ['tanggal_pendirian'];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    // Auto Translate Field
    public function getTranslated(string $field, string $lang = 'id'): ?string
    {
        $lang = $lang ?? app()->getLocale();
        $translatable = ['nama', 'visi', 'misi', 'sejarah', 'alamat'];

        if (!in_array($field, $translatable)) {
            return $this->{$field};
        }

        $suffix = $lang === 'en' ? '_en' : ($lang === 'ja' ? '_jp' : '');
        $column = $field . $suffix;

        return $this->{$column} ?? $this->{$field};
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $translator = app(\App\Services\TranslationService::class);
            $fields = ['nama', 'visi', 'misi', 'sejarah', 'alamat'];

            foreach ($fields as $field) {
                $value = $model->{$field};
                if ($value) {
                    $model->{"{$field}_en"} = $translator->translate($value, 'en');
                    $model->{"{$field}_jp"} = $translator->translate($value, 'ja');
                } else {
                    $model->{"{$field}_en"} = null;
                    $model->{"{$field}_jp"} = null;
                }
            }
        });
    }
    
}