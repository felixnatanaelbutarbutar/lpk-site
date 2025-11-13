<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function translate($text, $targetLang, $sourceLang = 'id')
    {
        if (empty($text)) return null;

        $cacheKey = "translate:{$sourceLang}:{$targetLang}:" . md5($text);

        return Cache::remember($cacheKey, now()->addDay(), function () use ($text, $sourceLang, $targetLang) {
            $url = 'https://translate.googleapis.com/translate_a/single';

            try {
                $response = $this->client->get($url, [
                    'query' => [
                        'client' => 'gtx',
                        'sl' => $sourceLang,
                        'tl' => $targetLang,
                        'dt' => 't',
                        'q' => $text
                    ],
                    'timeout' => 10
                ]);

                $result = json_decode($response->getBody(), true);
                $translated = $result[0][0][0] ?? $text;

                if ($translated !== $text) {
                    Log::info("Translated: '$text' → '$translated' ($targetLang)");
                }

                return $translated;

            } catch (\Exception $e) {
                Log::warning("Translate failed: " . $e->getMessage());
                return $text;
            }
        });
    }
}