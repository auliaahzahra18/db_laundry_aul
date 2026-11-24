@extends('layouts.app')

@section('title', 'Dashboard - LaundryKu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Dashboard</h4>
        <small class="text-muted">Ringkasan operasional dan keuangan laundry</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('layanan.index') }}" class="btn btn-outline-primary">Data Layanan</a>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Rekap Transaksi Laundry</a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Total Transaksi</div>
                <h3 class="fw-bold mt-1 mb-0">{{ $totalTransaksi }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Sedang Diproses</div>
                <h3 class="fw-bold text-warning mt-1 mb-0">{{ $proses }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Selesai</div>
                <h3 class="fw-bold text-success mt-1 mb-0">{{ $selesai }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small">Total Pendapatan (Selesai)</div>
                <h4 class="fw-bold text-primary mt-1 mb-0">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>
@endsection