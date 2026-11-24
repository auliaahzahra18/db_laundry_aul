@extends('layouts.app')

@section('title', 'Data Layanan - LaundryKu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Data Layanan</h4>
        <small class="text-muted">Daftar jenis layanan cuci dan tarif per kilogram</small>
    </div>
</div>

<div class="row g-4">
    @if(auth()->user()->role === 'admin')
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold py-3">Tambah Layanan Baru</div>
            <div class="card-body">
                <form action="{{ route('layanan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Reguler / Ekspres / Superkilat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga per Kg (Rp)</label>
                        <input type="number" name="harga_per_kg" class="form-control" placeholder="7000" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estimasi Waktu</label>
                        <input type="text" name="estimasi_waktu" class="form-control" placeholder="3-4 hari" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Layanan</button>
                </form>
            </div>
        </div>
    </div>
    @endif

    <div class="{{ auth()->user()->role === 'admin' ? 'col-lg-8' : 'col-12' }}">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold py-3">Daftar Jenis Layanan</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Layanan</th>
                                <th>Harga / Kg</th>
                                <th>Estimasi</th>
                                @if(auth()->user()->role === 'admin')
                                    <th class="text-end">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($layanans as $index => $layanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $layanan->nama_layanan }}</td>
                                <td>Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}</td>
                                <td>{{ $layanan->estimasi_waktu }}</td>
                                @if(auth()->user()->role === 'admin')
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $layanan->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('layanan.destroy', $layanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>

                            @if(auth()->user()->role === 'admin')
                            <!-- Modal Edit Layanan -->
                            <div class="modal fade" id="editModal{{ $layanan->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('layanan.update', $layanan) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Layanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Layanan</label>
                                                    <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga per Kg (Rp)</label>
                                                    <input type="number" name="harga_per_kg" value="{{ $layanan->harga_per_kg }}" class="form-control" min="0" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Estimasi Waktu</label>
                                                    <input type="text" name="estimasi_waktu" value="{{ $layanan->estimasi_waktu }}" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data layanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection