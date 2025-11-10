<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PendaftaranSiswaController extends Controller
{
    public function index()
    {
        $pendaftaran = PendaftaranSiswa::where('created_by', Auth::id())
            ->latest()
            ->get();

        return view('user.pendaftaran.index', compact('pendaftaran'));
    }

    public function create()
    {
        return view('user.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program' => 'required|in:GINOU JISSHUUSEI,TOKUTEI GINOU (MANDIRI)',
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

        PendaftaranSiswa::create([
            'program' => $request->program,
            'status' => 'pending',

            // DATA ASLI (TIDAK DITERJEMAHKAN)
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat_ktp' => $request->alamat_ktp,

            // DATA YANG DITERJEMAHKAN (otomatis di model)
            'tujuan_ke_jepang' => $request->tujuan_ke_jepang,
            'sumber_info' => $request->sumber_info,

            // LAINNYA
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

        return redirect()
            ->route('pendaftaran.index', ['lang' => app()->getLocale()])
            ->with('success', translateText('Pendaftaran berhasil disimpan!'));
    }

    // === EDIT ===
    public function edit(PendaftaranSiswa $pendaftaran)
    {
        $this->authorizeUser($pendaftaran);

        return view('user.pendaftaran.edit', compact('pendaftaran'));
    }

    // === UPDATE ===
    public function update(Request $request, PendaftaranSiswa $pendaftaran)
    {
        $this->authorizeUser($pendaftaran);

        $request->validate([
            'program' => 'required|in:GINOU JISSHUUSEI,TOKUTEI GINOU (MANDIRI)',
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

        $fotoPath = $pendaftaran->foto_ktp_path;
        if ($request->hasFile('foto_ktp')) {
            // Hapus foto lama
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto_ktp')->store('foto_ktp', 'public');
        }

        $pendaftaran->update([
            'program' => $request->program,

            // ASLI
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat_ktp' => $request->alamat_ktp,

            // TERJEMAHKAN (otomatis di model)
            'tujuan_ke_jepang' => $request->tujuan_ke_jepang,
            'sumber_info' => $request->sumber_info,

            // LAINNYA
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'pernah_belajar_bahasa_jepang' => $request->pernah_belajar_bahasa_jepang,
            'tempat_belajar_bahasa' => $request->tempat_belajar_bahasa,
            'pernah_ke_jepang' => $request->pernah_ke_jepang,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'foto_ktp_path' => $fotoPath,
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('pendaftaran.index', ['lang' => app()->getLocale()])
            ->with('success', translateText('Pendaftaran berhasil diperbarui!'));
    }

    // === DELETE ===
    public function destroy(PendaftaranSiswa $pendaftaran)
    {
        $this->authorizeUser($pendaftaran);

        if ($pendaftaran->foto_ktp_path) {
            Storage::disk('public')->delete($pendaftaran->foto_ktp_path);
        }

        $pendaftaran->delete();

        return redirect()
            ->route('pendaftaran.index', ['lang' => app()->getLocale()])
            ->with('success', translateText('Pendaftaran berhasil dihapus!'));
    }

    // === CEK KEPEMILIKAN ===
    private function authorizeUser(PendaftaranSiswa $pendaftaran)
    {
        if ($pendaftaran->created_by !== Auth::id()) {
            abort(403, translateText('Aksi tidak diizinkan.'));
        }
    }
}