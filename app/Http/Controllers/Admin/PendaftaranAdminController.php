<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranAdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $pendaftaran = PendaftaranSiswa::with('creator')
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(15);

        return view('admin.pendaftaran.index', compact('pendaftaran', 'status'));
    }

    public function approve(PendaftaranSiswa $pendaftaran)
    {
        $pendaftaran->update([
            'status' => 'approved',
            'updated_by' => Auth::id(),
        ]);

        return back()->with('success', translateText('Pendaftaran disetujui!'));
    }

    public function reject(PendaftaranSiswa $pendaftaran)
    {
        $pendaftaran->update([
            'status' => 'rejected',
            'updated_by' => Auth::id(),
        ]);

        return back()->with('success', translateText('Pendaftaran ditolak!'));
    }
}