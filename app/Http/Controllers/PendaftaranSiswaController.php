<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache; // SUDAH ADA

class PendaftaranSiswaController extends Controller
{
    public function create()
    {
        return view('user.pendaftaran.create');
    }

    public function index()
    {
        $pendaftaran = PendaftaranSiswa::where('created_by', Auth::id())
            ->latest()
            ->get();

        return view('user.pendaftaran.index', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pendidikan_terakhir' => 'required|in:SMA,SMK,D1,D2,D3,D4,S1',
            'alamat_ktp' => 'required|string',
            'pernah_belajar_bahasa_jepang' => 'required|in:Pernah,Tidak Pernah',
            'tempat_belajar_bahasa' => 'nullable|string|max:255',
            'pernah_ke_jepang' => 'required|in:Pernah,Tidak Pernah',
            'tujuan_ke_jepang' => 'required|string|max:1000',
            'sumber_info' => 'required|string|max:1000',
            'nomor_whatsapp' => 'required|string|max:20',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto_ktp')
            ? $request->file('foto_ktp')->store('foto_ktp', 'public')
            : null;

        $translatable = [
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat_ktp' => $request->alamat_ktp,
            'tujuan_ke_jepang' => $request->tujuan_ke_jepang,
            'sumber_info' => $request->sumber_info,
        ];

        $translated = $this->translateBatch($translatable);

        PendaftaranSiswa::create([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat_ktp' => $request->alamat_ktp,
            'tujuan_ke_jepang' => $request->tujuan_ke_jepang,
            'sumber_info' => $request->sumber_info,

            'nama_lengkap_en' => $translated['nama_lengkap']['en'] ?? $request->nama_lengkap,
            'tempat_lahir_en' => $translated['tempat_lahir']['en'] ?? $request->tempat_lahir,
            'alamat_ktp_en' => $translated['alamat_ktp']['en'] ?? $request->alamat_ktp,
            'tujuan_ke_jepang_en' => $translated['tujuan_ke_jepang']['en'] ?? $request->tujuan_ke_jepang,
            'sumber_info_en' => $translated['sumber_info']['en'] ?? $request->sumber_info,

            'nama_lengkap_jp' => $translated['nama_lengkap']['ja'] ?? $request->nama_lengkap,
            'tempat_lahir_jp' => $translated['tempat_lahir']['ja'] ?? $request->tempat_lahir,
            'alamat_ktp_jp' => $translated['alamat_ktp']['ja'] ?? $request->alamat_ktp,
            'tujuan_ke_jepang_jp' => $translated['tujuan_ke_jepang']['ja'] ?? $request->tujuan_ke_jepang,
            'sumber_info_jp' => $translated['sumber_info']['ja'] ?? $request->sumber_info,

            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'pernah_belajar_bahasa_jepang' => $request->pernah_belajar_bahasa_jepang,
            'tempat_belajar_bahasa' => $request->tempat_belajar_bahasa,
            'pernah_ke_jepang' => $request->pernah_ke_jepang,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'foto_ktp_path' => $fotoPath,
            'created_by' => Auth::id(),
            'is_active' => true,
        ]);

        $lang = app()->getLocale();

        return redirect()
            ->route('pendaftaran.index', ['lang' => $lang])
            ->with('success', 'Pendaftaran berhasil disimpan & diterjemahkan!');
    }

    private function translateBatch(array $texts): array
    {
        $result = [];

        foreach ($texts as $key => $text) {
            if (empty(trim($text))) {
                $result[$key] = ['en' => $text, 'ja' => $text];
                continue;
            }

            try {
                $en = $this->translateSingle($text, 'en');
                $ja = $this->translateSingle($text, 'ja');
                $result[$key] = ['en' => $en, 'ja' => $ja];
            } catch (\Exception $e) {
                Log::warning("Translation failed for {$key}: " . $e->getMessage());
                $result[$key] = ['en' => $text, 'ja' => $text];
            }
        }

        return $result;
    }

    private function translateSingle(string $text, string $target): string
    {
        $cacheKey = "translate_{$target}_" . md5($text);

        // GANTI \Cache → Cache
        return Cache::remember($cacheKey, now()->addHours(24), function () use ($text, $target) {
            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post('https://translate.argosopentech.com/translate', [
                    'q' => $text,
                    'source' => 'id',
                    'target' => $target,
                    'format' => 'text'
                ]);

            if ($response->successful()) {
                return $response->json('translatedText') ?? $text;
            }

            Log::warning("Argos Translate failed", [
                'text' => $text,
                'target' => $target,
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return $text;
        });
    }
}