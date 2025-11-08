<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;   // TAMBAHKAN INI

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

        $url = 'https://api.mymemory.translated.net/get';
        
        try {
            $response = $this->client->get($url, [
                'query' => [
                    'q' => $text,
                    'langpair' => "{$sourceLang}|{$targetLang}"
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['responseData']['translatedText'] ?? $text;
        } catch (\Exception $e) {
            Log::warning("Translation failed: " . $e->getMessage());  // Sekarang jalan
            return $text;
        }
    }
}