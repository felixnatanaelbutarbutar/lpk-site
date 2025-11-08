<?php
// app/Helpers/langHelper.php

if (! function_exists('translateText')) {
    /**
     * Terjemahkan teks menggunakan Argos OpenTech (gratis) dengan caching.
     *
     * @param string $text        Teks sumber (diasumsikan berbahasa 'id')
     * @param string|null $target Target language code ('en'|'ja'|'id'). Jika null -> gunakan app locale.
     * @param int $ttl            Cache TTL dalam detik (default 24 jam)
     * @return string
     */
    function translateText(string $text, ?string $target = null, int $ttl = 86400): string
    {
        $text = trim((string) $text);
        if ($text === '') {
            return $text;
        }

        // jika target tidak diberikan, ambil dari locale aplikasi
        $target = $target ?: app()->getLocale();

        // jika target sama dengan sumber (id) kembalikan langsung
        if ($target === 'id' || $target === 'id_ID') {
            return $text;
        }

        // key cache: pastikan unik per teks dan target
        $cacheKey = 'translate:' . md5($target . '|' . $text);

        // gunakan cache untuk menghindari rate limit
        try {
            return \Illuminate\Support\Facades\Cache::remember($cacheKey, $ttl, function () use ($text, $target) {
                $payload = [
                    'q' => $text,
                    'source' => 'id',
                    'target' => $target,
                ];

                // Panggil API Argos OpenTech (gratis)
                $response = \Illuminate\Support\Facades\Http::post('https://translate.argosopentech.com/translate', $payload);

                if ($response->successful()) {
                    $json = $response->json();

                    // Argos biasanya mengembalikan: ['translatedText' => '...']
                    if (isset($json['translatedText']) && $json['translatedText']) {
                        return (string) $json['translatedText'];
                    }

                    // fallback: coba struktur lain
                    if (isset($json[0][0][0])) {
                        return (string) $json[0][0][0];
                    }
                }

                // fallback = teks asli
                return $text;
            });
        } catch (\Throwable $e) {
            // Kalau error (network/rate limit), jangan crash — kembalikan teks asli
            return $text;
        }
    }
}

if (! function_exists('translateField')) {
    /**
     * Ambil isi field pada model sesuai dengan bahasa aktif.
     *
     * Logika:
     * 1. Jika ada kolom explicit (field_en / field_jp) -> pakai itu.
     * 2. Jika ada kolom 'translations' (json) dan memuat key -> pakai itu.
     * 3. Jika target == 'id' -> kembalikan field asli.
     * 4. Jika tidak tersedia -> panggil translateText() untuk menerjemahkan on-the-fly (dan otomatis tercache).
     *
     * @param \Illuminate\Database\Eloquent\Model|array $model  Model Eloquent atau array data
     * @param string $field Nama field base (mis. "nama_lengkap" -> akan check "nama_lengkap_en", "nama_lengkap_jp")
     * @param string|null $target Lang target (jika null pakai app locale)
     * @return string
     */
    function translateField($model, string $field, ?string $target = null): string
    {
        $target = $target ?: app()->getLocale();
        $target = ($target === 'ja' ? 'jp' : $target); // kita pakai suffix _jp, bukan _ja

        // helper untuk akses properti aman (model bisa array atau object)
        $get = function ($m, $k) {
            if (is_array($m)) return $m[$k] ?? null;
            if (is_object($m)) return $m->{$k} ?? null;
            return null;
        };

        // 1) cek explicit column (mis. nama_lengkap_en / nama_lengkap_jp)
        $suffix = ($target === 'en') ? '_en' : ($target === 'jp' ? '_jp' : '');
        if ($suffix) {
            $col = $field . $suffix;
            $val = $get($model, $col);
            if (! empty($val)) {
                return (string) $val;
            }
        }

        // 2) cek kalau ada kolom translations JSON (contoh: $model->translations = '{"nama_lengkap":{"en":"...","ja":"..."}}')
        $translations = $get($model, 'translations');
        if ($translations) {
            // jika string JSON, decode
            if (is_string($translations)) {
                $decoded = json_decode($translations, true);
            } else {
                $decoded = $translations;
            }

            if (is_array($decoded) && isset($decoded[$field])) {
                // pindahkan key 'ja' ke 'jp' jika perlu
                $mapKey = $target === 'jp' ? ( $decoded[$field]['ja'] ?? null) : ($decoded[$field][$target] ?? null);
                if (! empty($mapKey)) {
                    return (string) $mapKey;
                }
            }
        }

        // 3) ambil nilai asli
        $original = $get($model, $field) ?? '';

        // jika target adalah bahasa Indonesia atau tidak perlu translate, kembalikan asli
        if ($target === 'id' || $target === 'id_ID' || $target === '') {
            return (string) $original;
        }

        // 4) terakhir: terjemahkan on-the-fly via translateText (dengan cache)
        return translateText((string) $original, $target);
    }
}
