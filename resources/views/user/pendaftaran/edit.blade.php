{{-- resources/views/user/pendaftaran/edit.blade.php --}}
@extends('layouts.user.layout')

@section('page-title', translateText('Edit Pendaftaran'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">
        {{ translateText('Edit Pendaftaran') }} <br>
        <small>LPK MORI CENTRE</small>
    </h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{ translateText('Terjadi kesalahan!') }}</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendaftaran.update', ['pendaftaran' => $pendaftaran->id, 'lang' => app()->getLocale()]) }}" 
          method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        @method('PUT')

        {{-- PROGRAM --}}
        <div class="col-md-12">
            <label class="form-label">{{ translateText('Program yang Dipilih') }}:</label>
            <select name="program" class="form-control" required>
                <option value="">-- {{ translateText('Pilih Program') }} --</option>
                <option value="GINOU JISSHUUSEI" {{ old('program', $pendaftaran->program) == 'GINOU JISSHUUSEI' ? 'selected' : '' }}>
                    {{ translateText('GINOU JISSHUUSEI') }}
                </option>
                <option value="TOKUTEI GINOU (MANDIRI)" {{ old('program', $pendaftaran->program) == 'TOKUTEI GINOU (MANDIRI)' ? 'selected' : '' }}>
                    {{ translateText('TOKUTEI GINOU (MANDIRI)') }}
                </option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Nama Lengkap') }}:</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">{{ translateText('Tempat Lahir') }}:</label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">{{ translateText('Tanggal Lahir') }}:</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">{{ translateText('Jenis Kelamin') }}:</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- {{ translateText('Pilih') }} --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                    {{ translateText('Laki-laki') }}
                </option>
                <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                    {{ translateText('Perempuan') }}
                </option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">{{ translateText('Pendidikan Terakhir') }}:</label>
            <select name="pendidikan_terakhir" class="form-control" required>
                <option value="">-- {{ translateText('Pilih') }} --</option>
                @foreach(['SMA','SMK','D1','D2','D3','D4','S1'] as $edu)
                    <option value="{{ $edu }}" {{ old('pendidikan_terakhir', $pendaftaran->pendidikan_terakhir) == $edu ? 'selected' : '' }}>
                        {{ $edu }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12">
            <label class="form-label">{{ translateText('Alamat KTP') }}:</label>
            <textarea name="alamat_ktp" class="form-control" rows="3" required>{{ old('alamat_ktp', $pendaftaran->alamat_ktp) }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Pernah belajar bahasa Jepang?') }}</label>
            <select name="pernah_belajar_bahasa_jepang" class="form-control" required>
                <option value="">-- {{ translateText('Pilih') }} --</option>
                <option value="Pernah" {{ old('pernah_belajar_bahasa_jepang', $pendaftaran->pernah_belajar_bahasa_jepang) == 'Pernah' ? 'selected' : '' }}>
                    {{ translateText('Pernah') }}
                </option>
                <option value="Tidak Pernah" {{ old('pernah_belajar_bahasa_jepang', $pendaftaran->pernah_belajar_bahasa_jepang) == 'Tidak Pernah' ? 'selected' : '' }}>
                    {{ translateText('Tidak Pernah') }}
                </option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Jika Pernah, di mana?') }}</label>
            <input type="text" name="tempat_belajar_bahasa" value="{{ old('tempat_belajar_bahasa', $pendaftaran->tempat_belajar_bahasa) }}" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Pernah ke Jepang?') }}</label>
            <select name="pernah_ke_jepang" class="form-control" required>
                <option value="">-- {{ translateText('Pilih') }} --</option>
                <option value="Pernah" {{ old('pernah_ke_jepang', $pendaftaran->pernah_ke_jepang) == 'Pernah' ? 'selected' : '' }}>
                    {{ translateText('Pernah') }}
                </option>
                <option value="Tidak Pernah" {{ old('pernah_ke_jepang', $pendaftaran->pernah_ke_jepang) == 'Tidak Pernah' ? 'selected' : '' }}>
                    {{ translateText('Tidak Pernah') }}
                </option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Tujuan ke Jepang') }}:</label>
            <textarea name="tujuan_ke_jepang" class="form-control" rows="3" required>{{ old('tujuan_ke_jepang', $pendaftaran->tujuan_ke_jepang) }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Sumber Informasi') }}:</label>
            <textarea name="sumber_info" class="form-control" rows="3" required>{{ old('sumber_info', $pendaftaran->sumber_info) }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Nomor WhatsApp') }}:</label>
            <input type="text" name="nomor_whatsapp" value="{{ old('nomor_whatsapp', $pendaftaran->nomor_whatsapp) }}" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ translateText('Upload Foto KTP') }}:</label>
            <input type="file" name="foto_ktp" class="form-control" accept="image/*">
            @if ($pendaftaran->foto_ktp_path)
                <div class="mt-2">
                    <small class="text-muted">{{ translateText('Foto saat ini:') }}</small><br>
                    <a href="{{ asset('storage/' . $pendaftaran->foto_ktp_path) }}" target="_blank">
                        <img src="{{ asset('storage/' . $pendaftaran->foto_ktp_path) }}" class="img-thumbnail" width="100" alt="KTP">
                    </a>
                </div>
            @endif
        </div>

        <div class="col-12 text-end mt-4">
            <a href="{{ route('pendaftaran.index', ['lang' => app()->getLocale()]) }}" class="btn btn-secondary me-2">
                {{ translateText('Kembali') }}
            </a>
            <button type="submit" class="btn btn-success">
                {{ translateText('Simpan Perubahan') }}
            </button>
        </div>
    </form>
</div>
@endsection