{{-- resources/views/user/pendaftaran/index.blade.php --}}
@extends('layouts.user.layout')

@section('page-title', translateText('Data Pendaftaran Anda'))

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">{{ translateText('Data Pendaftaran Anda') }}</h2>
            <p class="text-muted small mb-0">{{ translateText('Kelola pendaftaran program ke Jepang') }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pendaftaran.create', ['lang' => app()->getLocale()]) }}"
               class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 1z"/>
                </svg>
                {{ translateText('Buat Baru') }}
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-success" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Data Table (Desktop) -->
    @if($pendaftaran->count() > 0)
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden d-none d-lg-block">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <tr>
                                <th class="ps-4">{{ translateText('Program') }}</th>
                                <th>{{ translateText('Nama') }}</th>
                                <th>{{ translateText('Tgl Lahir') }}</th>
                                <th>{{ translateText('Pendidikan') }}</th>
                                <th>{{ translateText('Tujuan') }}</th>
                                <th>{{ translateText('Status') }}</th>
                                <th>{{ translateText('Dibuat') }}</th>
                                <th class="text-center">{{ translateText('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran as $data)
                                <tr class="border-start border-3 {{ $data->status === 'approved' ? 'border-success' : ($data->status === 'rejected' ? 'border-danger' : 'border-warning') }}">
                                    <td class="ps-4 fw-semibold">
                                        <span class="badge bg-light text-dark">{{ translateText($data->program) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($data->foto_ktp_path)
                                                <img src="{{ asset('storage/' . $data->foto_ktp_path) }}" 
                                                     class="rounded-circle" width="36" height="36" alt="KTP">
                                            @else
                                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white" style="width:36px;height:36px;font-size:12px;">
                                                    {{ Str::substr($data->nama_lengkap, 0, 2) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $data->nama_lengkap }}</div>
                                                <small class="text-muted">{{ e($data->nomor_whatsapp) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}</td>
                                    <td>{{ $data->pendidikan_terakhir }}</td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 180px;" title="{{ translateField($data, 'tujuan_ke_jepang') }}">
                                            {{ Str::limit(translateField($data, 'tujuan_ke_jepang'), 40) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-2 fw-medium {{ 
                                            $data->status === 'approved' ? 'bg-success' : 
                                            ($data->status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark')
                                        }}">
                                            {{ translateText($data->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $data->created_at->translatedFormat('d M Y') }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pendaftaran.edit', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}"
                                               class="btn btn-sm btn-outline-warning" title="{{ translateText('Edit') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('pendaftaran.destroy', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}"
                                                  method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('{{ translateText('Yakin ingin menghapus?') }}')"
                                                        title="{{ translateText('Hapus') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Mobile Cards -->
        <div class="d-lg-none">
            @foreach($pendaftaran as $data)
                <div class="card mb-3 border-start border-4 {{ 
                    $data->status === 'approved' ? 'border-success' : 
                    ($data->status === 'rejected' ? 'border-danger' : 'border-warning') 
                }} shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $data->nama_lengkap }}</h6>
                                <small class="text-muted">{{ e($data->nomor_whatsapp) }}</small>
                            </div>
                            <span class="badge rounded-pill px-3 py-2 {{ 
                                $data->status === 'approved' ? 'bg-success' : 
                                ($data->status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark')
                            }}">
                                {{ translateText($data->status) }}
                            </span>
                        </div>
                        <div class="row g-2 small text-muted">
                            <div class="col-6">
                                <strong>{{ translateText('Program')}}:</strong> {{ translateText($data->program) }}
                            </div>
                            <div class="col-6">
                                <strong>{{ translateText('Lahir')}}:</strong> {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}
                            </div>
                            <div class="col-12">
                                <strong>{{ translateText('Tujuan')}}:</strong> 
                                <span class="text-dark">{{ Str::limit(translateField($data, 'tujuan_ke_jepang'), 50) }}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('pendaftaran.edit', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}"
                               class="btn btn-sm btn-outline-warning flex-fill">
                                {{ translateText('Edit') }}
                            </a>
                            <form action="{{ route('pendaftaran.destroy', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}"
                                  method="POST" class="d-inline flex-fill">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger flex-fill"
                                        onclick="return confirm('{{ translateText('Yakin ingin menghapus?') }}')">
                                    {{ translateText('Hapus') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ddd" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M11 5.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5zM11 8a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h5A.5.5 0 0 1 11 8zm0 2.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5z"/>
                </svg>
            </div>
            <h5 class="text-muted">{{ translateText('Belum ada pendaftaran') }}</h5>
            <p class="text-muted">{{ translateText('Mulai daftar program ke Jepang sekarang!') }}</p>
            <a href="{{ route('pendaftaran.create', ['lang' => app()->getLocale()]) }}" class="btn btn-primary mt-3">
                {{ translateText('Daftar Sekarang') }}
            </a>
        </div>
    @endif
</div>
@endsection