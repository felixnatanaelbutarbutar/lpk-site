{{-- resources/views/user/pendaftaran/index.blade.php --}}
@extends('layouts.user.layout')

@section('page-title', translateText('Data Pendaftaran Anda'))

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ translateText('Data Pendaftaran Anda') }}</h2>

        {{-- DEBUG: Hapus di produksi --}}
        <div class="text-xs text-gray-500">
            Locale: <strong>{{ app()->getLocale() }}</strong>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('pendaftaran.create', ['lang' => app()->getLocale()]) }}" class="btn btn-primary">
            + {{ translateText('Buat Pendaftaran Baru') }}
        </a>
    </div>
    
    @if($pendaftaran->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>{{ translateText('Nama Lengkap') }}</th>
                        <th>{{ translateText('Tempat Lahir') }}</th>
                        <th>{{ translateText('Tanggal Lahir') }}</th>
                        <th>{{ translateText('Jenis Kelamin') }}</th>
                        <th>{{ translateText('Pendidikan Terakhir') }}</th>
                        <th>{{ translateText('Alamat KTP') }}</th>
                        <th>{{ translateText('Belajar Bahasa Jepang') }}</th>
                        <th>{{ translateText('Tempat Belajar') }}</th>
                        <th>{{ translateText('Pernah ke Jepang') }}</th>
                        <th>{{ translateText('Tujuan ke Jepang') }}</th>
                        <th>{{ translateText('Sumber Info') }}</th>
                        <th>{{ translateText('Nomor WhatsApp') }}</th>
                        <th>{{ translateText('Foto KTP') }}</th>
                        <th>{{ translateText('Status') }}</th>
                        <th>{{ translateText('Dibuat') }}</th>
                        <th>{{ translateText('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftaran as $data)
                        <tr>
                            {{-- Nama Lengkap → ASLI (tidak diterjemahkan) --}}
                            <td>{{ $data->nama_lengkap }}</td>

                            {{-- Tempat Lahir → ASLI --}}
                            <td>{{ $data->tempat_lahir }}</td>

                            {{-- Tanggal Lahir --}}
                            <td>
                                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}
                            </td>

                            {{-- Jenis Kelamin --}}
                            <td>{{ translateText($data->jenis_kelamin) }}</td>

                            {{-- Pendidikan Terakhir --}}
                            <td>{{ $data->pendidikan_terakhir }}</td>

                            {{-- Alamat KTP → ASLI --}}
                            <td class="text-start">
                                {{ Str::limit($data->alamat_ktp, 50) }}
                            </td>

                            {{-- Pernah Belajar --}}
                            <td>{{ translateText($data->pernah_belajar_bahasa_jepang) }}</td>

                            {{-- Tempat Belajar --}}
                            <td>{{ $data->tempat_belajar_bahasa ?? translateText('Tidak ada') }}</td>

                            {{-- Pernah ke Jepang --}}
                            <td>{{ translateText($data->pernah_ke_jepang) }}</td>

                            {{-- Tujuan ke Jepang → TERJEMAHKAN --}}
                            <td>{{ translateField($data, 'tujuan_ke_jepang') }}</td>

                            {{-- Sumber Info → TERJEMAHKAN --}}
                            <td>{{ translateField($data, 'sumber_info') }}</td>

                            {{-- Nomor WhatsApp --}}
                            <td>{{ e($data->nomor_whatsapp) }}</td>

                            {{-- Foto KTP --}}
                            <td>
                                @if ($data->foto_ktp_path)
                                    <a href="{{ asset('storage/' . $data->foto_ktp_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $data->foto_ktp_path) }}" class="img-thumbnail" width="60" alt="KTP">
                                    </a>
                                @else
                                    <span class="text-muted">{{ translateText('Belum diunggah') }}</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="badge bg-{{ $data->is_active ? 'success' : 'secondary' }}">
                                    {{ translateText($data->is_active ? 'Aktif' : 'Nonaktif') }}
                                </span>
                            </td>

                            {{-- Dibuat --}}
                            <td>
                                {{ optional($data->created_at)->translatedFormat('d M Y') }}
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <a href="{{ route('pendaftaran.show', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}"
                                   class="btn btn-sm btn-info text-white">
                                    {{ translateText('Lihat Detail') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">
            {{ translateText('Belum ada data pendaftaran.') }}
        </div>
    @endif
</div>
@endsection