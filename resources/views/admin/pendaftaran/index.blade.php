{{-- resources/views/admin/pendaftaran/index.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Admin - Manajemen Pendaftaran'))

@section('content')
<div class="container-fluid mt-4">
    <h2>{{ translateText('Manajemen Pendaftaran') }}</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter Status -->
    <div class="mb-3">
        <div class="btn-group" role="group">
            @foreach(['pending', 'approved', 'rejected'] as $st)
                <a href="{{ route('admin.pendaftaran.index', ['status' => $st, 'lang' => app()->getLocale()]) }}"
                   class="btn btn-sm {{ $status === $st ? 'btn-primary' : 'btn-outline-secondary' }}">
                    {{ translateText(ucfirst($st)) }} 
                    <span class="badge bg-light text-dark">
                        {{ \App\Models\PendaftaranSiswa::where('status', $st)->count() }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>{{ translateText('Program') }}</th>
                    <th>{{ translateText('Nama Lengkap') }}</th>
                    <th>{{ translateText('WhatsApp') }}</th>
                    <th>{{ translateText('Tujuan') }}</th>
                    <th>{{ translateText('Dibuat') }}</th>
                    <th>{{ translateText('Status') }}</th>
                    <th>{{ translateText('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $data)
                    <tr>
                        <td>{{ translateText($data->program) }}</td>
                        <td>{{ $data->nama_lengkap }}</td>
                        <td>{{ e($data->nomor_whatsapp) }}</td>
                        <td>{{ translateField($data, 'tujuan_ke_jepang') }}</td>
                        <td>{{ $data->created_at->translatedFormat('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $data->status === 'approved' ? 'success' : 
                                ($data->status === 'rejected' ? 'danger' : 'warning') 
                            }}">
                                {{ translateText($data->status) }}
                            </span>
                        </td>
                        <td>
                            @if($data->status === 'pending')
                                <form action="{{ route('admin.pendaftaran.approve', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success" 
                                            onclick="return confirm('{{ translateText('Setujui pendaftaran ini?') }}')">
                                        {{ translateText('Setujui') }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.pendaftaran.reject', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('{{ translateText('Tolak pendaftaran ini?') }}')">
                                        {{ translateText('Tolak') }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">{{ translateText('Selesai') }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            {{ translateText('Belum ada pendaftaran.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $pendaftaran->appends(['status' => $status])->links() }}
</div>
@endsection