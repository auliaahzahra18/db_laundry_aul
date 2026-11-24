@extends('layouts.app')

@section('title', 'Rekap Transaksi Laundry - LaundryKu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Rekap Transaksi Laundry</h4>
        <small class="text-muted">Pencatatan transaksi masuk, status pengerjaan, dan rekap pendapatan</small>
    </div>
    <div class="card border-0 shadow-sm bg-primary text-white px-3 py-2">
        <div class="small">Total Pendapatan (Selesai)</div>
        <div class="fw-bold fs-5">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
    </div>
</div>

<!-- Form Pencatatan Transaksi Baru -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white fw-semibold py-3">Catat Transaksi Baru</div>
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="form-control" placeholder="Nama pelanggan" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Jenis Layanan</label>
                <select name="layanan_id" class="form-select" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($layanans as $layanan)
                        <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->nama_layanan }} (Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}/kg - {{ $layanan->estimasi_waktu }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Berat (Kg)</label>
                <input type="number" step="0.1" min="0.1" name="berat" value="{{ old('berat') }}" class="form-control" placeholder="2.5" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Rekap Transaksi -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold py-3">Daftar Transaksi</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>No. HP</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $index => $trx)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-semibold">{{ $trx->nama_pelanggan }}</td>
                        <td>{{ $trx->no_hp }}</td>
                        <td>
                            {{ $trx->layanan->nama_layanan }}
                            <div class="small text-muted">Rp {{ number_format($trx->layanan->harga_per_kg, 0, ',', '.') }}/kg</div>
                        </td>
                        <td>{{ $trx->berat }} kg</td>
                        <td class="fw-semibold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($trx->status === 'Proses')
                                <span class="badge bg-warning text-dark">Proses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($trx->status === 'Proses')
                                <form action="{{ route('transaksi.selesai', $trx->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Tandai Selesai</button>
                                </form>
                            @else
                                <span class="text-muted small">Tuntas</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada transaksi tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection